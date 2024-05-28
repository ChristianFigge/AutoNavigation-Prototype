<?php
/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */
    require_once('navUtils.php');

    class NavNode {
        //private $adr = 0b0; // saved in the NavNodeTree, not necessary here (yet?)
        private $treeLvl = 0;
        private $posX = 0;
        private $posY = 0;

        function __construct($p_adr,  $p_x, $p_y) {
            //$this->adr = $p_adr;
            $this->treeLvl = calcTreeLevel($p_adr);
            $this->posX = $p_x;
            $this->posY = $p_y;
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