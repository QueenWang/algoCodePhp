<?php
//run this in MAC since PHP has been pre-installed
//use version 5.6

//merge sort
$arr = array( 6,1,3,7,5,2,3,4,45,5,4,75,8,6,78,7980890,2,4,2,432,5,34,5634,34,5); 
echo "\n".implode(',',$arr)."\n";
$arr=mergesort($arr);
echo implode(',',$arr);

//copy online
function mergesort($numlist)
{
    echo "mergesort: ".implode(',',$numlist)."\n";
    if(count($numlist) == 1 ) return $numlist;
 
    $mid = count($numlist) / 2;
    $left = array_slice($numlist, 0, $mid);
    $right = array_slice($numlist, $mid);
    
    echo "call mergesort(left), caller pause, callee active \n";
    $left = mergesort($left);
    echo "call mergesort right), caller pause, callee active \n";
    $right = mergesort($right);
     echo "call merge \n";
    return merge($left, $right);
}
 
function merge($left, $right)
{
    echo "merge ".implode(',',$left).", right=".implode(',',$right)."\n";
    $result=array();
    $leftIndex=0;
    $rightIndex=0;
 
    while($leftIndex<count($left) && $rightIndex<count($right))
    {
        if($left[$leftIndex]>$right[$rightIndex])
        {
 
            $result[]=$right[$rightIndex];
            $rightIndex++;
        }
        else
        {
            $result[]=$left[$leftIndex];
            $leftIndex++;
        }
    }
    while($leftIndex<count($left))
    {
        $result[]=$left[$leftIndex];
        $leftIndex++;
    }
    while($rightIndex<count($right))
    {
        $result[]=$right[$rightIndex];
        $rightIndex++;
    }
    return $result;
}
