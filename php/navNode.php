<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */
    class NavNode {
        public $adr = 0b0;
        public $treeLvl = 0;
        public $posX = 0;
        public $posY = 0;

        function __construct($p_adr,  $p_x, $p_y) {
            $this->adr = $p_adr;
            $this->treeLvl = $this->calcTreeLevel($p_adr);
            $this->posX = $p_x;
            $this->posY = $p_y;
        }

        function calcTreeLevel($adr) {
            $lvl = 0;
            $bitMask = 0b1100;  // cuts root bits (those could be 00)
            while(($adr & $bitMask) != 0) {
                $lvl++;
                $bitMask = ($bitMask << 2);
            }
            return $lvl;
        }

        function getPos() {
            return array($this->posX, $this->posY);
        }

        function setPos($x, $y) {
            $this->posX = $x;
            $this->posY = $y;
        }

        function getTreeLevel() {
            return $this->treeLvl;
        }
    }
?>