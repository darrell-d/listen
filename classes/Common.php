<?php
include_once(dirname(__FILE__) . "/../config.php");
include_once("MySQL.php");
include_once('markdown.php');

global $mySQL_connection;
$settings = parse_ini_file(dirname(__FILE__) . '/../config.ini');

$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
$_SESSION['mySQL_connection'] = $mySQL_connection;
$analyticsTracking = dirname(__FILE__) . "/../analyticstracking.php";
    
//Print projects
function printProjects($project)
{
    $title = $project['title'];
    $url = $project['url'];
    $postBody = $project['post'];
    $author = $project['poster'];
    $date = date("d M Y",$project['date']);
    $tags = explode(',',$project['tags']);

    echo
    "
        <div class ='project'>
            <div id = 'title'><a href='$url' id = 'header'><h2>".
            $title
            ."</h2></a></div>
            <div id = 'post'>
            <div id = 'para'>
            ".
            Markdown($postBody)
            ."</div></div>
            <div id ='date'>".
            $date
            ."</div>
            <div class ='tags'>
            tags:
     ";

    foreach($tags as $tag)
    {
        echo"<div class = 'tag'><a href ='previous.php?tag=$tag'>$tag</a></div>";
    }
    echo
        "
            </div>
            </div>
        ";
}
//Print out posts
function printPosts($post,$printComments = true)
{
    $id = $post['id'];
    $title = $post['title'];
    $postBody = $post['post'];
    $author = $post['poster'];
    $date = $post['date'];
    $tags = explode(',',$post['tags']);

     $commentsDiv = "";

    if($printComments)
    {
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
    }
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
            $date = date("j M Y",$date);
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
                    <div id = 'title'><h2>".
                    $title
                    ."</h2></div>
                    <div id = 'post'>
                    <div id = 'para'>
                    ".
                    Markdown($postBody)
                    ."</div></div><br>
                    <div id ='date'>".
                    $date
                    ."</div>
                    <div class ='tags'>tags:";

    foreach($tags as $tag)
    {
        echo"<div class = 'tag'><a href = 'previous.php?tag=$tag'>$tag</a></div>";
    }
    echo
                    "</div>
                    <div id = 'comments'>
                    <a href ='javascript:comments(". $id .")' class = 'loadComments'>comments</a>
                    </div>
            </div>
            " . addComments($commentsDiv,$id);
}
function printHeader($title)
{
    global $description,$keywords,$author,$charset,$analyticsTracking;
    echo
    "
    <!DOCTYPE html>
    <html>
    <head>
	<meta http-equiv='X-UA-Compatible' content='IE=Edge'> 
        <meta charset = '".  $charset."'> ";
    if(file_exists($analyticsTracking))
    {
        include_once($analyticsTracking);
    }
    echo
    "
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

    echo 
    "
        <table id = 'navigation'>
            <tr><td><b><a href ='index.php'>Home</a></b></td></tr>
            <tr><td><a href = 'about.php'>About me</a></td></tr>
            <tr><td><a href = 'https://twitter.com/_darrelld'>@_darrelld</a></td></tr>
            <tr><td><a href = 'projects.php'>Projects</a></td></tr>
            <tr><td><a href = 'previous.php'>Older posts</a></td></tr>

    ";
    
    //include('recently.php');
    
    echo 
    "
        <tr id= 'sidebar-posts'>
            <td></td>
        </tr>
        </table>
    ";
}
function addcomments($html, $id)
{
    $html = str_replace("#",$id,$html);
    return $html;
}
function clean($input)
{
    global $mySQL_connection;
    $output = $mySQL_connection->clean($input);
    return $output;
}
function printFooter()
{
    echo"
	<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js' defer ></script>
	<script src='scripts.js' defer></script>
	<script src='bootstrap/js/bootstrap.min.js' defer></script>
	<script src='https://login.persona.org/include.js' defer></script>
	<script src = 'analyticstracking.js' defer></script>          	
</body>
</html>
";
}

function getLatestPost()
{
    $path  ='posts/';
    $folders = getFolders($path);
    $path .= $folders[0] . '/' ;

    while(true)
    {
        $folders = getFolders($path);
        if(!empty($folders[0]) )
        {
            $path .= $folders[0] . '/';
        }
        else
        {
            break;
        }

    }
    global $mySQL_connection;

    //Query for front page post
    $query = "SELECT * from posts WHERE tags NOT LIKE '%_test%' ORDER BY id DESC LIMIT 1";
    $stmt = $mySQL_connection->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $post = $result->fetch_assoc();
    $rowCount =  $result->num_rows;

    return array
    (
        'query'     =>  $query,
        'result'    =>  $result,
        'post'      =>  $post,
        'rowCount'  =>  $rowCount
    );

}
function getProjects()
{
    global $mySQL_connection;

    //Query for front page post
    $query = "SELECT * from projects  ORDER BY id DESC LIMIT 1";
    $stmt = $mySQL_connection->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $post = $result->fetch_assoc();
    $rowCount =  $result->num_rows;

    return array
    (
        'query'     =>  $query,
        'result'    =>  $result,
        'post'      =>  $post,
        'rowCount'  =>  $rowCount
    );

}
/*
*MarkDown file is assumed to have timestamp as the very first line
*/
function readMarkDownFile($fileLocation)
{
	$file = '';
	$contents = '';
	try
	{
		$file = fopen($fileLocation,'r');
		
		$timestamp = fgets($file, 8192);
		
		while(!feof($file))
		{
			$contents .= fgets($file);
		}
	}
	catch (Exception $e)
	{
		echo "Error: " . $e->getMessage();
	}
	fclose($file);
	
	return array("timestamp" => $timestamp, "content" => $contents);
}
function getFolders($directory)
{
    $folders = scandir($directory);
    $foldersVisible = array();
    foreach($folders as $value)
    {
     
        if(strpos($value, '.') === false)
        {
            array_push($foldersVisible, $value);
        }
    }
    sort($foldersVisible);


    return array_reverse($foldersVisible);
}

function getFiles()
{
    
}

?>
