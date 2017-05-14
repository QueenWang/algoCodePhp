<?php
//run this in MAC since PHP has been pre-installed
//use version 5.6
/*
 * list of number problems:
 * 1. isIntervalOverlap: two interval, check if it is overlapped
 * 2. isSeqSumMatch: whether there is a *continuous sequence* of numbers with a fixed sum value
 */
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

//Given two arrays, return an array that contains all elements that are in the intersection of both

//input: $array1, $array2
//output: $intersectArr
