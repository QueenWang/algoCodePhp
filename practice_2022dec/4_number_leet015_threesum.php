<?php
// command line php xx.php

$arr = [-1,0,1,2,-1,-4];
echo "\n input array: ".implode(',',$arr)."\n";

$target = 9;

echo "\n == three sum algo == \n";
$solution = new Solution();
$result1 = $solution->threeSum($arr); //use pointer, which will change the origional array 
if (!empty($result1)) {
    echo "three sum result:". json_encode($result1)."\n";
}
else {
    echo "result is empty";
}


$arr2 = [0,0,0];
echo "\n input array: ".implode(',',$arr2)."\n";
$result2 = $solution->threeSum($arr2); //use pointer, which will change the origional array 
if (!empty($result2)) {
    echo "three sum result:". json_encode($result2)."\n";
}
else {
    echo "result is empty";
}

/*
 *  https://leetcode.com/problems/3sum/
 * 15. 3Sum
 * CN (having solution): https://leetcode.cn/problems/3sum/
 * 
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function threeSum($nums) {
        //3sum and 4sum idea is sort array first N*Log N
        //then traverse first tiem, and  use two pointers to check 2nd and 3rd
        //time complexisty is O(N2) + N*LogN
        sort($nums); //index is reset
        $lastIndex = count($nums) - 1;
        
        $result = [];
        
        for ($i=0; $i<=$lastIndex-2; $i++) { //skip last 2 items
            //set two points
            $j = $i+1;
            $k = $lastIndex;
            
            while ($j < $k) {
                $checkSum = $nums[$i] + $nums[$j] + $nums[$k];
                if ($checkSum == 0) {
                    //non duplicate, using hashtable (associated array)/
                    //is there other way to do this???
                    $itemKey = $nums[$i]."_". $nums[$j]."_". $nums[$k];
                    if (!isset($result[$itemKey])) {
                        $result[$itemKey] = [$nums[$i], $nums[$j], $nums[$k]];
                    }
                    $j++;
                    $k--;
                }
                if ($checkSum < 0) {
                    $j++;
                }
                else if ($checkSum > 0) {
                    $k--;
                }
            }
        }
        
        return array_values($result); //empty array
    }
}