<?php
// command line php xx.php
//https://leetcode.com/problems/next-permutation/description/
//31. Next Permutation
//A permutation(排列) of an array of integers is an arrangement of its members into a sequence or linear order.
//next lexicographically（字典顺序) greater permutation of its integer. 
//thought process:



class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function nextPermutation(&$nums) {
        $lastIndex = count($nums)-1;
        
        $isFound = FALSE; //right part needs re-arrangement
        $leftPos = 0;
        for ($i=$lastIndex-1; $i>=0; $i--) { //search forward (right to left)
            if ($nums[$i] < $nums[$i+1]) {
                $leftPos = $i;
                $isFound = TRUE;
                break; //get the index position
            }
        }
        
        if ($isFound) {
            echo "$leftPos found leftpos \n";
            //sort the right side, meanwhile found the next bigger number
            $nextBiggerPos = $leftPos+1;
            for ($i=$leftPos+1; $i<=$lastIndex; $i++) {
                //do a bubble sort or quick sort
                if ($nums[$i] > $nums[$leftPos] && $nums[$i] <= $nums[$nextBiggerPos] ) {
                    $nextBiggerPos = $i;
                }
            }
            //swap 
            echo "$nextBiggerPos nextBiggerPos\n";
            if ($nextBiggerPos != $leftPos) {
                $temp = $nums[$leftPos];
                $nums[$leftPos] = $nums[$nextBiggerPos];
                $nums[$nextBiggerPos] = $temp;
            }

              print_r($nums);
            //sort $leftPos+1 from samllest to biggest
            //useing quick sort
            $this->quickSort($nums, $leftPos+1, $lastIndex);
        }
        else {
            $this->quickSort($nums, 0, $lastIndex);
        }
      
        
    }
    
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
}

