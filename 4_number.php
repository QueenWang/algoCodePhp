<?php

//run this in MAC since PHP has been pre-installed
//use version 5.6
/*
 * list of number problems:
 * 1. getMinMax from an array
 * 2. isIntervalOverlap: two interval, check if it is overlapped
 * 3. isSeqSumMatch: whether there is a *continuous sequence* of numbers with a fixed sum value
 * 4. get kth smallest/largest number
 */

//find min/max from a list of numbers
echo "\n getMinMax \n";
$arr = [1, 3, 2, 6, 8, 4, 10];
echo "input array: ".implode(",", $arr)."\n";
$result = getMinMax($arr);
echo "output: min=".$result[0].", max=".$result[1]."\n";
function getMinMax ($numArr) {
    if (empty($numArr) || !is_array($numArr)) {
        return false;
    }
    $firstNum = array_shift($numArr);
    $minNum = $firstNum;
    $maxNum = $firstNum;
    While (!empty($numArr)) {
        $num = array_shift($numArr); //shift an element off from beginning and return the value
        if ($num < $minNum) {
            $minNum = $num;
        }
        else if ($num > $maxNum) {
            $maxNum = $num;
        }
    }
    return [$minNum, $maxNum];
}

/*
 * == isIntervalOverlap ==
 */
echo "\n isIntervalOverlap \n";
echo isIntervalOverlap(1, 5, 3, 4) ? "TRUE" : "FALSE";
echo "\n";

echo isIntervalOverlap(4, 5, 3, 6) ? "TRUE" : "FALSE";
echo "\n";

echo isIntervalOverlap(4, 5, 7, 9) ? "TRUE" : "FALSE";
echo "\n";

function isIntervalOverlap($start1, $end1, $start2, $end2) {
    if ($start2 <= $start1 && $end2 >= $start1) {
        return true;
    }
    else if ($start2 >= $start1 && $end1 >= $start2) {
        return true;
}
    else {
        return false;
    }
}

/*
 * == isSeqSumMatch == 
 */
//Question:  Given a sequence of positive integers A and an integer T, 
//return whether there is a *continuous sequence* of A that sums up to exactly T. 
//Example: [23, 5, 4, 7, 2, 11], 20. Return True because 7 + 2 + 11 = 20
//[1, 3, 5, 23, 2], 8. Return True  because 3 + 5 = 8
//[1, 3, 5, 23, 2], 7 Return False because no sequence in this array adds up to 7
//Note: We are looking for an O(N) solution. There is an obvious O(N^2) solution 
//which is a good starting point but is not the final solution we are looking for.

echo "\n isSeqSumMatch \n";
echo (isSeqSumMatch(array(23, 5, 4, 7, 2, 11), 20) ? "TRUE" : "FALSE")."\n";
echo (isSeqSumMatch(array(1, 3, 5, 23, 2), 8) ? "TRUE" : "FALSE")."\n";
echo (isSeqSumMatch(array(1, 3, 5, 23, 2), 7) ? "TRUE" : "FALSE")."\n";

//input: $intArr, $sum
//output: boolean
function isSeqSumMatch ($intArr, $sum) {
    $sumInt = array();
    foreach ($intArr as $int) {
        $sumInt[] = $int;
        $checkSum = array_sum($sumInt);
        while ($checkSum > $sum) {
            array_shift($sumInt); //remove 1st int
            $checkSum = array_sum($sumInt);
        }
        if ($checkSum == $sum) {
            print_r($sumInt);
            return true;
        }
    }
    return false;
}


/**
 * Note below parity codes only works for positive number
 * negative ones bits has two's compliment, and can not use value conidtion.
 * ==> check bit length instead
 * basics_bit_parity
 */
echo "\n computeParity, odd is 1, even is 0 \n";
$result = bit_getParity(8);
echo "result=$result \n";
//odd count, return 1, even is 0
function bit_getParity ($num) {
    $count = 0; //1 bits count
    while ($num >0) {
       $count += ($num & 1);
       $num = ($num >> 1); // //shift to the left, divide by 2
    }
    
    $isOdd = ($count & 1);
    return $isOdd;
}



//from kartini
$result = computeParity(8);
echo "kartini result=$result \n";
function computeParity ($num) {
    $count = 0;
    while ($num > 0) {
         echo "debug: ".$num.", binaray=".decbin($num)."\n";
        $count += ($num & 1); //right most bit 1 count
        $num = $num >> 1; //shift to the left, divide by 2
    }
    echo "debug count=$count count&1=".($count&1)." count^1=".($count^1)." (count%2)=".(count%2)."\n";
    return ($count & 1);
}

function computeParity2 ($num) {
    $parity = 0;
    while ($num > 0) {
        $parity = $parity ^ 1;
        $num = $num & ($num-1);    // Clear the lowest bit “1”
    }
    return $parity;
}


//get kth smallest from an unsorted array
//idea1: sort the array and then get $k-1 index element, n*logn
//idea2: if array is very big, then 
function getSmallest ($array, $k) {
    
}
