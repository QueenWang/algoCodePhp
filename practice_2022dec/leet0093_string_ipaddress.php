<?php
// command line php xx.php
/*
 * https://leetcode.com/problems/restore-ip-addresses/?company_slug=bytedance
 */


class Solution {

    /**
     * @param String $s
     * @return String[]
     */
    function restoreIpAddresses($s) {
        $result = [];
        $length = strlen($s);
        if ($length < 4 || $length > 12) { //
            return $result;
        }
        
    }
}