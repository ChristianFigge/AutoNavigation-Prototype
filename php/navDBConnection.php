<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

    // The following functions are PLACEHOLDERS to simulate/represent the database logic.
    // Refer to the prototype_helpers folder for more info

    require_once('navUtils.php');
    require_once('navNodeTree.php');

    class NavDBConnection {
        private $connection;

        function __construct() {
            // establish db connection...
        }

        function __destruct() {
            // close db connection ...
        }

        function getNodeInfoArray($locStr) {
            // Read location table
            $locDict = unserialize(file_get_contents('../data/pseudoDB/locationDict.blob'));

            // Return [["tree_id" => int, "nodeAdr" => bigint], ...] where location = $locStr
            if(isset($locDict[$locStr]))
                return $locDict[$locStr];
            else 
                return false;  
        }
    
        function getNodeTree($tree_id) {
            // Fetch NavNodeTree object where id = $tree_id
            $nodeTree = unserialize(file_get_contents('../data/pseudoDB/nodeTree' . (string)$tree_id . '.blob'));
            return $nodeTree;
        }

        // TODO refactor
        // Returns [i, len], the index of the nearest tree connection relative to nodeAdr and the length of this path
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

        // TODO refactor
        // "meta tree" path calculation if start & finish nodes are in different trees.
        // Returns [a, len]: an associative array a = [treeA_id => [startAdrA, finishAdrA], treeB_id => ...]
        // to iterate over and the length of this path
        function getMetaTreePath($from_tree, $from_nodeAdr, $to_tree, $to_nodeAdr) {
            $conArray = array();
            $pathLen = 0;

            if($from_tree != $to_tree) { // avoid unnecessary db requests if nodes are in the same tree
                $conTable = unserialize(file_get_contents('../data/pseudoDB/treeConnections.blob'));

                do {
                    $cons = $conTable[$from_tree][$to_tree]; // returns [[nodeAdr_from, tree_id_to, nodeAdr_to], ...]

                    $nearestConInfo = $this->getNearestConnectionInfo($from_nodeAdr, $cons); // returns [idx, pathLen]
                    $con = $cons[ $nearestConInfo[0] ];

                    $conArray[$from_tree] = [$from_nodeAdr, $con[0]];
                    $pathLen += $nearestConInfo[1];

                    $from_tree = $con[1];
                    $from_nodeAdr = $con[2];
                } while ($from_tree != $to_tree);
            }

            $conArray[$from_tree] = [$from_nodeAdr, $to_nodeAdr];
            $pathLen += getPathLength($from_nodeAdr, $to_nodeAdr);

            return [$conArray, $pathLen];
        }
    }
?>