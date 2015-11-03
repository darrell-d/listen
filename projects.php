<?php
include('classes/Common.php');

printHeader("darrelld - Projects");

?>
</head>
<body>
<?php printNav($_SERVER['PHP_SELF'])?>
<?php 
printProjects(   
    array(
        "id" => "N/A",
        "url" => "https://github.com/darrell-d/listen",
        "post" => 
        "<p>This website runs on a platform that I wrote. I call it listen! It's still a work in progress and really a testing ground for my to mess around with PHP.</p><p> Feel free to use it as you wish if it suits your needs or modify it. Full source can be found on <a href= 'https://github.com/darrell-d/listen'>github</a>.</p><p> One big requirements is PHP 5.4+. It's been fully tested with Apache 2.4, Mysql 5.5 and PHP 5.6</p>",
        "title" => "listen!",
        "poster" => "darrelld",
        "date" => "1341980998",
        "tags" => "project"
        ));
printProjects(   
    array(
        "id" => "N/A",
        "url" => "https://github.com/darrell-d/log.me",
        "post" => 
        "<p>My attempt at a more in depth console.log() functiong</p><p>log.me provides more information upfront about variables displayed to thec onsole that regular cosole.log call would. It is especially usefull in quickly highlighting user type errors</p>",
        "title" => "log.me",
        "poster" => "darrelld",
        "date" => date("now"),
        "tags" => "project"
        ));
printFooter();
?>

