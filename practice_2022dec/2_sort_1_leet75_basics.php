<?php
// command line php xx.php
/*
 * sorting leetcode https://leetcode.com/problemset/all/?topicSlugs=sorting&page=1 
 */

$arr = array( 6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5); 
echo "\n input array: ".implode(',',$arr)."\n";


echo "\n == bubble sort, in place,  O(N*N) not efficient == \n";
$solution = new Solution();
$solution->sortColors($arr); //use pointer, which will change the origional array 
echo "sort result:".implode(',',$arr)."\n";


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
        $this->bubbleSort($nums);
    }
    
    
    /*
    * == bubble sort (not efficient low chance of having this)==
    * //in place sorting, PHP array need to set pointer eg. &$numArr
    * concept: compare numbers from 1st to the last, move largest number to the right. 
    * One loop will push biggest number into the last
    * 2nd loop push 2nd biggest number n-1
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

}


