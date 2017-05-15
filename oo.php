<?php

/*
 * $argv: 
 */

echo "class TwoSum \n";
/*
 * //two sum with class
Design and implement a TwoSum class. It should support the following operations: add and find.

add - Add the number to an internal data structure.
find - Find if there exists any pair of numbers which sum is equal to the value.
add(1); 
add(3); 
add(5);
find(4) -> true
find(7) -> false
 */

class TwoSum {
    private $numArr = array();
    
    function __construct() {
        //test
        //use parent::__construct() to trigger parent class, if this calss extends parentClass {}
    }
    public function add ($num) {
        $this->numArr[] = $num;
    }
    
    //twosum: use hash table (associate array) to implement for an efficient way, O(N)
    public function find ($sum) {
        $hash = array();
        foreach ($this->numArr as $index => $num) {
            $delta = $sum - $num;
            if (isset($hash[$delta])) {
                return true;
            }
            else {
                $hash[$num] = $index;
            }
        }
        return false;
    }
}
$twoSumObj = new TwoSum();
$twoSumObj->add(1);
$twoSumObj->add(3);
$twoSumObj->add(5);

echo $twoSumObj->find(4) ? "TRUE" : "FALSE";
echo "\n";

echo $twoSumObj->find(7) ? "TRUE" : "FALSE";
echo "\n";
