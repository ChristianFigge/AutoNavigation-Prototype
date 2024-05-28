<?php

require_once('navDBConnection.php');
require_once('navNodeTree.php');
require_once('navNode.php');
require_once('navUtils.php');

class Navigator {
    private $dbConnection;
    private $treeConTable;

    function __construct() {
        $this->dbConnection = new NavDBConnection();
        $this->treeConTable = $this->dbConnection->getTreeConnectionTable();
    }

    function __destruct() {
        $this->dbConnection = null;
    }

    // Returns [i, len], the index of the nearest tree connection in $cons relative to nodeAdr and the length of this path
    // NOTE: For now, we assume that the shortest in-tree traversal is also the shortest path on the floor plan
    function getNearestConnectionInfo($nodeAdr, $cons) {
        $minPathLen = getPathLength($nodeAdr, $cons[0][0]);
        $conIdx = 0;
        for($i = 1; $i < count($cons); $i++) {
            $newLen = getPathLength($nodeAdr, $cons[$i][0]);
            if($newLen < $minPathLen) {
                $minPathLen = $newLen;
                $conIdx = $i;
            }
        }
        return [$conIdx, $minPathLen];
    }

    // "meta tree" path calculation if start & finish nodes are in different trees.
    // Returns [a, len], an associative array a = [treeA_id => [startAdrA, finishAdrA], treeB_id => ...] to iterate over
    // and the length of this path
    function getMetaTreePath($from_tree, $from_nodeAdr, $to_tree, $to_nodeAdr) {
        $conArray = array();
        $pathLen = 0;

        while ($from_tree != $to_tree) {
            $cons = getTreeConnectionsFromTable($this->treeConTable, $from_tree, $to_tree); // returns [[nodeAdr_from, tree_id_to, nodeAdr_to], ...]

            $nearestConInfo = $this->getNearestConnectionInfo($from_nodeAdr, $cons); // returns [idx, pathLen]
            $con = $cons[ $nearestConInfo[0] ];

            $conArray[$from_tree] = [$from_nodeAdr, $con[0]];
            $pathLen += $nearestConInfo[1];

            $from_tree = $con[1];
            $from_nodeAdr = $con[2];
        }

        $conArray[$from_tree] = [$from_nodeAdr, $to_nodeAdr];
        $pathLen += getPathLength($from_nodeAdr, $to_nodeAdr);

        return [$conArray, $pathLen];
    }

    // Compares the metaTreePath length of given start- and finishNodes and returns the shortest
    function getShortestPath($startNodes, $finishNodes) {
        $mtp = $this->getMetaTreePath($startNodes[0]["tree_id"], $startNodes[0]["nodeAdr"], $finishNodes[0]["tree_id"], $finishNodes[0]["nodeAdr"]);
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
                    $mtp = $this->getMetaTreePath($startNodes[$i]["tree_id"], $startNodes[$i]["nodeAdr"], $finishNodes[$j]["tree_id"], $finishNodes[$j]["nodeAdr"]);
                    if($mtp[1] < $shortestPathLen) {
                        $shortestPath = $mtp[0];
                        $shortestPathLen = $mtp[1];
                    }
                }
            }
        }
        return $shortestPath;
    }

    function getPathPoints($startLocationStr, $finishLocationStr) {
        // Get info on where to find navigation nodes in the db (tree id + node address)
        $startNodeInfoArray = $this->dbConnection->getNodeInfoArray($startLocationStr);
        $finishNodeInfoArray = $this->dbConnection->getNodeInfoArray($finishLocationStr);

        if($startNodeInfoArray && $finishNodeInfoArray) {
            $metaTreePath = $this->getShortestPath($startNodeInfoArray, $finishNodeInfoArray);

            // $trees and $paths are the return values, containing an array of coordinates for each tree_id
            // (the client-side floor plans are also linked to a specific tree id)
            $trees = array();
            $paths = array();
            foreach($metaTreePath as $tree_id => [$startAdr, $finishAdr]) {
                $nt = $this->dbConnection->getNodeTree($tree_id);

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

            return [$trees, $paths];
        }
        else {
            return false;
        }
    }
}