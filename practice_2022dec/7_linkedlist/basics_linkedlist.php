<?php
// command line php xx.php
//basic codes for linkedlist defination in php, below is number

class linkNode {
    public $value = null; //if number using 0 maybe
    public $next = null;
    
    function __construct($value=null, $next=null) {
        $this -> value = $value;
        $this -> next = $next;
        
    }
}

$numArray = [2, 4, 3];
$lastIndex = count($numArray)-1;
//foreach ($numArray as $index => $val) { } //foreach only works for array

$linkList = null;
for ($i=$lastIndex; $i>=0; $i--) {
    $linkList = new linkNode($numArray[$i], $linkList);
}

print_r($linkList);