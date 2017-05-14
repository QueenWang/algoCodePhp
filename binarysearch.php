<?php
/*
 * binary search related codding including:
 * - classic binary search problem: given a sorted non duplicated array of intergers, find a number
 * - first occurance or last occurance of a number, given a sorted array of integers
 *      //refer to binarysearch2.php for more codes 
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
$result = getLastIndex($sortedNumArr, $searchVal, count($sortedNumArr), 0, count($sortedNumArr)-1);
echo "last occurance result: $result \n";

//test binary search
$sortNumArr = array(0, 1, 2, 3, 4, 5, 6);
echo "\nsorted list of numbers: ".implode(",", $sortNumArr)."\n";
$result = binarySearch($sortNumArr, $searchVal, 0, count($sortNumArr)-1);
echo "binary result: $result \n";

//first occurance
function getFirstIndex($sortedNumArr, $searchVal, $searchStartIndex, $searchEndIndex) {
    if ($searchStartIndex > $searchEndIndex) {
        return -1;
    }

    $midIndex = floor(($searchStartIndex+$searchEndIndex) / 2);
    if ($sortedNumArr[$midIndex] == $searchVal) {
        if ($midIndex == 0 || $sortedNumArr[$midIndex-1] < $searchVal) { //match
            return $midIndex; 
        }
        else { //continue for first occurence, 1st half
            return getFirstIndex($sortedNumArr, $searchVal, $searchStartIndex, $midIndex-1);
        }
        
    }
    else if ($searchVal < $sortedNumArr[$midIndex]) {//look for 0 to midindex-1
        return getFirstIndex($sortedNumArr, $searchVal, $searchStartIndex, $midIndex-1);
    }
    else {//look for midindex+1 to lastindex
       return getFirstIndex($sortedNumArr, $searchVal, $midIndex+1, $searchEndIndex);
    }

}

//last occurance
function getLastIndex($sortedNumArr, $searchVal, $lastIndex, $searchStartIndex, $searchEndIndex) {
    if ($searchStartIndex > $searchEndIndex) {
        return -1;
    }

    $midIndex = floor(($searchStartIndex+$searchEndIndex) / 2);
    if ($sortedNumArr[$midIndex] === $searchVal) {
        if ($midIndex == $lastIndex || $sortedNumArr[$midIndex+1] > $searchVal) { //match
            return $midIndex;
        }
        else { //continue for last occurance, 2nd half
            return getLastIndex($sortedNumArr, $searchVal, $lastIndex, $midIndex+1, $searchEndIndex);
        }
    }
    else if ($searchVal < $sortedNumArr[$midIndex]) {//no equal since looking for last occurence
        return getLastIndex($sortedNumArr, $searchVal, $lastIndex, $searchStartIndex, $midIndex-1);
    }
    else {
        return getLastIndex($sortedNumArr, $searchVal, $lastIndex, $midIndex+1, $searchEndIndex);
    }

}

//binary serach
//case 1: search num from sorted list of unique numbers
//case 2: search any num occurence from sorted list of numbers with duplicates
//input: $sortNumArr, $givenNum
//output: $index

function binarySearch ($sortNumArr, $givenNum, $searchStartIndex, $searchEndIndex) {
    if ($searchStartIndex > $searchEndIndex) {
        return -1;
    }
    
    $midIndex = floor(($searchStartIndex+$searchEndIndex) / 2);
    if ($givenNum == $sortNumArr[$midIndex]) {
        return $midIndex;
    }
    else if ($givenNum < $sortNumArr[$midIndex]) {
        return binarySearch($sortNumArr, $givenNum, $searchStartIndex, $midIndex-1);
    }
    else {
        return binarySearch($sortNumArr, $givenNum, $midIndex+1, $searchEndIndex);
    }
}