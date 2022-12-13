<?php
// command line php xx.php
//https://leetcode.com/problems/add-two-numbers/description/

$arr1 = [2,4,3];
$arr2 = [5,6,4];

$linkList1 = null;
$lastIndex1 = count($arr1)-1;
for ($i=$lastIndex1; $i>=0; $i--) {
    $linkList1 = new ListNode($arr1[$i], $linkList1);
}

print_r($linkList1);

$linkList2 = null;
$lastIndex2 = count($arr2)-1;
for ($i=$lastIndex2; $i>=0; $i--) { //from right to left
    $linkList2 = new ListNode($arr2[$i], $linkList2);
}
print_r($linkList2);

echo "result \n";
//return;
$solution = new Solution();
$result = $solution ->addTwoNumbers($linkList1, $linkList2);
print_r($result);
    
//for linkedlist in php, assume below defination first    
/** 
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val = 0, $next = null) {
        $this->val = $val;
        $this->next = $next;
     }
}


class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
        //naive idea is for each node, loop until both lists -> next is null
        
        $carry = 0;
        $resultList = new ListNode(0); //object is passing by reference
        $currentNode = $resultList;
        //$resultArr = [];
        while (isset($l1) || isset($l2) || $carry == 1) { //cover last number sum>10, link list might only have 1 item
            echo "loop \n";
            $sum = $carry;
            if (isset($l1) && isset($l1->val)) {
                $sum += $l1->val;
                $l1 = $l1->next;
            }
            if (isset($l2) && isset($l2->val)) {
                $sum += $l2->val;
                $l2 = $l2->next;
            }
            
            
            if ($sum > 9) {
                $sum -= 10;
                $carry = 1;
            }
            else {
                $carry = 0;
            }
            
            //$resultArr[] = $sum;
            $currentNode->next = new ListNode($sum); //set new node
            $currentNode = $currentNode->next; //current obj moving to next one
            
        }
        //print_r($resultArr);
        /*
        $lastIndex = count($resultArr)-1;
        for ($i=$lastIndex; $i>=0; $i--) {
            $resultList = new ListNode($resultArr[$i], $resultList);
        }
         * 
         */

        return $resultList->next;
        
    }
}