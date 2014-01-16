<?php
//Comments.php
global $mySQL_connection;

class Comments
{
    
    function __construct()
    {
        
    }
    
    public static function saveComment($id,$name,$comment,$time)
    {
        global $mySQL_connection;
        $stmt = $mySQL_connection->prepare("INSERT INTO `comments` (`postID`,`name`,`comment`,`time` ) VALUES (?,?,?,?)");
        $stmt->bind_param('issi',$id,$name,$comment,$time);
        
        return $stmt->execute();
        
    }
    
    public static function loadComments($id)
    {
        global $mySQL_connection;
        $query = "SELECT name, comment, time FROM `comments` WHERE postID =? ORDER BY time DESC";
        $stmt = $mySQL_connection->prepare($query);

        $stmt->bind_param('i',$id);
        $stmt->execute();

        $result = $stmt->get_result();
        
        $comments = array();
        while($data = $result->fetch_assoc() )
        {
            array_push($comments,$data);
        }
        return $comments;
    }
    
    public static function deleteComment($id)
    {
        global $mySQL_connection;
        
        $query = "DELETE FROM `comments` WHERE `id` =?";
        $stmt = $mySQL_connection->prepare($query);

        return $stmt->execute();

    }
    
    
}
?>
