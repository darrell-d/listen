<?php
//Comments.php
include('config.php');
include('MySQL.php');

class Comments
{
    
    function __construct()
    {
        
    }
    
    public static function saveComment($id,$name,$comment,$time)
    {
        global $mysql_user,$mysql_pass,$mysql_server,$mysql_db;
        $mysql = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
        
        $result = $mysql->query("INSERT INTO `comments` (`postID`,`name`,`comment`,`time` ) VALUES ('". $id ."', '". $name ."','". $comment ."','". $time ."')");
        return $result;
        
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
//TODO: clean data
$name = $_POST['name'];
$comment = $_POST['comment'];
$id = $_POST['id'];

$comments =  Comments::saveComment($id,$name,$comment, time());
?>
