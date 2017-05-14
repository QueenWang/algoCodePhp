<?php
//run this in MAC since PHP has been pre-installed
//use version 5.6

/*
 * list of sort problems:
 * 1. quick sort: in place sorting, set a pivot (normally middle number or meidum num), move pivot to start first element, 
 *      keep left wall index, swap with the start element. Use this leftwall index as partition and recurse
 * 
 * 2. merge sort: divide to half array_slice, merge left and right sorted array 
 * 3. bubble sort: in place, not efficient. adjacement comparison, push the largest to the end. Loop again
 * 4. inserstion srot: in place, not efficient. sorted and unsorted list, element comparing with each item in front
 * 5. selection sort: select the smallest item and swap to append to the sorted list
 */
$arr = array( 6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5); 
echo "\n input array: ".implode(',',$arr)."\n";

/*
 * == merge sort ==
 */
echo "\n == merge sort, NOT in place, needs extra space == \n";
$sortedArr = mergesort($arr);
echo "mergesort result:".implode(',',$sortedArr)."\n";

//input $numArr
//output $sortedArr
//use merge sort using recursion to devide to small similar problem
//complexity: time n*log(n), use more memory
function mergesort ($numArr) {
    if (count($numArr) <=1 ) {
        return $numArr;
    }
    else {
        $midIndex = floor(count($numArr) / 2);
        $left = array_slice($numArr, 0, $midIndex);
        $right = array_slice($numArr, $midIndex);
        
        $sortedLeft = mergesort($left);
        $sortedRight = mergesort($right);
        
        return merge($sortedLeft, $sortedRight);
    }
}

function merge ($sortedLeft, $sortedRight) {
    $result = array();
    $i=0;
    $j=0;
    while ($i<count($sortedLeft) && $j<count($sortedRight)) {
        if ($sortedLeft[$i] <= $sortedRight[$j]) {
            $result[] = $sortedLeft[$i];
            $i++;
        }
        else {
            $result[] = $sortedRight[$j];
            $j++;
        }
    }
    //append leftover
    while($i < count($sortedLeft)) {
        $result[] = $sortedLeft[$i];
        $i++;
    }
    while ($j < count($sortedRight)) {
        $result[] = $sortedRight[$j];
        $j++;
    }
    return $result;
}

echo "\n == quick sort, in place, VIP, PHP array sort implements this == \n";
/*
 * == quick sort ==
 * use quicksort3 for implementation, leftwall concept, easier to understand
 * quicksort2 can use also, but difficult to understand
 */
$resultArr = $arr;
quicksort($resultArr, 0, count($resultArr) - 1); //use pointer, which will change the origional array
echo "quicksort result:".implode(',',$resultArr)."\n";

$resultArr = $arr;
quicksort3($resultArr, 0, count($resultArr) - 1); //use pointer, which will change the origional array
echo "quicksort3 result:".implode(',',$resultArr)."\n";

$resultArr = $arr;
quicksort2($resultArr, 0, count($resultArr) - 1); //use pointer, which will change the origional array
echo "quicksort2 result:".implode(',',$resultArr)."\n";

//input $numArr
//output $sortedArr
/*
 * quicksort use partition by a pivot element, split to two sets one set with smaller values, another with bigger values
 */

function swapElement (&$numArr, $index1, $index2) {
    $temp = $numArr[$index1];
    $numArr[$index1] = $numArr[$index2];
    $numArr[$index2] = $temp;
}

//idea: keep the left wall index which is the partition of smaller and bigger elements
//traverse once on the whole list
function quicksort3 (&$numArr, $startIndex, $endIndex) {
    if ($startIndex >= $endIndex) {
        return;
    }
    $pivotIndex = quicksort3_partition($numArr, $startIndex, $endIndex);
    
    quicksort3($numArr, $startIndex, $pivotIndex-1);
    quicksort3($numArr, $pivotIndex+1, $endIndex);
}

function quicksort3_partition (&$numArr, $startIndex, $endIndex) {
    //set start as pivot, if other element as pivot, swap to start
    $pivot = $numArr[$startIndex];
    
    $leftWallIndex = $startIndex;
    for ($i=$startIndex+1; $i<=$endIndex; $i++) {
        if ($numArr[$i] <= $pivot) { //shift leftwall to next bigger item, swap next big one with the small one 
            $leftWallIndex++;
            swapElement($numArr, $i, $leftWallIndex);
        }
    }
    //swap pivot with $leftWallIndex
    swapElement($numArr, $startIndex, $leftWallIndex);
    return $leftWallIndex;
}


//look for left and right, swap
//this menthod is more difficult to think this thru, especially the limit
function quicksort2 (&$numArr, $startIndex, $endIndex) {
    //echo "debug: startIndex=$startIndex, endIndex=$endIndex \n";
    if ($startIndex >= $endIndex) {
        return;
    }
    $pivotIndex = $endIndex;
    $pivot = $numArr[$pivotIndex];
    
    //search element
    $i = $startIndex;
    $j = $endIndex - 1;
    while ($i <= $j) {
        if ($numArr[$i] <= $pivot) {
            $i++;
        }     
        else if ($numArr[$j] > $pivot) {
            $j--;
        }
        else {
            //swap $i with $j
            swapElement($numArr, $i, $j);
            $i++;
            $j--;
        }
    }
    swapElement($numArr, $i, $pivotIndex);
    
    quicksort2($numArr, $startIndex, $i-1);
    quicksort2($numArr, $i+1, $endIndex);
}


