<?php
//run this in MAC since PHP has been pre-installed
//use version 5.6

/*
 * list of selection problems:
 * selection sort: select the smallest item and swap to append to the sorted list
 */
$arr = array( 6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5); 
echo "\n input array: ".implode(',',$arr)."\n";

function swapElement (&$numArr, $index1, $index2) {
    $temp = $numArr[$index1];
    $numArr[$index1] = $numArr[$index2];
    $numArr[$index2] = $temp;
}

echo "\n == quick select, get kth smallest elemetn == \n";
$resultArr = $arr;
echo "kth smallest val:" .getKthSmallest($resultArr, 1)."\n"; 
echo "quick select sort result:".implode(',',$resultArr)."\n";

$resultArr = $arr;
echo "kth smallest val:" .getKthSmallest($resultArr, 5)."\n"; 
echo "quick select sort result:".implode(',',$resultArr)."\n";

//quick select which is used to resolved get kth smallest or largest item issue
//leverage on quick selection concept, but only keep partition on the part including kth element
function getKthSmallest (&$array, $k) {
    $index = quickSelect($array, $k-1, 0, count($array)-1);
    
    return $array[$index];
}

function quickSelect (&$array, $kIndex, $startIndex, $endIndex) {
    if ($startIndex > $endIndex) {
        return -1;
    }
    //based on pivot, partition into two parts, get partition index
    $pivotIndex = quickSelect_partition($array, $startIndex, $endIndex);
    if ($pivotIndex == $kIndex) {
        return $pivotIndex;
    }
    else if ($pivotIndex > $kIndex) {
        return quickSelect($array, $kIndex, $startIndex, $pivotIndex-1);
    }
    else {
        return quickSelect($array, $kIndex, $pivotIndex+1, $endIndex);
    }
}

function quickSelect_partition (&$array, $startIndex, $endIndex) {
    //take first item as pivot value
    $pivot = $array[$startIndex];
    $leftWallIndex = $startIndex;
    
    //traverse start+1 to end items to compare with pivot
    for ($i=$startIndex+1; $i<=$endIndex; $i++) {
        if ($array[$i] <= $pivot) { //left wall shift to next and swap with $i
            $leftWallIndex++;
            swapElement($array, $i, $leftWallIndex);     
        }
    }
    //swap first pivot with left wall
    swapElement($array, $startIndex, $leftWallIndex);
    return $leftWallIndex;
}
