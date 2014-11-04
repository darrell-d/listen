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
printFooter();
?>
