<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

    // The following functions are PLACEHOLDERS to simulate/represent the database logic.
    // Refer to the prototype_helpers folder for more info

    class NavDBConnection {
        private $connection;

        function __construct() {
            // establish db connection...
        }

        function __destruct() {
            // close db connection ...
        }

        function getNodeInfo($locStr) {
            // Read location table
            $locDict = unserialize(file_get_contents('../data/pseudoDB/locationDict.blob'));
            
            // Return [["tree_id" => int, "nodeAdr" => int], ...] where location = $locStr
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

        // "meta tree" path calculation if start & finish nodes are in different trees.
        // Returns an associative array with treeA_id => [startAdrA, finishAdrA], treeB_id => ... to iterate over 
        function getMetaTreePath($from_tree, $from_nodeAdr, $to_tree, $to_nodeAdr) {
            $conArray = array(); 

            if($from_tree != $to_tree) {
                $conTable = unserialize(file_get_contents('../data/pseudoDB/treeConnections.blob'));
                $con = $conTable[$from_tree][$to_tree]; // returns [nodeAdr_from, tree_id_to, nodeAdr_to]

                $conArray[$from_tree] = [$from_nodeAdr, $con[0]];

                while($con[1] != $to_tree) {
                    $nextCon = $conTable[$con[1]][$to_tree];
                    $conArray[$con[1]] = [$con[2], $nextCon[0]];
                    $con = $nextCon;
                }

                $conArray[$con[1]] = [$con[2], $to_nodeAdr];
            }
            else {  // avoid unnecessary db requests:
                $conArray[$from_tree] = [$from_nodeAdr, $to_nodeAdr];
            }
            return $conArray;
        }
    }
?>