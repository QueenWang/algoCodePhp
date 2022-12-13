<?php
// command line php xx.php {target value} {optional case3}
/*
 * https://leetcode.com/tag/binary-search/ 
 * practice medium difficulty problems
 */


//problem 1: https://leetcode.com/problems/search-in-rotated-sorted-array-ii/
//81. Search in Rotated Sorted Array II

$target = (int) $argv[1];

if (isset($argv[2]) && $argv[2] == 'case3') { //2nd parameter
    $nums = [1];
}
else { //default 
 $nums = [4,5,6,7,0,1,2];
}

$solution = new Solution();
$result = $solution->search($nums, $target);


echo "\n***** binary search - rotated distinct number array *****\n";
echo "sorted list of numbers: ".implode(",", $nums)."\n";
echo "last occurance result: $result \n";

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target) {
        
        return $this->binarySearch($nums, $target, 0, count($nums)-1);
    }
    
    function binarySearch ($nums, $target, $startIndex, $endIndex) {
       
            
    }
    
}
    

