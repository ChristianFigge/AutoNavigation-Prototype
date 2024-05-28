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

        function getTreeConnectionTable() {
            return unserialize(file_get_contents('../data/pseudoDB/treeConnections.blob'));
        }

        function getTreeConnections($fromTree, $toTree) {
            return getTreeConnectionsFromTable($this->getTreeConnectionTable(), $fromTree, $toTree);
        }
    }
?>