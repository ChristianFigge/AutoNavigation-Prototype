<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */
    require_once('navigator.php');

    $navi = new Navigator();
    $path = $navi->getPathPoints($_POST['start'], $_POST['finish']);   // returns [[tree_ids], [paths_per_tree]] or false

    if($path) {
        $response_json = '{ "trees" : ' . json_encode($path[0]) . ', "paths" : ' . json_encode($path[1]) . '}';
        echo $response_json;
    }
    else {
        echo NULL;
    }
?>