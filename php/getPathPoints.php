<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */
    require_once('navDBConnection.php');
    require_once('navNodeTree.php');

    function getShortestPath($startNodes, $finishNodes, $dbCon) {
        // "meta tree" path calculation if start & finish nodes are in different trees.
        // Returns [a, len], an associative array a = [treeA_id => [startAdrA, finishAdrA], treeB_id => ...] to iterate over
        // and the length of this path
        $mtp = $dbCon->getMetaTreePath($startNodes[0]["tree_id"], $startNodes[0]["nodeAdr"], $finishNodes[0]["tree_id"], $finishNodes[0]["nodeAdr"]);
        $shortestPath = $mtp[0];
        $shortestPathLen = $mtp[1];  // baseline path length for comparison

        if(count($startNodes) > 1 || count($finishNodes) > 1) {
            // We need to make sure that $startNodes[1] exists,
            // and since start->finish or finish->start ideally result in the same path,
            // we just swap them if necessary:
            if(count($finishNodes) > count($startNodes)) {
                $temp = $startNodes;
                $startNodes = $finishNodes;
                $finishNodes = $temp;
            }

            // Compare the path lengths for each combination of startNode -> finishNode and save shortest
            for($i = 1; $i < count($startNodes); $i++) {
                for($j = 0; $j < count($finishNodes); $j++) {
                    $mtp = $dbCon->getMetaTreePath($startNodes[$i]["tree_id"], $startNodes[$i]["nodeAdr"], $finishNodes[$j]["tree_id"], $finishNodes[$j]["nodeAdr"]);
                    if($mtp[1] < $shortestPathLen) {
                        $shortestPath = $mtp[0];
                        $shortestPathLen = $mtp[1];
                    }
                }
            }
        }
        return $shortestPath;
    }

    $dbCon = new NavDBConnection();

    // Get info on where to find navigation nodes in the db (tree id + node address)
    $startNodeInfoArray = $dbCon->getNodeInfoArray($_POST['start']);
    $finishNodeInfoArray = $dbCon->getNodeInfoArray($_POST['finish']);

    if($startNodeInfoArray && $finishNodeInfoArray) {
        $metaTreePath = getShortestPath($startNodeInfoArray, $finishNodeInfoArray, $dbCon);

        // $trees and $paths are the return values, containing an array of coordinates for each tree_id
        // (the client-side floor plans are also linked to a specific tree id)
        $trees = array();
        $paths = array();
        foreach($metaTreePath as $tree_id => [$startAdr, $finishAdr]) {
            $nt = $dbCon->getNodeTree($tree_id);  

            // Get addresses of nodes on the path
            $adrArray = $nt->calcPath($startAdr, $finishAdr); 

            // Get array of point coordinates [x, y] from nodes
            $points = array();
            foreach($adrArray as $adr) {
                $points[] = $nt->getNode($adr)->getPos();
            }

            $trees[] = $tree_id;
            $paths[] = $points;
        }
        
        $response_json = '{ "trees" : ' . json_encode($trees) . ', "paths" : ' . json_encode($paths) . '}';
        echo $response_json;       
    }
    else {
        echo NULL;
    }
?>