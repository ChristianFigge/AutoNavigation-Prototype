<?php
    // All the node data for our navigation example code
    // that would later be stored in an actual DB (see below)
    // Info contains, for each node:
    // nodeAddress (unique only within its tree) | posX | posY | location string
    $nodeInfo = array(
        array(  // TREE #0 (C0, B0)
            array(0b00, 975, 600, ''), // root 

            // *** C0 ***
            array(0b1000, 975, 355, 'C0-Center'),
            // left branch from 10'00
            array(0b011000, 655, 355, ''),
            array(0b01011000, 655, 460, 'C0-Aufz'),
            array(0b11011000, 655, 250, ''),
            array(0b1011011000, 655, 60, ''),
            array(0b111011011000, 720, 60, 'C0-TH'),
            array(0b11111011011000, 720, 200, ''),
            array(0b10111011011000, 800, 60, ''),
            array(0b1110111011011000, 800, 200, ''), // connection to tree #1 (see below)
            array(0b10011000, 455, 355, ''),
            array(0b0110011000, 455, 455, 'C0-01'),
            array(0b1110011000, 455, 250, 'C0-02'),
            array(0b1010011000, 315, 355, ''),
            array(0b111010011000, 315, 250, 'C0-04'),
            array(0b011010011000, 315, 450, 'C0-03'),
            array(0b101010011000, 140, 355, 'C0-05'),
            // front branch from 10'00
            array(0b101000, 975, 60, ''),
            // right branch from 10'00
            array(0b111000, 1150, 355, ''),
            array(0b01111000, 1150, 250, 'C0-06'),
            array(0b11111000, 1150, 450, 'C0-07'),
            array(0b10111000, 1280, 355, ''),
            array(0b0110111000, 1280, 250, 'C0-08'),
            array(0b1110111000, 1280, 450, 'C0-09'),
            array(0b1010111000, 1470, 355, 'C0-10'),
            
            // *** B0 ***
            array(0b0100, 975, 955, 'B0-Center'),  
            // left branch from 01'00
            array(0b010100, 655, 955, ''),
            array(0b01010100, 655, 1060, 'B0-Aufz'),
            array(0b11010100, 655, 850, ''),
            array(0b1011010100, 655, 660, ''),
            array(0b111011010100, 720, 660, 'B0-TH'),
            array(0b10010100, 455, 955, ''),
            array(0b0110010100, 455, 1055, 'B0-01'),
            array(0b1110010100, 455, 850, 'B0-02'),
            array(0b1010010100, 315, 955, ''),
            array(0b111010010100, 315, 850, 'B0-04'),
            array(0b011010010100, 315, 1050, 'B0-03'),
            array(0b101010010100, 140, 955, 'B0-05'),
            // front branch from 01'00
            array(0b100100, 975, 660, ''),
            // right branch from 01'00
            array(0b110100, 1150, 955, ''),
            array(0b01110100, 1150, 850, 'B0-06'),
            array(0b11110100, 1150, 1050, 'B0-07'),
            array(0b10110100, 1280, 955, ''),
            array(0b0110110100, 1280, 850, 'B0-08'),
            array(0b1110110100, 1280, 1050, 'B0-09'),
            array(0b1010110100, 1470, 955, 'B0-10')
        ),
        array(  // TREE #1 (C1) TODO cleanup
            array(0b00, 975, 600, ''), // root 

            // *** C1 ***
            array(0b1000, 975, 355, 'C1-Center'),
            // left branch from 10'00
            array(0b011000, 655, 355, ''),
            array(0b01011000, 740, 460, 'C1-Aufz'),
            array(0b11011000, 655, 250, ''),
            array(0b1011011000, 655, 60, ''),
            array(0b111011011000, 720, 60, 'C1-TH'),
            array(0b11111011011000, 720, 200, ''), // connection to tree #0 (see below)
            array(0b10111011011000, 800, 60, ''),
            array(0b1110111011011000, 800, 200, ''), // connection to tree #2 (see below)
            array(0b10011000, 455, 355, ''),
            array(0b0110011000, 455, 455, 'C1-01'),
            array(0b1110011000, 455, 250, 'C1-02'),
            array(0b1010011000, 315, 355, ''),
            array(0b111010011000, 315, 250, 'C1-04'),
            array(0b011010011000, 315, 450, 'C1-03'),
            array(0b101010011000, 140, 355, 'C1-05'),
            // front branch from 10'00
            array(0b101000, 975, 60, ''),
            // right branch from 10'00
            array(0b111000, 1150, 355, ''),
            array(0b01111000, 1150, 250, 'C1-06'),
            array(0b11111000, 1150, 450, 'C1-07'),
            array(0b10111000, 1280, 355, ''),
            array(0b0110111000, 1280, 250, 'C1-08'),
            array(0b1110111000, 1280, 450, 'C1-09'),
            array(0b1010111000, 1470, 355, 'C1-10')
        ),
        array(  // TREE #2 (C2) TODO cleanup
            array(0b00, 975, 600, ''), // root 

            // *** C2 ***
            array(0b1000, 975, 355, 'C2-Center'),
            // left branch from 10'00
            array(0b011000, 655, 355, ''),
            array(0b01011000, 740, 460, 'C2-Aufz'),
            array(0b11011000, 655, 250, ''),
            array(0b1011011000, 655, 60, ''),
            array(0b111011011000, 720, 60, 'C2-TH'),
            array(0b11111011011000, 720, 200, ''), // connection to tree #1 (see below)
            array(0b10111011011000, 800, 60, ''),
            array(0b1110111011011000, 800, 200, ''),    
            array(0b10011000, 455, 355, ''),
            array(0b0110011000, 455, 455, 'C2-01'),
            array(0b1110011000, 455, 250, 'C2-02'),
            array(0b1010011000, 315, 355, ''),
            array(0b111010011000, 315, 250, 'C2-04'),
            array(0b011010011000, 315, 450, 'C2-03'),
            array(0b101010011000, 140, 355, 'C2-05'),
            // front branch from 10'00
            array(0b101000, 975, 60, ''),
            // right branch from 10'00
            array(0b111000, 1150, 355, ''),
            array(0b01111000, 1150, 250, 'C2-06'),
            array(0b11111000, 1150, 450, 'C2-07'),
            array(0b10111000, 1280, 355, ''),
            array(0b0110111000, 1280, 250, 'C2-08'),
            array(0b1110111000, 1280, 450, 'C2-09'),
            array(0b1010111000, 1470, 355, 'C2-10')
        )
    );

    $treeConnections = array(
        // Connections from tree #0 to...
        array(
            1 => [/* from_node */ 0b1110111011011000, /* to_tree */ 1, /* to_node */ 0b11111011011000],// ... 1
            2 => [/* from_node */ 0b1110111011011000, /* to_tree */ 1, /* to_node */ 0b11111011011000] // ... 2 (indirect connection over tree 1)
        ),
        // Connections from tree #1 to...
        array(
            0 => [/* from_node */ 0b11111011011000, /* to_tree */ 0, /* to_node */ 0b1110111011011000], // ... 0
            2 => [/* from_node */ 0b1110111011011000, /* to_tree */ 2, /* to_node */ 0b11111011011000]  // ... 2
        ),
        // Connections from tree #2 to...
        array(
            1 => [/* from_node */ 0b11111011011000, /* to_tree */ 1, /* to_node */ 0b1110111011011000], // ... 1
            0 => [/* from_node */ 0b11111011011000, /* to_tree */ 1, /* to_node */ 0b1110111011011000]  // ... 0 (indirect connection over tree 1)
        )
    );

    // Create tree objects and store their serialized bytes in a file
    // Intended DB table structure:
    // | id | treeObj (blob) |
    require('../php/navNodeTree.php');
    $nodeTreePathTemplate = '../data/pseudoDB/nodeTreeX.blob';
    function writeNodeTrees() {
        global $nodeInfo, $nodeTreePathTemplate;
        $treeCount = 0;
        foreach($nodeInfo as $nodes) {
            $nodeTree = new NavNodeTree(); 
            foreach($nodes as $n) {
                $nodeTree->addNode($n[0], $n[1], $n[2]);
            }

            $writeSuccess = file_put_contents(str_replace('X', (string)$treeCount, $nodeTreePathTemplate), serialize($nodeTree));
            if($writeSuccess === false)
                return false;
            $treeCount++;
        }
        return true;
    }
    
    // Create a location dictionary that maps a location string to one or more nodes (through tree id + node address)
    // Intended DB table structure:
    // | id | location(text) | tree_id (int) | nodeAdr (bigint) |
    $locDictPath = '../data/pseudoDB/locationDict.blob';
    function writeLocationDict() {
        global $nodeInfo, $locDictPath;
        $locDict = array();
        for($t = 0; $t < count($nodeInfo); $t++) {
            foreach($nodeInfo[$t] as $node) {
                $locStr = $node[3];
                if(strlen($locStr) > 0) {
                    if (!isset($locDict[$locStr])) {
                        $locDict[$locStr] = array(array("tree_id" => $t, "nodeAdr" => $node[0]));
                    } else {
                        $locDict[$locStr][] = array("tree_id" => $t, "nodeAdr" => $node[0]);
                    }
                }
            }
        }
        return file_put_contents($locDictPath, serialize($locDict));
    }

    // Create a table that maps 2 given tree_ids to their connection nodes
    // Intended DB table structure: 
    // | id | fromTree (int) | toTree (int) | nodeAdr_from (bigint) | tree_id_to (int) | nodeAdr_to (bigint) |
    // (toTree == tree_id_to only for direct connections)
    $conTablePath = '../data/pseudoDB/treeConnections.blob';
    function writeTreeConnectionTable() {
        global $treeConnections, $conTablePath;
        return file_put_contents($conTablePath, serialize($treeConnections));
    }

    // call functions
    if(writeLocationDict())
        echo 'Successfully wrote location table to ' . $locDictPath;
    else
        echo 'ERROR: Failed to write location table at ' . $locDictPath;
    echo '<br />';

    if(writeNodeTrees())
        echo 'Successfully wrote ' . count($nodeInfo) . ' serialized NavNodeTree object(s) to ' . $nodeTreePathTemplate;
    else
        echo 'ERROR: Failed to write serialized node trees at ' . $nodeTreePathTemplate;
    echo '<br />';

    if(writeTreeConnectionTable())
        echo 'Successfully wrote tree connection table to ' . $conTablePath;
    else
        echo 'ERROR: Failed to write tree connection table at ' . $conTablePath;

?>