/*
 * two pointers from start and from end-1, placeholder concept:
 * use last item as pivot, search 1st half, swap if find an element > pivot. Now pivot is in first half, seach last half. 
 * until $i <j stop
 */
function quicksort (&$numArr, $startIndex, $endIndex) {
    //echo "debug: startIndex=$startIndex, endIndex=$endIndex \n";
    if ($startIndex >= $endIndex) {
        return;
    }

    $pivot = $numArr[$endIndex];
    $pivotIndex = $endIndex;
    $i = $startIndex;
    $j = $endIndex - 1;
    while ($i <= $j) {
        //echo "debug: i=$i, j=$j, pivotIndex=$pivotIndex \n";
        if ($pivotIndex != $i) {
            if ($numArr[$i] > $pivot) {
                //swap with pivot
                $numArr[$pivotIndex] = $numArr[$i];
                $numArr[$i] = $pivot;
                $pivotIndex = $i;
            }
            else {
                $i++;
            }
        }
        else if ($pivotIndex != $j) {
             if ($numArr[$j] <= $pivot) {
                //swap with pivot
                $numArr[$pivotIndex] = $numArr[$j];
                $numArr[$j] = $pivot;
                $pivotIndex = $j;
            }
            else {
                $j--;
            }
        }
        else { //pivot index == i == j
            break;
        }
    }
    
    //recurse to sort
   quicksort($numArr, $startIndex, $pivotIndex-1);
   quicksort($numArr, $pivotIndex+1, $endIndex);
}

echo "\n == bubble sort, in place,  O(N*N) not efficient == \n";
/*
 * == bubble sort (not efficient low chance of having this)==
 * //in place sorting, PHP array need to set pointern eg. &$numArr
 * idea: compare adjecent two numbers and swap large number to the right side, one loop will push the largest number to the end
 * (eg. assume the first element is the largest)
 * go to next loop of checking n-1 elemetns 
 */
$resultArr = $arr;
bubblesort($resultArr); //use pointer, which will change the origional array
echo "bubblesort result:".implode(',',$resultArr)."\n";

function bubblesort (&$numArr) {
    $lastIndex = count($numArr) - 1;
    if ($lastIndex < 1) {
        return;
    }
    for($i=0; $i<=$lastIndex; $i++) { // check n times to ensure all elements are checked
        for ($j=0; $j<=($lastIndex-1); $j++) { //for each element push to the end
            if ($numArr[$j] > $numArr[$j+1]) {
                swapElement($numArr, $j, $j+1);
            }
        }
    }
}

$resultArr = $arr;
bubblesort2($resultArr); //use pointer, which will change the origional array
echo "bubblesort2 result:".implode(',',$resultArr)."\n";

function bubblesort2 (&$numArr) {
    $lastIndex = count($numArr) - 1;
    if ($lastIndex < 1) {
        return;
    }
    for($i=$lastIndex; $i>=0; $i--) { // check n times to ensure all elements are checked
        for ($j=0; $j<=$i-1; $j++) { //for each element push to the end, $i number of elements already sort
            if ($numArr[$j] > $numArr[$j+1]) {
                swapElement($numArr, $j, $j+1);
            }
        }
    }
}

echo "\n == insertion sort, in place, O(N*N) not efficient == \n";
//insertion sort O(N*N), not efficient
//idea: compare each element with all the element in front and swap until it finds the right place. All elements in front are sorted
//https://www.tutorialspoint.com/data_structures_algorithms/insertion_sort_algorithm.htm
//http://www.geeksforgeeks.org/insertion-sort/

$resultArr = $arr;
insertionsort($resultArr); //use pointer, which will change the origional array
echo "insertionsort result:".implode(',',$resultArr)."\n";

function insertionsort (&$numArr) {
    $length = count($numArr);
    if ($length <= 1) {
        return;
    }
    for ($i=1; $i<=$length-1; $i++) {
        for ($j=$i; $j>=1; $j--) {
            if ($numArr[$j] < $numArr[$j-1]) {
                swapElement($numArr, $j, $j-1);
            }
            else {
                break;
            }
        }
    }
}

echo "\n == selection sort, in place,  O(N*N) not efficient == \n";
//selection sort O(N*N), not efficient
//idea: select the smallest item and swap to append into the sorted list
//https://www.tutorialspoint.com/data_structures_algorithms/selection_sort_algorithm.htm

$resultArr = $arr;
selectionSort($resultArr); //use pointer, which will change the origional array
echo "selectionSort result:".implode(',',$resultArr)."\n";

function selectionSort (&$numArr) {
    $length = count($numArr);
    
    for ($i=0; $i<$length; $i++) { //loop n times
        $smallestIndex = $i;
        $smallestVal = $numArr[$i];
        for ($j=$i; $j<$length; $j++) { //find the smallest item
            if ($numArr[$j] < $smallestVal) {
                $smallestIndex = $j;
                $smallestVal=$numArr[$j];
            }
        }
        swapElement($numArr, $i, $smallestIndex);
    }
}