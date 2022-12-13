<?php
// command line php xx.php
/*
 * quickselect leetcode https://leetcode.com/problemset/all/?page=1&topicSlugs=quickselect 
 */

$arr = array( 6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5); 
echo "\n input array: ".implode(',',$arr)."\n";


echo "\n == testing sort algo == \n";
$solution = new Solution();
$result1 = $solution->findKthLargest($arr, 5); //use pointer, which will change the origional array 
echo "sort result:".$result1."\n";

$arr2= [1,0];
echo "\n input array: ".implode(',',$arr2)."\n";
$result2 = $solution->findKthLargest($arr2, 5);
echo "sort color result:".$result2."\n";

/*
 *  https://leetcode.com/problems/kth-largest-element-in-an-array/
 * 215. Kth Largest Element in an Array
 * CN (having solution): https://leetcode.cn/problems/kth-largest-element-in-an-array/
 */
class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function findKthLargest($nums, $k) {
        /*
         * do a quick sort/selection, check pivot index, process left or right
         */
        
        return $this->quickSelection($nums, $k-1, 0, count($nums)-1); //kth largest, index is k-1
        
    }
    
    function quickSelection (&$nums, $kIndex, $startIndex, $endIndex) {
        if ($startIndex > $endIndex) {
            return -1;
        }
        else if ($startIndex == $endIndex) {
            return $startIndex == $kIndex ? $nums[$kIndex] : -1;
        }
        
        /*
         * taking first item as pivot, from big to small, left side all values bigger
         * swap value
         */
        $leftWallIndex = $startIndex;
        $pivotValue = $nums[$startIndex];
        
        for ($i=$leftWallIndex+1; $i<=$endIndex; $i++) {
            if ($nums[$i] >= $pivotValue) { //1st part is biggest number (from big to small)
                //swap $i to leftwallIndex
                $leftWallIndex ++;
                $temp = $nums[$leftWallIndex];
                $nums[$leftWallIndex] = $nums[$i];
                $nums[$i] = $temp;
            }
        }
        //at last do a swap with $startIndex and $leftWallIndex
        $nums[$startIndex] = $nums[$leftWallIndex];
        $nums[$leftWallIndex] = $pivotValue;
        
        if ($leftWallIndex == $kIndex) {
            return $nums[$leftWallIndex];
        }
        else if ($leftWallIndex > $kIndex) {
            //process left side
            return $this->quickSelection ($nums, $kIndex, $startIndex, $leftWallIndex-1);
        }
        else {
            //process right side
            return $this->quickSelection ($nums, $kIndex, $leftWallIndex+1, $endIndex);
        }
        
    }
    
    
}