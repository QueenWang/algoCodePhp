<?php
// command line php xx.php
/*
 * sorting leetcode https://leetcode.com/problemset/all/?topicSlugs=sorting&page=1 
 */

$arr = array( 6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5); 
echo "\n input array: ".implode(',',$arr)."\n";


echo "\n == testing sort algo == \n";
$solution = new Solution();
$solution->sortColors($arr); //use pointer, which will change the origional array 
echo "sort result:".implode(',',$arr)."\n";

$arr2= [1,0];
echo "\n input array: ".implode(',',$arr2)."\n";
$solution->threeColorSortV2($arr2);
echo "sort color result:".implode(',',$arr2)."\n";

/*
 * https://leetcode.com/problems/sort-colors/
 * 75. Sort Colors
 */
class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function sortColors(&$nums) {
        //$this->bubbleSort($nums);
        
        $this->quickSort($nums, 0, count($nums)-1);
    }
    
    
    /*
    * == bubble sort (not efficient low chance of having this)==
    * //in place sorting, PHP array need to set pointer eg. &$numArr
    * concept: compare numbers from 1st to the last, move largest number to the right. 
    * One loop will push biggest number into the last
    * 2nd loop push 2nd biggest number n-1
    */
    /*
     * Runtime
       Runtime
        20 ms
        Beats
        28.57%
        Memory
        19.3 MB
        Beats
        31.43%
     */
    function bubbleSort (&$nums) {
        //swap current number and next number until one largest number to the right for each 
        $lastIndex = count($nums) - 1;
        for ($i = $lastIndex; $i >= 0; $i--) {
            for ($j=0; $j<=$i-1; $j++) {
                if ($nums[$j] > $nums[$j+1]) {
                    //do a sawp
                    $temp = $nums[$j];
                    $nums[$j] =  $nums[$j+1];
                     $nums[$j+1] =  $temp;
                }
            }
        }
        
    }
    
    /*
     * IMP, sorting implements this like php array sort
     * concept: taking one value (eg. start) as pivot value, partition into two sets smaller numbers(leftwall index), keep swaping
     * swap pivot value with leftwall
     * split into two parts using the index, loop to do this
     */
    /*
     * Runtime
        27 ms
        Beats
        8.57%
        Memory
        19 MB
        Beats
        82.86%
     */
    function quickSort (&$nums, $startIndex, $endIndex) {
        if ($startIndex >= $endIndex) {
            return;
        }
        
        //taking first item as pivot
        $pivotValue = $nums[$startIndex];
        $leftWallIndex = $startIndex;
        
        for ($i=$startIndex+1; $i<=$endIndex; $i++) {
            if ($nums[$i] <= $pivotValue) {
                $leftWallIndex++;
                if ($leftWallIndex != $i) {
                    //do a swap with leftwall and i
                    $temp = $nums[$leftWallIndex];
                    $nums[$leftWallIndex] = $nums[$i];
                    $nums[$i] = $temp;                   
                }
            }
        }
        
        //swap pivot to the leftwall position
        $nums[$startIndex] = $nums[$leftWallIndex];
        $nums[$leftWallIndex] = $pivotValue;
        
        
        //call this function again to sort two sets
        $this->quickSort($nums, $startIndex, $leftWallIndex-1);
        $this->quickSort($nums, $leftWallIndex+1, $endIndex);
    }
    
    
    //based on 3 values only 0, 1, 2
    function threeColorSort (&$nums) {
       //sort 0, find and swap to left
        $leftWallIndex = 0;
        for ($i=0; $i<count($nums); $i++) {
            if ($nums[$i] == 0 ) {
                if ($leftWallIndex != $i) {
                    //swap
                    $nums[$i] = $nums[$leftWallIndex];
                    $nums[$leftWallIndex] = 0;
                }
                $leftWallIndex++;
            }
        }
        
        //sort 1
        for ($i=$leftWallIndex; $i<count($nums); $i++) {
            if ($nums[$i] == 1) {
                if ($leftWallIndex != $i ) {
                    //swap
                    $nums[$i] = $nums[$leftWallIndex];
                    $nums[$leftWallIndex] = 1;
                }
                $leftWallIndex++;
            }
        }
        
        //no need to sort 2, rest is 2
    }
    
    
    //based on 3 values only 0, 1, 2
    //using one loop to traverse
    function threeColorSortV2 (&$nums) {
       //sort 0, find and swap to left
        $p0Index = -1;
        $p1Index = -1;
        for ($i=0; $i<count($nums); $i++) {
            if ($nums[$i] == 0 ) {
                $p0Index++;
                $p1Index++;
                if ($p0Index != $i) {
                    if ($p1Index > $p0Index) {
                        //swap $p0Index to $p1Index
                        $nums[$p0Index] = $nums[$p1Index];
                        $nums[$p1Index] = 1;                             
                    }
                    if ($p1Index != $i) {
                        //swap $p0Index to i
                        $nums[$i] = $nums[$p0Index];
                        $nums[$p0Index] = 0;
                    }
                }
                
            }
            else if ($nums[$i] == 1 ) {
                $p1Index++;
                if ($p1Index != $i) {
                    //swap
                    $nums[$i] = $nums[$p1Index];
                    $nums[$p1Index] = 1;
                }
                
            }
        }   
        //no need to sort 2, rest is 2
    }
    
    
}