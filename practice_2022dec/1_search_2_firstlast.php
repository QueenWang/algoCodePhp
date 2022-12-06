<?php

// command line php xx.php {target value} {optional case3}
/*
 * https://leetcode.com/tag/binary-search/ 
 * practice medium difficulty problems
 */


//problem 2: https://leetcode.com/problems/find-first-and-last-position-of-element-in-sorted-array/
//34. Find First and Last Position of Element in Sorted Array
/*
 * Kun note: 
 * - one function for starting, one function for ending
 * - having duplicate numbers
 * - nums in ascending order (small to big)
 */

$target = (int) $argv[1];

if (isset($argv[2]) && $argv[2] == 'case3') { //2nd parameter
    $nums = [];
}
else { //default 
 $nums = [5,7,7,8,8,10];
}

$solution = new Solution();
$result = $solution->searchRange($nums, $target);


echo "\n***** binary search - first and last occurancew *****\n";
echo "sorted list of numbers: ".implode(",", $nums)."\n";
echo "firt occurance result: $result[0] \n";
echo "last occurance result: $result[1] \n";


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function searchRange($nums, $target) {
        $targetStartPos = $this->binarySearch($nums, $target, 0, count($nums)-1, TRUE);
        $targetEndPos = $this->binarySearch($nums, $target, 0, count($nums)-1, FALSE);
        
        return [$targetStartPos, $targetEndPos];
    }
    
    function binarySearch ($nums, $target, $startIndex, $endIndex, $isStartingPosition=TRUE) {
        /*
         * find first occurance on the left, find last occurance on the right
         */
        if ($startIndex > $endIndex) { //safety check
            return -1;
        }
        
        $midIndex = floor (($startIndex + $endIndex) / 2);
        
        if ($isStartingPosition) {
            if ($nums[$midIndex] == $target) {
                if (!isset($nums[$midIndex-1])) {
                    return $midIndex;
                }
                else if ($nums[$midIndex-1] != $target) {
                    return $midIndex;
                }
            }
            if ($nums[$midIndex] >= $target) { //search left for starting position
                return $this -> binarySearch($nums, $target, $startIndex, $midIndex-1, TRUE);
            }
            else {
                return $this -> binarySearch($nums, $target, $midIndex+1, $endIndex, TRUE);
            }
        }
        else { //ending position
            if ($nums[$midIndex] == $target) {
                if (!isset($nums[$midIndex+1])) {
                    return $midIndex;
                }
                else if ($nums[$midIndex+1] != $target) {
                    return $midIndex;
                }
            }
            if ($nums[$midIndex] <= $target) { //search left for starting position
                return $this -> binarySearch($nums, $target, $midIndex+1, $endIndex, FALSE);
            }
            else {
                return $this -> binarySearch($nums, $target, $startIndex, $midIndex-1, FALSE);
            }
        }
        
        return -1;
    }
    
}
    






