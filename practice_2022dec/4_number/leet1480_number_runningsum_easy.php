<?php
// command line php xx.php
//https://leetcode.com/problems/running-sum-of-1d-array/?company_slug=bytedance

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function runningSum($nums) {
        $result = [];
        $sum = 0;
        foreach ($nums as $val) {
            $sum += $val;
            $result[] = $sum;
        }
        
        return $result;
    }
}
