<?php
    // All the node data for our navigation example code
    // that would later be stored in an actual DB (see descriptions below)
    // Info contains, for each node:
    // nodeAddress (unique only within its tree) | posX | posY | location string
    $nodeInfo = array(
        array(  // TREE #0 (C0, B0)
            array(0b01, 975, 600, ''), // root

            // *** C0 ***
            array(0b1001, 975, 355, 'C0-Center'),
            // left branch from 10'01
            array(0b011001, 655, 355, ''),
            array(0b01011001, 655, 460, 'C0-Aufz'),
            array(0b1101011001, 655, 520, ''),      // connection to tree #1
            array(0b11011001, 655, 250, ''),
            array(0b1011011001, 655, 60, ''),
            array(0b111011011001, 720, 60, 'C0-TH'),
            array(0b11111011011001, 720, 200, ''),
            array(0b10111011011001, 800, 60, ''),
            array(0b1110111011011001, 800, 200, ''), // connection to tree #1
            array(0b10011001, 455, 355, ''),
            array(0b0110011001, 455, 455, 'C0-01'),
            array(0b1110011001, 455, 250, 'C0-02'),
            array(0b1010011001, 315, 355, ''),
            array(0b111010011001, 315, 250, 'C0-04'),
            array(0b011010011001, 315, 450, 'C0-03'),
            array(0b101010011001, 140, 355, 'C0-05'),
            // front branch from 10'01
            array(0b101001, 975, 60, ''),
            // right branch from 10'01
            array(0b111001, 1150, 355, ''),
            array(0b01111001, 1150, 250, 'C0-06'),
            array(0b11111001, 1150, 450, 'C0-07'),
            array(0b10111001, 1280, 355, ''),
            array(0b0110111001, 1280, 250, 'C0-08'),
            array(0b1110111001, 1280, 450, 'C0-09'),
            array(0b1010111001, 1470, 355, 'C0-10'),
            
            // *** B0 ***
            array(0b0101, 975, 955, 'B0-Center'),
            // left branch from 01'01
            array(0b010101, 655, 955, ''),
            array(0b01010101, 655, 1060, 'B0-Aufz'),
            array(0b11010101, 655, 850, ''),
            array(0b1011010101, 655, 660, ''),
            array(0b111011010101, 720, 660, 'B0-TH'),
            array(0b10010101, 455, 955, ''),
            array(0b0110010101, 455, 1055, 'B0-01'),
            array(0b1110010101, 455, 850, 'B0-02'),
            array(0b1010010101, 315, 955, ''),
            array(0b111010010101, 315, 850, 'B0-04'),
            array(0b011010010101, 315, 1050, 'B0-03'),
            array(0b101010010101, 140, 955, 'B0-05'),
            // front branch from 01'01
            array(0b100101, 975, 660, ''),
            // right branch from 01'01
            array(0b110101, 1150, 955, ''),
            array(0b01110101, 1150, 850, 'B0-06'),
            array(0b11110101, 1150, 1050, 'B0-07'),
            array(0b10110101, 1280, 955, ''),
            array(0b0110110101, 1280, 850, 'B0-08'),
            array(0b1110110101, 1280, 1050, 'B0-09'),
            array(0b1010110101, 1470, 955, 'B0-10')
        ),
        array(  // TREE #1 (C1) TODO cleanup
            array(0b01, 975, 600, ''), // root

            // *** C1 ***
            array(0b1001, 975, 355, 'C1-Center'),
            // left branch from 10'01
            array(0b011001, 655, 355, ''),
            array(0b01011001, 655, 460, 'C1-Aufz'),
            array(0b1101011001, 655, 520, ''),      // connection to tree #0
            array(0b11011001, 655, 250, ''),
            array(0b1011011001, 655, 60, ''),
            array(0b111011011001, 720, 60, 'C1-TH'),
            array(0b11111011011001, 720, 200, ''), // connection to tree #0
            array(0b10111011011001, 800, 60, ''),
            array(0b1110111011011001, 800, 200, ''), // connection to tree #2
            array(0b10011001, 455, 355, ''),
            array(0b0110011001, 455, 455, 'C1-01'),
            array(0b1110011001, 455, 250, 'C1-02'),
            array(0b1010011001, 315, 355, ''),
            array(0b111010011001, 315, 250, 'C1-04'),
            array(0b011010011001, 315, 450, 'C1-03'),
            array(0b101010011001, 140, 355, 'C1-05'),
            // front branch from 10'01
            array(0b101001, 975, 60, ''),
            // right branch from 10'01
            array(0b111001, 1150, 355, ''),
            array(0b01111001, 1150, 250, 'C1-06'),
            array(0b11111001, 1150, 450, 'C1-07'),
            array(0b10111001, 1280, 355, ''),
            array(0b0110111001, 1280, 250, 'C1-08'),
            array(0b1110111001, 1280, 450, 'C1-09'),
            array(0b1010111001, 1470, 355, 'C1-10')
        ),
        // *** C2 *** consists of 3 trees, #2 to #4
        array( // TREE #2 (C2-STAIRWELL)
            array(0b11, 720, 200, ''),  // connection to tree #1
            array(0b1011, 720, 60, 'C2-TH'),
            array(0b011011, 655, 60, ''),
            array(0b01011011, 655,355, ''), // connection to tree #3
            array(0b111011, 800, 60, 'C2-TH'),
            array(0b10111011, 870, 60, ''),
            array(0b1110111011, 870, 355, '') // connection to tree #4
        ),
        array( // TREE #3 (C2-LEFT)
            array(0b01, 655, 355, ''),  // connection to tree #2 AND tree #4
            array(0b1001, 455, 355, ''),
            array(0b011001, 455, 455, 'C2-01'),
            array(0b111001, 455, 250, 'C2-02'),
            array(0b101001, 315, 355, ''),
            array(0b11101001, 315, 250, 'C2-04'),
            array(0b01101001, 315, 450, 'C2-03'),
            array(0b10101001, 140, 355, 'C2-05'),
        ),
        array( // TREE #4 (C2-RIGHT)
            array(0b10, 870, 355, ''), // connection to tree #2
            array(0b0110, 740, 355, ''),
            array(0b100110, 655, 355, ''), //connection to tree #3
            array(0b010110, 740, 460, 'C2-Aufz'),
            array(0b1110, 995, 355, ''),
            // "upward" branch from 11'10
            array(0b011110, 995, 150, ''),
            array(0b11011110, 1145, 150, ''),
            array(0b1111011110, 1145, 255, 'C2-06'),
            array(0b1011011110, 1280, 150, ''),
            array(0b111011011110, 1280, 255, 'C2-08'),
            array(0b101011011110, 1410, 150, ''),
            array(0b11101011011110, 1410, 255, ''),
            array(0b0111101011011110, 1555, 255, ''),
            array(0b110111101011011110, 1555, 350, 'C2-10'),
            array(0b1011101011011110, 1410, 455, ''),
            array(0b101011101011011110, 1410, 560, ''),
            array(0b11101011101011011110, 1280, 560, ''),
            array(0b1111101011101011011110, 1280, 440, 'C2-09'),
            // "downward" branch from 11'10
            array(0b111110, 995, 560, ''),
            array(0b01111110, 1145, 560, ''),
            array(0b0101111110, 1145, 440, 'C2-07'),
            array(0b1001111110, 1280, 560, ''),
            array(0b011001111110, 1280, 440, 'C2-09'),
            array(0b101001111110, 1410, 560, ''),
            array(0b01101001111110, 1410, 455, ''),
            array(0b1101101001111110, 1555, 455, ''),
            array(0b011101101001111110, 1555, 350, 'C2-10'),
            array(0b1001101001111110, 1410, 255, ''),
            array(0b101001101001111110, 1410, 150, ''),
            array(0b01101001101001111110, 1280, 150, ''),
            array(0b0101101001101001111110, 1280, 255, 'CS-08'),

        )
    );

    // This array defines the connection nodes from each navTree to each other navTree.
    // In order to reduce redundant entries (especially in case of indirect connections), we summarize
    // equal connections under a "-1" key. This way we don't need to define every connection explicitly.
    // Returning the correct connections is handled by the getTreeConnectionsFromTable(...) func in NavUtils.php
    // Any remaining redundancies would be resolved in an actual DB by references, see "intended DB structure" below
    $treeConnections = array(
        // Connections from tree #0 (C0) to...
        array(
            -1 => [
                [/* from_node */ 0b1110111011011001, /* to_tree */ 1, /* to_node */ 0b11111011011001],  // Stairs (indirect connection over tree 1)
                [/* from_node */ 0b1101011001, /* to_tree */ 1, /* to_node */ 0b1101011001]             // Elevator (indirect connection over tree 1)
            ]
        ),
        // Connections from tree #1 (C1) to...
        array(
            -1 => [
                [/* from_node */ 0b1110111011011001, /* to_tree */ 2, /* to_node */ 0b11]   // indirect connection over tree #2
            ],
            0 => [  // C0
                [/* from_node */ 0b11111011011001, /* to_tree */ 0, /* to_node */ 0b1110111011011001],  // Stairs
                [/* from_node */ 0b1101011001, /* to_tree */ 0, /* to_node */ 0b1101011001]             // Elevator
            ]
        ),
        // Connections from tree #2 (C2-STAIRWELL) to...
        array(
            -1 => [
                [/* from_node */ 0b11, /* to_tree */ 1, /* to_node */ 0b1110111011011001]   // indirect connection over tree #1
            ],
            3 => [  // C2-LEFT
                [/* from_node */ 0b01011011, /* to_tree */ 3, /* to_node */ 0b01]
            ],
            4 => [ // C2-RIGHT
                [/* from_node */ 0b1110111011, /* to_tree */ 4, /* to_node */ 0b10]
            ]
        ),
        // Connections from tree #3 (C2-LEFT) to...
        array(
            -1 => [
                [/* from_node */ 0b01, /* to_tree */ 2, /* to_node */ 0b01011011]
            ],
            4 => [  // C2-RIGHT
                [/* from_node */ 0b01, /* to_tree */ 4, /* to_node */ 0b100110]
            ]
        ),
        // Connections from tree #4 (C2-RIGHT) to ...
        array(
            -1 => [
                [/* from_node */ 0b10, /* to_tree */ 2, /* to_node */ 0b1110111011] // indirect connection over tree #2
            ],
            3 => [  // C2-LEFT
                [/* from_node */ 0b100110, /* to_tree */ 3, /* to_node */ 0b01]
            ],
        )
    );

    // Create tree objects and store their serialized bytes in a file
    // Intended DB table structure:
    // | id | treeObj (blob) |
    require_once('../php/navNodeTree.php');
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
                if(strlen($locStr) > 0)
                    if(!isset($locDict[$locStr])) {
                        $locDict[$locStr] = array(array("tree_id" => $t, "nodeAdr" => $node[0]));
                    }
                    else {
                        $locDict[$locStr][] = array("tree_id" => $t, "nodeAdr" => $node[0]);
                    }
            }
        }
        return file_put_contents($locDictPath, serialize($locDict));
    }

    // Create a table that maps 2 given tree_ids to their connection nodes.
    // Intended DB table structure: (toTree == tree_id_to only for direct connections)
    // | id | fromTree (int) | toTree (int) | nodeAdr_from (bigint) | tree_id_to (int) | nodeAdr_to (bigint) |
    // Or as 2 tables to resolve redundancies:
    // Table 1:
    // | id | fromTree(int) | toTree(int) | connectiondetails_id (ref int) |
    // Table 2, connectiondetails:
    // | id | nodeAdr_from (bigint) | tree_id_to (int) | nodeAdr_to (bigint) |
    $conTablePath = '../data/pseudoDB/treeConnections.blob';
    function writeTreeConnectionTable() {
        global $treeConnections, $conTablePath;
        return file_put_contents($conTablePath, serialize($treeConnections));
    }

    // Call functions
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