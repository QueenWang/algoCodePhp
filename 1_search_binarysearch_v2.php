<?php

/*
 * this file is to improve binarysearch.php coding flow, for getFirstIndex and getLastIndex
 * minor improvements to make clean and short codes
 */
/*
 * 
Input:
$sortNum, $givenNum
Output:
$index
 */
//http://www.geeksforgeeks.org/find-first-last-occurrences-element-sorted-array/

$sortedNumArr = [4, 4, 4, 4, 4, 6, 6, 7, 7, 7, 8, 9, 10];
echo "sorted list of numbers: ".implode(",", $sortedNumArr)."\n";
$searchVal = (int) $argv[1];
$result = getFirstIndex($sortedNumArr, $searchVal, 0, count($sortedNumArr)-1);
echo "firt occurance result: $result \n";
$result = getLastIndex($sortedNumArr, $searchVal, 0, count($sortedNumArr)-1);
echo "last occurance result: $result \n";

$result = getLastIndex2($sortedNumArr, $searchVal, 0, count($sortedNumArr)-1);
echo "last occurance 2 result: $result \n";

//test case 2
$sortedNumArr = [1, 4, 4, 4, 4, 4, 6, 6, 7, 7, 7, 8, 9, 10];
echo "sorted list of numbers: ".implode(",", $sortedNumArr)."\n";
$searchVal = (int) $argv[1];
$result = getFirstIndex($sortedNumArr, $searchVal, 0, count($sortedNumArr)-1);
echo "firt occurance result: $result \n";
$result = getLastIndex($sortedNumArr, $searchVal, 0, count($sortedNumArr)-1);
echo "last occurance result: $result \n";

$result = getLastIndex2($sortedNumArr, $searchVal, 0, count($sortedNumArr)-1);
echo "last occurance 2 result: $result \n";


//first occurance
function getFirstIndex($sortedNumArr, $searchVal, $searchStartIndex, $searchEndIndex) {
    if ($searchStartIndex == $searchEndIndex) {
        return $sortedNumArr[$searchStartIndex] == $searchVal ? $searchStartIndex : -1;
    }
    
    // use floor here, startIndex <= midIndex < endIndex
    $midIndex = floor(($searchStartIndex+$searchEndIndex) / 2);
    if ($searchVal <= $sortedNumArr[$midIndex]) {//look for first half, start to midindex
        //range is [startIndex, endIndex -1]
        return getFirstIndex($sortedNumArr, $searchVal, $searchStartIndex, $midIndex);
    }
    else {//look for midindex+1 to lastindex
        //range is [startIndex+1, endIndex]
       return getFirstIndex($sortedNumArr, $searchVal, $midIndex+1, $searchEndIndex);
    }

}


//last occurance, use getLastIndex2 function which is more elegant
function getLastIndex($sortedNumArr, $searchVal, $searchStartIndex, $searchEndIndex) {
    //base case
    if ($searchStartIndex >= $searchEndIndex) {
        return $sortedNumArr[$searchStartIndex] == $searchVal ? $searchStartIndex : -1;
    }
    else if (($searchEndIndex - $searchStartIndex) == 1) { //two items
        return $sortedNumArr[$searchEndIndex] == $searchVal 
                ? $searchEndIndex : 
                ($sortedNumArr[$searchStartIndex] == $searchVal ? $searchStartIndex : -1 );
    }
    
    //using floor here, thus it is possible start index == mid index, infinite loop
    //midindex - 1 definitely < end index, but possible < start index also
    $midIndex = floor(($searchStartIndex+$searchEndIndex) / 2);
    if ($searchVal < $sortedNumArr[$midIndex]) { //search first half, startIndex to midIndex - 1
        //echo "debug: ".$searchStartIndex ."," .($midIndex - 1)."\n";
        return getLastIndex($sortedNumArr, $searchVal, $searchStartIndex, $midIndex - 1);
    }
    else { //search $midIndex to end index
        //echo "debug: ".$midIndex ."," .($searchEndIndex)."\n";
        return getLastIndex($sortedNumArr, $searchVal, $midIndex, $searchEndIndex);
    }

}

//last occurance, improved version
function getLastIndex2($sortedNumArr, $searchVal, $searchStartIndex, $searchEndIndex) {
    //base case
    if ($searchStartIndex == $searchEndIndex) {
        return $sortedNumArr[$searchStartIndex] == $searchVal ? $searchStartIndex : -1;
    }
    
    //using ceil here, startIndex < midIndex <= endIndex
    //midindex - 1 definitely < end index
    $midIndex = ceil(($searchStartIndex+$searchEndIndex) / 2);
    if ($searchVal < $sortedNumArr[$midIndex]) { //search first half, startIndex to midIndex - 1, range is [starIndex, endIndex-1]
        //echo "debug: ".$searchStartIndex ."," .($midIndex - 1)."\n";
        return getLastIndex($sortedNumArr, $searchVal, $searchStartIndex, $midIndex - 1);
    }
    else { //search $midIndex to end index, range is [startindex+1, end index]
        //echo "debug: ".$midIndex ."," .($searchEndIndex)."\n";
        return getLastIndex($sortedNumArr, $searchVal, $midIndex, $searchEndIndex);
    }

}
