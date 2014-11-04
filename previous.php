<?php
session_start();

include_once('classes/Common.php');
getAllPosts();
global $paths;

$pidTest = isset($_GET['pid']) && is_numeric($_GET['pid']);
if( $pidTest )
{
    $id = clean($_GET['pid']);
    $next = $id +1;
    $prev = $id -1;
    $query = "SELECT * FROM posts WHERE id = ?";

    $stmt = $mySQL_connection->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result= $stmt->get_result();
    $post = $result->fetch_assoc();


    printHeader("darrelld - " . $post['title']);
}
else
{
    printHeader("darrelld - Recently");
}
?>


<body>
    <span id ="navigation">
    <?php printNav($_SERVER['PHP_SELF'])?>
    </span>

<?php

rsort($paths);
foreach($paths as $p)
{
  $post = readMarkDownFile($p);
  printPosts($post);

}
/*
global $mySQL_connection;
    $pidTest = isset($_GET['pid']) && is_numeric($_GET['pid']);
    if($pidTest)
    {

        printPosts($post);
        echo
        "
            <br>
            <span id ='prev'><a href='previous.php?pid=". $prev ."'>Previous</a></span>
            <span id ='next'><a href='previous.php?pid=". $next ."'>Next</a></span>
        ";
    }
    else if(isset($_GET['tag']) )
    {
        $tag = clean($_GET['tag']);
        $query = $mySQL_connection->prepare("SELECT * FROM posts WHERE tags LIKE '%$tag%'");
        $query->execute();

        $query->bind_result($id_result,$title_result,$post_result,$date_result,$comments_result,$tags_result,$posters_result);
        while($query->fetch() )
        {
            $post = array(
              "id" => $id_result,
                "title" => $title_result,
                "post" => $post_result,
                "poster" => $posters_result,
                "date" =>$date_result,
                "comments" => $comments_result,
                "tags" => $tags_result
            );
            printPosts($post);

        }
    }
    else
    {
        $query = "SELECT * FROM posts WHERE tags NOT LIKE '%_test%' ORDER BY id DESC LIMIT 25 OFFSET 1";
        $stmt = $mySQL_connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc() )
        {
                printPosts($row);
        }
    }
    */
printFooter();
?>
