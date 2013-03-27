<?php
include('classes/Common.php');

printHeader("darrelld - Projects");

?>
</head>
<body>
    <span id ="navigation">
<?php printNav($_SERVER['PHP_SELF'])?>
    </span>
<?php 
printProjects(   
    array(
        "id" => "N/A",
        "url" => "https://github.com/darrell-d/listen",
        "post" => 
        "
You want to speak. You have words that need to be heard. You need people to listen. 
listen! lets you do that. 
Be heard.
        ",
        "title" => "listen!",
        "poster" => "darrelld",
        "date" => "1341980998",
        "tags" => "project"
        ));
printFooter();
?>

