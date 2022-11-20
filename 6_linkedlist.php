<?php
//run this in MAC since PHP has been pre-installed
//use version 5.6

//== implement singly linked list ==
//includeing: 
//- append node to tail
//- print list
//- delete node: find prev node and current node, if prev node exist set prevnode.next = curnode.next
//      need to check for tail, if prev node not exist aka first node need to set head

//test add node
$myList = new LinkedList();
echo "\n== test add node ==\n";
$myList->addNode("e1");
$myList->addNode("e2");
$myList->addNode("e3");
$myList->printList();

//test search val
echo "\n== test serach val ==\n";
$myList->searchVal("e3");
$myList->searchVal("e2");

//test sap
echo "\n== test swap ==\n";
$myList->printList();
$myList->swap(0, 2);
$myList->printList();
$myList->swap(0, 1);
$myList->printList();
$myList->swap(0, 2);
$myList->printList();


/*
//test sap, having issues
echo "\n== test swap only value ==\n";
$myList->printList();
$myList->swap2(0, 2);
$myList->printList();
$myList->swap2(0, 1);
$myList->printList();
$myList->swap2(0, 2);
$myList->printList();
 * 
 */

//test delete
echo "\n== test delete node ==\n";
$myList->deleteNodeAt(0);
$myList->printList();
$myList->deleteNodeAt(1);
$myList->printList();
$myList->deleteNodeAt(0);
$myList->printList();


class Node {
    public $value = null;
    public $next = null;
}

class LinkedList { //singly linkedlist
    //keep track of head and tail nodes
    private $head = null;
    private $tail = null;
    
    public function addNode ($value) { //append node in the end
        $node = new Node();
        $node->value = $value;
        $node->next = null;
        
        if (isset($this->tail)) {
            $this->tail->next = $node;
            $this->tail = $node;
        }
        else {//no item yet
            $this->tail = $node;
            $this->head = $node;
        }
    }
    
    public function deleteNodeAt ($position) { //starting from 0
        if ($position < 0) {
            return false;
        }
        //keep tracking prev and current node
        $curNode = $this->head;
        $prevNode = null;
        $curPosition = 0;
        while(isset($curNode) && $curPosition != $position) {
            $prevNode = $curNode;
            $curNode = $curNode->next;
            $curPosition++;
        }
        
        if (isset($prevNode)) {
            $prevNode->next = $curNode->next;
            if (!isset($prevNode->next)) {
                $this->tail = $prevNode;
            }
            return true;
        }
        else { //prev node not exist
            $this->head = $curNode->next;
            return true;
        }
    }
    
    public function searchVal ($value) {
        $curNode = $this->head;
        $curPosition = 0;
        while (isset($curNode)) {
            if ($curNode->value === $value) {
                echo "searchVal: found $value at pos $curPosition \n";
                return $curPosition;
            }
            $curNode = $curNode->next;
            $curPosition++;
        }
        
        echo "searchVal: val $value no result found \n";
        return -1;
    }
    //!! another method is to just swap value, which is very simple!!
    public function swap2 ($pos1, $pos2) {
        $node1 = null;
        $node2 = null;
        
        $curNode = $this->head;
        $curPosition = 0;
        $prevNode = null;
        while (isset($curNode)) {
            if ($pos1 === $curPosition) {
                $node1 = $curNode;
            }
            else if ($pos2 === $curPosition) {
                $node2 = $curNode;
            }
            if (isset($node1) && isset($node2)) {
                break;
            }
            $prevNode = $curNode;
            $curNode = $curNode->next;
            $curPosition++;
        }
        if (!isset($node1) || !isset($node2)) {
            echo "error on finding two pos $pos1, $pos2 \n";
            return false;
        }
        
        $valTemp = $node1->value;
        $node1->value = $node2->value;
        $node2->value = $valTemp;
    }
    
    //have issues!!!!
    //node1->next set to $node2->next
    //$node1 prev ->next set to $node2
    //$node 2 prev ->next set to $node1
    public function swap ($pos1, $pos2) {
        if ($pos1 > $pos2) { //enure pos1<pos2
            $temp = $pos1;
            $pos1 = $pos2;
            $pos2 = $temp;
        }
        $node1 = null;
        $node1Prev = null;
        $node2 = null;
        $node2Prev = null;
        
        $curNode = $this->head;
        $curPosition = 0;
        $prevNode = null;
        while (isset($curNode)) {
            if ($pos1 === $curPosition) {
                $node1 = $curNode;
                $node1Prev = $prevNode;
            }
            else if ($pos2 === $curPosition) {
                $node2 = $curNode;
                $node2Prev = $prevNode;
            }
            if (isset($node1) && isset($node2)) {
                break;
            }
            $prevNode = $curNode;
            $curNode = $curNode->next;
            $curPosition++;
        }
        
        if (!isset($node1) || !isset($node2)) {
            echo "error on finding two pos $pos1, $pos2 \n";
            return false;
        }
        //echo "test {$node1->value}, {$node2->value} \n";
        //return false;
        
        //swap next   
        if (isset($node1Prev)) {
            $node1Prev->next = $node2;
        }
        else {
            $this->head = $node2;
        }  
        $next2 = $node2->next; 
        $node1->next = $next2;
        
        //hanlde node 2
        if (isset($node2Prev)) {
            if (($pos2-$pos1) > 1) { //ensure node 2 prev is not node1
                $node2Prev->next = $node1;
            }
        }
        else {
            $this->head = $node1;
        }
        
        if (($pos2-$pos1) > 1) { //ensure node 2 prev is not node1
            $next1 = $node1->next; 
            $node2->next = $next1; //possible to be it self!!!!
        }
        else {
            $node2->next = $node1;
        }
        
        if (!isset($node1->next)) {
            $this->tail = $node1;
        }
        if (!isset($node2->next)) {
            $this->tail = $node2;
        }
        return true;
    }
    
    public function printList () {
        if (!isset($this->head)) {
            echo "empty linked list! \n";
        }
        else { //list not empty travese it to output
            $node = $this->head;
            $count = 0;
            while (isset($node)) {
                echo $node->value .",";
                $node = $node->next;
                $count++;
            }
            echo "\n head={$this->head->value}, tail={$this->tail->value}, total $count nodes \n";
        }
        
    }
    
}

