<?php
//Comments.php

class Comments
{
    private $user;
    private $date;
    private $id;
    private $children;
    
    function __construct($user, $date, $id, $children = array())
    {
        $this->user = $user;
        $this->date = $date;
        $this->id = $id;
    }
    
    function loadChildren()
    {
        //Linked list of children
    }
    
    function deleteComment()
    {
        $query = "DELETE FROM `comments` WHERE `id` ='". $this->id ."'";
    }
    
    
}
?>
