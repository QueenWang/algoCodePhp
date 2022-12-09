<?php
// command line php xx.php

echo "\n == three sum algo == \n";
$arr = [1,0,-1,0,-2,2];
$target = 0;
echo "\n input array: ".implode(',',$arr)."\n";
echo "\n target: ".$target."\n";


$solution = new Solution();
$result1 = $solution->fourSum($arr, $target); //use pointer, which will change the origional array 
if (!empty($result1)) {
    echo "three sum result:". json_encode($result1)."\n";
}
else {
    echo "result is empty";
}


$arr2 = [2,2,2,2,2];
$target2 = 8;
echo "\n input array: ".implode(',',$arr2)."\n";
echo "\n target: ".$target2."\n";
$result2 = $solution->fourSum($arr2, $target2); //use pointer, which will change the origional array 
if (!empty($result2)) {
    echo "three sum result:". json_encode($result2)."\n";
}
else {
    echo "result is empty";
}

/*
 *  https://leetcode.com/problems/4sum/
 * 18. 4Sum
 * CN (having solution): https://leetcode.cn/problems/4sum/
 * 
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[][]
     */
    function fourSum($nums, $target) {
        
        //thought process is the same as the 3sum, sort first
        //then two loops, and using pointers to check for sum
        $lastIndex = count($nums) - 1;
        sort($nums); //index reset
        
        $result = [];
        for ($a=0; $a<=$lastIndex-3; $a++) {
            for ($b=$a+1; $b<=$lastIndex-2; $b++) {
                $c = $b + 1;
                $d = $lastIndex;
                
                while ($c < $d) {
                    $checkSum = $nums[$a] + $nums[$b] + $nums[$c] + $nums[$d];
                    if ($checkSum == $target) {
                        //using hash table(associated array) to ensure uniqueness of values
                        $itemKey = $nums[$a]."_".$nums[$b]."_".$nums[$c]."_".$nums[$d];
                        if (!isset($result[$itemKey])) {
                            $result[$itemKey] = [$nums[$a],  $nums[$b], $nums[$c], $nums[$d]];
                        }
                        $c ++;
                        $d --;
                    }
                    else if ($checkSum > $target) {
                        $d--;
                    }
                    else {
                        $c++;
                    }
                }
                
            }
        }
        
        return array_values($result);
    }
}