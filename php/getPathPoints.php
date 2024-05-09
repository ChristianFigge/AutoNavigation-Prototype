<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */
    require('navNodeTree.php');
    require('navDBConnection.php');
    
    $dbCon = new NavDBConnection();

    // Get info on where to find navigation nodes in the db (tree id + node address)
    $startNodeInfoArray = $dbCon->getNodeInfo($_POST['start']);
    $finishNodeInfoArray = $dbCon->getNodeInfo($_POST['finish']);

    if($startNodeInfoArray && $finishNodeInfoArray) {

        $startNodeInfo = $startNodeInfoArray[0];
        $finishNodeInfo = $finishNodeInfoArray[0];
        if(count($startNodeInfoArray) > 1 || count($finishNodeInfoArray) > 1) {
            // TODO get shortest path if any location is mapped to more than one node
        }

        // "meta tree" path calculation if start & finish nodes are in different trees.
        // Returns an associative array with treeA_id => [startAdrA, finishAdrA], treeB_id => ... to iterate over
        $metaTreePath = $dbCon->getMetaTreePath($startNodeInfo["tree_id"], $startNodeInfo["nodeAdr"], $finishNodeInfo["tree_id"], $finishNodeInfo["nodeAdr"]);

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