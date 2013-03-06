<?php
    session_start();
    include('classes/Common.php');

    //Queyy for front page post
    $query = "SELECT * from posts ORDER BY id DESC LIMIT 1";
    $result = $mySQL_connection->query($query);
    $post = $result->fetch_assoc();
    $rowCount =  $result->num_rows;

    printHeader("darrelld - " . $post['title']); 
?>
<body>
<?php 
    printNav($_SERVER['PHP_SELF']);
    //Display the latest post
    printPosts($post);
?>
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js' defer ></script>
<script src='scripts.js' defer></script>
<script src='bootstrap/js/bootstrap.min.js' defer></script>

</body>
</html>
