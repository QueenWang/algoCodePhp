<?php
// command line php xx.php {target value} {optional case3}
/*
 * https://leetcode.com/tag/binary-search/ 
 * practice medium difficulty problems
 */


//problem 1: https://leetcode.com/problems/search-in-rotated-sorted-array/
//33. Search in Rotated Sorted Array

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
        /* example [4,5,6,7,0,1,2]
         * case startValue < endValue: sorted ==>  using midValue to decide left or right
         * case startValue > endValue: rotated sorted ==> check midValue for different cases
         *      case startValue < midValue: left sorted ==> check if left sorted, else check right rotated
         *      case midValue <  endValue: right sorted ==> check if right sorted, else check left rotated
         *  
         */
        if ($startIndex > $endIndex) { //sanity check, stop checking
            return -1;
        }
        
        $midIndex = floor(($startIndex + $endIndex) / 2);
        
        if ($nums[$midIndex] == $target) { //found a match
            return $midIndex;
        }

        if ($nums[$startIndex] < $nums[$endIndex]) { //nums array is sorted
            if ($nums[$midIndex] > $target) { //check first half
                return $this->binarySearch($nums, $target, $startIndex, $midIndex-1);
            }
            else if ($nums[$midIndex] < $target) {
                return $this->binarySearch($nums, $target, $midIndex+1, $endIndex);
            }
            else {
                return -1;
            }
        }
        
       if ($nums[$startIndex] > $nums[$endIndex]) { //nums array is rotated
           if ($nums[$startIndex] <= $nums[$midIndex]) { //left is sorted, cover single value case
               if ($nums[$startIndex] <= $target && $target < $nums[$midIndex] ) { //within left range
                   return $this->binarySearch($nums, $target, $startIndex, $midIndex-1); 
               }
               else {
                   return $this->binarySearch($nums, $target, $midIndex+1, $endIndex);
               }
           }
           else if ($nums[$midIndex] <= $nums[$endIndex]) { //right is sorted, cover single value case
               if ($nums[$midIndex] < $target && $target <= $nums[$endIndex] ) { //within right range
                   return $this->binarySearch($nums, $target, $midIndex+1, $endIndex); 
               }
               else {
                   return $this->binarySearch($nums, $target, $startIndex, $midIndex-1);
               }
           }
       }
        
       return -1;
            
    }
    
}
    

