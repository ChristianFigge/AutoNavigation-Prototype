<?php
/*
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

// MISC HELPER FUNCTIONS

// Get common intermediate node of 2 given node addresses
// = lower bit PAIRS that are shared between the two addresses
// e.g. 101010 & 101110 => 10
function getInterNodeAdr($startAdr, $finishAdr)
{
    $xorResult = $startAdr ^ $finishAdr;
    if ($xorResult != 0) {
        $commonAdr = 0;
        $bitMask = 0b11;
        while (($xorResult & $bitMask) == 0) {
            $commonAdr = $commonAdr | ($startAdr & $bitMask);
            $bitMask = $bitMask << 2;
        }
        return $commonAdr;
    } else {
        return NULL;
    }
}

// Returns a positive value quantifying the length of a path between 2 nodes
// (currently using in-tree traversal and NOT actual distance between coordinates)
function getPathLength($startAdr, $finishAdr, $needsInternode = True) {
    if($needsInternode) {
        $interNodeAdr = getInterNodeAdr($startAdr, $finishAdr);
        return getPathLength($startAdr, $interNodeAdr, False) + getPathLength($interNodeAdr, $finishAdr, False);
    }
    else {
        return abs(calcTreeLevel($startAdr) - calcTreeLevel($finishAdr));
    }
}

// Calculates the node's level within the tree, relative to its root node (derived from the address length)
function calcTreeLevel($adr) {
    $lvl = -1;
    $bitMask = 0b11;
    while(($adr & $bitMask) != 0) {
        $lvl++;
        $bitMask = ($bitMask << 2);
    }
    return $lvl;
}

function getTreeConnectionsFromTable($conTable, $fromTree, $toTree) {
    if(isset($conTable[$fromTree][$toTree])) {
        return $conTable[$fromTree][$toTree];
    }
    else {
        return $conTable[$fromTree][-1];
    }
}
