<?php
// command line php xx.php

$arr = [2,7,11,15];
echo "\n input array: ".implode(',',$arr)."\n";

$target = 9;

echo "\n == two sum algo == \n";
$solution = new Solution();
$result1 = $solution->twoSum($arr, $target); //use pointer, which will change the origional array 
echo "two sum result:".implode(',',$result1)."\n";



echo "\n == two sum algo hash table == \n";
$result2 = $solution->twoSumV2_hashtable($arr, $target); //use pointer, which will change the origional array 
echo "two sum result hash table:".implode(',',$result2)."\n";

/*
 *  https://leetcode.com/problems/two-sum/
 * 1. Two Sum
 * CN (having solution): https://leetcode.cn/problems/two-sum/
 * 
 * You may assume that each input would have exactly one solution, and you may not use the same element twice.
 * kun note: having duplicate
 */
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        //traverse each number, check if numbers behind sum
        //inner loop only check numbers afterwards, as before number is arleady checked
        //time complexity is O(N2), N square
        //space is O(1)
        for ($i=0; $i<count($nums)-1; $i++) {
            for ($j=$i+1; $j<count($nums)-1; $j++) {
                if ($nums[$i] + $nums[$j] == $target) {
                    return [$i, $j];
                }
            }
        }
        return [-1, -1];
        
    }
    
    /*
     * time complexity is O(N), one loop
     * space compleixtiy is O(N), from the associated array
     */
    function twoSumV2_hashtable($nums, $target) {
        $deltaArr = [];
        //store previous values in an associated array
        for ($i=0; $i<count($nums); $i++) {
            $delta = $target - $nums[$i];
            if (isset ($deltaArr[$delta])) {
                return [$deltaArr[$delta], $i];
            }
            else {
                $deltaArr[$nums[$i]] = $i;
            }
        }
        
        return [-1, -1];
    }
}