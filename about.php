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
        "url" => "",
        "post" => 
        "<p>I'm Darrell, a software developer working in <a href = 'http://www.oldcitydistrict.org/'>Old City Philadelphia</a>. I've got my start in writing crappy geocities and angelfire web pages in the late 90's (some of them you can still find!)</p><p>Since those days I've become a full LAMP stack developer using Javascript and jQuery where needed. </p><p>Nowadays I work at <a href = 'http://cubistmediagroup.com/'>Cubist Media Group</a> where I'm the Lead Developer working on <a href ='http://mtgworks.com/'>MtgWorks</a> and client based projects in HTML5, Sharepoint and some C# .NET every now and then to keep things interesting.</p><h4>Some cool things I've worked on in the past</h4><ul><li>Wrote server side applciations to listen for UDP packet reports from tank monitor devices.</li><li>Wrote user account systems in Drupal.</li><li>Played around with arudino prototypes to send voltage readouts over a GSM network.</li><li>Built a fast commodity trading price display system</li><li>Built a eLearning system for desktop, iPad and iPhone browsers.</li></ul>",
        "title" => "About me",
        "poster" => "darrelld",
        "date" => "1341980998",
        "tags" => "project"
        ));
printFooter();
?>

