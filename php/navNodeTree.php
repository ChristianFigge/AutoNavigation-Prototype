<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */
    require_once('navNode.php');
    require_once('navUtils.php');

    class NavNodeTree {
        private $nodes;

        function __construct() {
            $this->nodes = array();
        }

        function addNode($nodeAdr, $x, $y) {           
            $this->nodes[$nodeAdr] = new NavNode($nodeAdr, $x, $y);
        }

        function calcPath($startAdr, $finishAdr, $needsInterNode = True, $includeStartAdr = True) {
            $adrArray = array(); // node addresses
 
            if($needsInterNode) {
                $interNodeAdr = getInterNodeAdr($startAdr, $finishAdr);

                // 1) Calculate path from startNode to interNode
                // 2) Calculate path from interNode to finishNode and append it (excluding the redundant interNode)
                if(!is_null($interNodeAdr)) {
                    $adrArray = $this->calcPath($startAdr, $interNodeAdr, False, True); 
                    $adrArray = array_merge($adrArray, $this->calcPath($interNodeAdr, $finishAdr, False, False));
                }                      
            }
            else {
                if($includeStartAdr)
                    $adrArray[] = $startAdr;

                // We need the tree level = length of each address to progress
                // (2 bits per tree level, stored in the Node objects at construction)
                $startTreeLvl = $this->nodes[$startAdr]->getTreeLevel();
                $finishTreeLvl = $this->nodes[$finishAdr]->getTreeLevel();

                // If the startNode is below the finishNode within the tree (i.e. has a longer address),
                // consecutively delete its highest bit pairs and store the resulting node addresses in $adrArray
                // until we "arrived" at the tree level of the finishNode (which equals the finishNode if $needsInterNode is False)
                if($startTreeLvl > $finishTreeLvl) {
                    $bitpairPos = $startTreeLvl;
                    while($bitpairPos > $finishTreeLvl) {
                        $bitMask = ($startAdr & (0b11 << ($bitpairPos * 2)));
                        $startAdr = ($startAdr ^ $bitMask);
                        $adrArray[] = $startAdr;
                        $bitpairPos--;
                    }
                }
                // Same logic as above in reverse:
                // If the startNode is above the finishNode within the tree (i.e. has a shorter address),
                // consecutively add the finishNode's bit pairs to the startNode's and store the resulting node addresses in $adrArray
                // until we "arrived" at the tree level of the finishNode (which equals the finishNode if $needsInterNode is False)
                elseif ($startTreeLvl < $finishTreeLvl) {
                    $bitpairPos = $startTreeLvl + 1;
                    while($bitpairPos <= $finishTreeLvl) {
                        $startAdr = ($startAdr | ($finishAdr & (0b11 << ($bitpairPos * 2))));
                        $adrArray[] = $startAdr; 
                        $bitpairPos++;
                    }   
                }
            }
            return $adrArray;
        }

        function getNode($adr) {
            if(isset($this->nodes[$adr])) 
                return $this->nodes[$adr];
            else 
                return NULL;
        }
    }
?>