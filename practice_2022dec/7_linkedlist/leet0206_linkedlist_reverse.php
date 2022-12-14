<?php
// command line php xx.php
//https://leetcode.com/problems/reverse-linked-list-ii/description/?company_slug=bytedance
//92. Reverse Linked List II
//check reverse linked list I first, https://leetcode.com/problems/reverse-linked-list/
//206. Reverse Linked List, easy

/* //for linkedlist, everytime needs to traverse. And ingeneral it is not a good idea to just wap value.
    //best is to change data untouched, manipulate pointer
 * 
 */

$arr1 = [1,2,3,4,5];
$arr2 = [48,9,8,-42,-56,1,-7,-77,95,-70,-56,-84,7,99,34,-32,7,55,-59,-85,-16,-35,41,51,92,89,-91,40,-72,-73,-88,76,36,20,-66,30,71,-23,54,65,-43,98,32,65,97,-35,83,-47,-81,-77,-32,3,-12,60,-96,-21,48,-87,-82,76,-60,81,2,26,1,-14,-45,-79,13,59,87,70,57,18,34,3,33,-34,6,52,-11,24,-96,27,-17,-92,-95,-69,72,75,57,-89,55,-92,-13,-95,-6,43,-73,-94,1,64,77,-93,-69,-40,-40,64,27,66,15,66,-60,-31,-7,23,-72,-52,4,100,-78,-39,62,28,-81,-52,33,14,41,10,-30,-58,-27,97,100,4,-93,-90,-83,-16,26,-18,-51,66,52,42,-61,80,91,43,29,63,54,-10,-10,74,39,-77,-63,-21,-17,-43,-29,57,-46,-79,-90,-89,-69,-72,-5,7,-40,44,-27,62,-64,12,-9,77,-96,-80,-11,9,10,80,-68,99,53,-31,-72,-65,-24,-51,92,-20,-30,53,-9,-49,31,86,59,91,-20,82,53,-34,-57,-57,93,98,-87,-19,6,24,-40,38,-28,-88,57,-50,99,-67,0,90,13,20,-8,-96,22,-78,40,-70,64,70,62,-34,-65,-96,-41,-73,52,-27,-41,-42,47,19,46,69,-18,3,-81,-20,-14,-31,-81,99,89,-38,53,-40,-16,-7,-10,98,-88,-99,-87,-52,56,-27,-75,8,-4,-16,16,-58,54,-39,61,-65,14,80,-35,100,99,-66,49,38,-4,1,98,31,44,-62,28,57,-61,42,55,96,65,80,-47,-40,-86,69,-48,68,80,-88,53,-6,43,68,-57,41,-99,42,-22,-2,-57,-74,79,37,-86,6,-57,-47,98,98,99,12,28,-49,22,-8,70,74,-91,50,37,62,94,-71,-21,-64,20,-20,79,49,28,72,75,6,-42,89,63,2,92,10,-51,41,-78,27,42,44,-82,12,-32,-73,-39,55,39,-46,84,-83,-60,3,-52,-82];

$linkList1 = null;
$lastIndex1 = count($arr1)-1;
for ($i=$lastIndex1; $i>=0; $i--) {
    $linkList1 = new ListNode($arr1[$i], $linkList1);
}

print_r($linkList1);


echo "result \n";
//return;
$solution = new Solution();
$result = $solution ->reverseList($linkList1);
print_r($result);


/*
$linkList2 = null;
$lastIndex2 = count($arr2)-1;
for ($i=$lastIndex2; $i>=0; $i--) {
    $linkList2 = new ListNode($arr2[$i], $linkList2);
}

print_r($linkList2);


echo "result \n";
//return;
$result2 = $solution ->reverseList($linkList2);
print_r($result2);
 * */

//Definition for a singly-linked list.
class ListNode {
    public $val;
    public $next;
    function __construct($val=0, $next=null) {
        $this->val = $val;
        $this->next = $next;
    }
}

class Solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head) {
        //idea is to reverse each item
        //from 1->2->3->4->null
        //change to null<-1<-2<-3<-4<-
        //each item current node, next pointer change to previous node
        //moving two pointers
        $prevNode = null;
        $currentNode = $head;
        while (isset($currentNode)) {
            //change currentNode next pointer to prev node
            $leftOver = $currentNode->next; //leftover
            $currentNode->next = $prevNode;
            
            //moving to next set
            $prevNode = $currentNode; //previous is next
            $currentNode = $leftOver;
        }
        return $prevNode; //as current node is null already, and last prev node is first node!!
        //return $head;
    } 
    
}



