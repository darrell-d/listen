<?php
//Comments.php
include(__dir__ . '\..\config.php');
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
    
    public static function loadComments($id)
    {
        global $mysql_user,$mysql_pass,$mysql_server,$mysql_db;
        $mysql = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
        $query = "SELECT name, comment, time FROM `comments` WHERE postID ='". $id ."' ORDER BY time DESC";
        
        $result = $mysql->query($query);
        $comments = array();
        while($data = $result->fetch_assoc() )
        {
            array_push($comments,$data);
        }
        return $comments;
    }
    
    public static function deleteComment()
    {
        $query = "DELETE FROM `comments` WHERE `id` ='". $this->id ."'";
    }
    
    
}
?>
