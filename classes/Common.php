<?php
    include(__dir__ . "/../config.php"); // Configuration files
    include("MySQL.php"); //SQL connection
    include('markdown.php');

    global $mySQL_connection;
    $mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
    $_SESSION['mySQL_connection'] = $mySQL_connection;
    
    //Print projects
function printProjects($project)
    {
            $title = $project['title'];
            $url = $project['url'];
            $postBody = $project['post'];
            $author = $project['poster'];
            $date = date("d M y",$project['date']);
            $tags = $project['tags'];

            echo
            "
                    <div class ='project'>
                            <div id = 'title'><a href='$url'>".
                            $title
                            ."</a></div><div id ='author'> -- ". $author ."</div><br>
                            <div id = 'post'>
                            <div id = 'para'>
                            ".
                            Markdown($postBody)
                            ."</div></div><br>
                            <div id ='date'>".
                            $date
                            ."</div>
                            <div id ='tags'>
                            tags:". $tags
                            ."</div>
                    </div>
                    ";
    }
    //Print out posts
    function printPosts($post)
    {
            $id = $post['id'];
            $title = $post['title'];
            $postBody = $post['post'];
            $author = $post['poster'];
            $date = $post['date'];
            $tags = $post['tags'];

            $commentsDiv = 
            "
            <div id = '#' class = 'comments'>
                <div id = 'commentError'>There was an error submitting the comment</div>
                        <input type = 'text' placeholder = 'Name' id = 'commenterName'>
                        <br />
                        <textarea placeholder = 'Comments...' rows = '10' cols = '50' id = 'userComment'></textarea><br>
                        <input type = 'submit' value = 'submit'>
                <div id = 'allComments'>

                </div>
            </div>
            ";
            if($post == null)
            {
                    echo
                    "
                            <div id ='entry'>
                                    <div id = 'title'> No Post!</div><div id ='author'> -- SYSTEM </div><br>
                                    <div id = 'post'>
                                    <div id = 'para'>
                                    Nothing to see here as yet. Move on.
                                    </div></div><br>
                                    <div id ='date'> BEFORE TIME</div>
                                    <div id ='tags'>
                                    tags:None</div>
                                    <div id = 'comments'>
                                    <a href=''>.......</a>
                                    </div>
                            </div>
                    " . addComments($commentsDiv,$id);
                    return;
            }
            if($date!= "" && $date != null)
            {
                    $date = date("j M y",$date);
            }
            else
            {
                    $date = "before time";
            }
            if($tags =="")
            {
                    $tags = "none";
            }
            echo
            "
                    <div id ='entry'>
                            <div id = 'title'><a href='eghm-blah.php?pid=". $id ."'>".
                            $title
                            ."</a></div><div id ='author'> -- ". $author ."</div><br>
                            <div id = 'post'>
                            <div id = 'para'>
                            ".
                            Markdown($postBody)
                            ."</div></div><br>
                            <div id ='date'>".
                            $date
                            ."</div>
                            <div id ='tags'>
                            tags:". $tags
                            ."</div>
                            <div id = 'comments'>
                            <a href ='javascript:comments(". $id .")' class = 'loadComments'>other noise</a>
                            </div>
                    </div>
                    " . addComments($commentsDiv,$id);
    }
    function printHeader($title)
    {
            global $description,$keywords,$author,$charset;
        echo
        "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset = '".  $charset."'> ";
            include_once(__dir__ . "/../analyticstracking.php");
	echo"
            <link rel='stylesheet' type='text/css' href='style.css' />
            <title>". $title ."</title>
            <meta name ='description' content = '". $description."'>
            <meta name ='keywords' content = '".  $keywords."'>
            <meta name ='author' content = '".  $author."'>
        </head>
        ";
    }

    //Print out the Nav bar
    function printNav($pageName)
    {
            global $mySQL_connection;

            $fileName = explode("/", $pageName);
            $arrCount = count($fileName);
            if($arrCount < 2)
            {
                    $fileName = explode("\\", $pageName);
                    $arrCount = count($fileName);
            }


            $pageName = $fileName[$arrCount - 1];
            if(strcmp($pageName,"index.php") == 0 )
            {
                    echo "
                            <table id = 'navigation'>
                                    <tr><td><b>Home</b></td></tr>
                                    <tr><td><a href = 'projects.php'>Projects</a></td></tr>
                                    <tr><td><hr class = 'navHR'></td></tr>
                                    <tr ><td><div class= 'recent'><a href = 'eghm-blah.php'>Recently</a></div></td></tr>";
                                    include('recently.php');
                    echo "
                                    <tr id= 'sidebar-posts'>
					<td></td>
                                    </tr>
                            </table>
                            ";
            }
            else if(strcmp($pageName,"projects.php") == 0 )
            {
                    echo "
                            <table id = 'navigation'>
                                    <tr><td><a href='index.php'>Home</a></td></tr>
                                    <tr><td><b>Projects</b></td></tr>
                                    <tr><td><hr class = 'navHR'></td></tr>
                                    <tr ><td><div class= 'recent'><a href = 'eghm-blah.php'>Recently</a></div></td></tr>";
                                    include('recently.php');
                    echo "
                                    <tr id= 'sidebar-posts'>
                                    </tr>
                            </table>
                            ";
            }
            else if(strcmp($pageName,"eghm-blah.php") == 0 )
            {
                    echo "
                            <table id = 'navigation'>
                                    <tr><td><a href='index.php'>Home</a></td></tr>
                                    <tr><td><a href = 'projects.php'>Projects</a></td></tr>
                                    <tr><td><hr class = 'navHR'></td></tr>
                                    <tr id= 'recent'><td><b>Recently</b></td></tr>";
                                    include('recently.php');
                    echo "
                                    <tr id= 'sidebar-posts'>
                                    </tr>
                            </table>
                            ";
            }
    }
    function addcomments($html, $id)
    {
            $html = str_replace("#",$id,$html);
            return $html;
    }
?>
