<?php

/*
 * $argv: 
 */

//two sum: Given an array of integers, find two numbers such that they add up to a specific target number.
//input $numArr, $sum
//ouput two numbers' index
//idea: naive one is to traverse thru the array, and for each number check all before numbers for sum
//complexity is N^2
//more efficient way is to use hashtable(associate array to store the number), use complement (补数)
//complexity is O(N)

$numArr = [2, 7, 11, 15];
$sum = 9;
$result = twosum($numArr, $sum);
echo "input: ".implode(",", $numArr)."\n";
echo "result: ".implode(",", $result)."\n";

$numArr = [-2, -7, 11, 15, -7, -2, 5, 10, 2];
$sum = 04;
$result = twosum($numArr, $sum);
echo "input: ".implode(",", $numArr)."\n";
echo "result: ".implode(",", $result)."\n";

function twosum($numArr, $sum) {
    $hash = array();
    foreach ($numArr as $index=>$num) {
        $delta = $sum - $num;
        if (isset($hash[$delta])) {
            return [$hash[$delta], $index];
        }
        else {
            $hash[$num] = $index;
        }
    }
    return array();
}

echo "\n twosumSorted \n";
$numArr = [2, 7, 11, 15];
$sum = 9;
echo "input: ".implode(",", $numArr).", sum=$sum \n";
$result = twosumSorted($numArr, $sum);
echo "result: ".implode(",", $result)."\n";

//idea is to check from two sides, compare sum with given value and decide
function twosumSorted ($sortedNumArr, $sum) {
    $i = 0;
    $j = count($sortedNumArr) - 1;
    
    while ($i < $j) {
        //echo "debug: i=$i, j=$j \n";
        $sumCheck = $sortedNumArr[$i] + $sortedNumArr[$j];
        if ($sum > $sumCheck) {
            $i++;
        }
        else if ($sum < $sumCheck) {
            $j--;
        }
        else {
            return array($i, $j);
        }
    }
    return array();//no match
}

/*
 * Given an array S of n integers, are there elements a, b, c in S such that a + b + c = 0? 
 * Find all unique triplets in the array which gives the sum of zero.

Note:
Elements in a triplet (a,b,c) must be in non-descending order. (ie, a ≤ b ≤ c)
The solution set must not contain duplicate triplets.

    For example, given array S = {-1 0 1 2 -1 -4},

    A solution set is:
    (-1, 0, 1)
    (-1, -1, 2)


//idea is to sort array and loop with one value fixed, then check from two sides, same for 4sum which adds one more outer loop
http://www.programcreek.com/2012/12/leetcode-3sum/
http://www.programcreek.com/2013/02/leetcode-4sum-java/
In php: https://www.fitcoding.com/2015/02/22/four-sum/
 */

echo "\n threeSum \n";
$numArr = [-1, 0, 1, 2, -1, -4];
$sum = 0;
echo "input: ".implode(",", $numArr).", sum=$sum \n";
$result = threeSum($numArr, $sum);
foreach ($result as $list) {
    echo "threeSum result: ".implode(",", $list)."\n";
}
function threeSum ($numArr, $sum) {
    $length = count($numArr);
    if ($length <3) {
        return [];
    }
    $result = array();
    //sort the array, sort() with no origional index, use asort to maintain the index
    sort($numArr);
    for ($i=0; $i<$length-2; $i++) {
        $j = $i+1;
        $k = $length - 1;
        
        while ($j < $k) {
            $checkSum = ($numArr[$i] + $numArr[$j] + $numArr[$k]);
            if ($checkSum < $sum) {
                $j++;
            }
            else if ($checkSum > $sum) {
                $k--;
            }
            else {
                $set = array($numArr[$i] , $numArr[$j] , $numArr[$k]);
                if (!in_array($set, $result)) { //possible to improved??
                    $result[] = $set;
                }
                $j++;
                $k--;
            }
        }
    }
    return $result;
}

//same for 4 sum, which just add one outer loop
echo "\n fourSum \n";
$numArr = [-1, 0, 1, 2, -1, -4];
$sum = 0;
echo "input: ".implode(",", $numArr).", sum=$sum \n";
$result = fourSum($numArr, $sum);
foreach ($result as $list) {
    echo "fourSum result: ".implode(",", $list)."\n";
}
function fourSum ($numArr, $sum) {
    $length = count($numArr);
    if ($length <4) {
        return [];
    }
    $result = array();
    //sort the array, sort() with no origional index, use asort to maintain the index
    sort($numArr);
    for ($i=0; $i<$length-3; $i++) {
        for ($i2=1; $i2<$length-2; $i2++) {
            $j = $i2+1;
            $k = $length - 1;

            while ($j < $k) {
                $checkSum = ($numArr[$i] + $numArr[$i2] +$numArr[$j] + $numArr[$k]);
                if ($checkSum < $sum) {
                    $j++;
                }
                else if ($checkSum > $sum) {
                    $k--;
                }
                else {
                    $set = array($numArr[$i] , $numArr[$i2], $numArr[$j] , $numArr[$k]);
                    if (!in_array($set, $result)) { //possible to improved??
                        $result[] = $set;
                    }
                    $j++;
                    $k--;
                }
            }
        }
    }
    return $result;
}

