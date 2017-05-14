<?php
//run this in MAC since PHP has been pre-installed
//use version 5.6

/*
 * == merge sort ==
 */
$arr = array( 6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5); 
echo "\n".implode(',',$arr)."\n";
$arr=mergesort($arr);
echo "result:".implode(',',$arr)."\n";

//input $numArr
//output $sortedArr
//use merge sort using recursion to devide to small similar problem
//complexity: time n*log(n)
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