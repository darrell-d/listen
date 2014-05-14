<?php 
    session_start(); 
    include_once('classes/Common.php');
    printHeader("darrelld - About");
?>

<body>
    <span id ="navigation">
    <?php printNav($_SERVER['PHP_SELF'])?>
    </span>
<div id ="entry">
    Hi, I'm Darell. This page is about me. There isn't much here -_-
</div>
<?php

    printFooter();
?>
