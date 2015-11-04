<?php
include_once(dirname(__FILE__) . "/../config.php");
include_once("MySQL.php");
include_once('markdown.php');

global $mySQL_connection;
$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
$settings = parse_ini_file(dirname(__FILE__) . '/../config.ini');
date_default_timezone_set("America/New_York");

//$mySQL_connection = new MySQL($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
$_SESSION['mySQL_connection'] = $mySQL_connection;
$analyticsTracking = dirname(__FILE__) . "/../analyticstracking.php";
$paths = array();

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
        echo"<div class = 'tag'><a href ='previously.php?tag=$tag'>$tag</a></div>";
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
    $date = $post['timestamp'];

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

    echo
    "
    <div id ='entry'>
            <div id = 'post'>
            <div id = 'para'>
            ".
            Markdown($post['content'])
            ."</div></div><br>
            <div id ='date'>".
            $date
            ."</div>
            <div class ='tags'></div>
            </div>";
    /*echo
        "</div>
        <div id = 'comments'>
        <a href ='javascript:comments(". $id .")' class = 'loadComments'>comments</a>
        </div>
</div>
            " . addComments($commentsDiv,$id);*/
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
    <meta charset = '".  $charset."'>
    <link rel='shortcut icon' href='favicon.ico' />";
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
    <span id = 'navigation-container'>
        <ul id = 'navigation'>
            <li><a href ='index.php'>Home</a></li>
            <li><a href = 'about.php'>About me</a></li>
            <li><a href = 'projects.php'>Projects</a></li>
            <li><a href = 'previously.php'>Older posts</a></li>
            <li><a href = 'https://twitter.com/_darrelld' target = '_blank'>@_darrelld</a></li>
        </ul>
    </span>
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
    $folders = getFoldersAndFiles($path);
    $path .= $folders[0] . '/' ;

    while(true)
    {
        $folders = getFoldersAndFiles($path);
        if(!empty($folders[0]) )
        {
            $path .= $folders[0] . '/';
        }
        else
        {
            break;
        }

    }
    $files = getFoldersAndFiles($path, "files");
    $mdFound = false;
    $mdIndex = 0;
    while(!$mdFound)
    {
        if(strpos($files[$mdIndex],".md") >0 )
        {
            $mdFound = true;
        }
        else
        {
            $mdIndex++;
        }

    }
    $latestPost = $path . $files[$mdIndex];

    return $latestPost;
}
function _getAllPosts()
{
    $path  ='posts/';
    $folders = getFoldersAndFiles($path);
    var_dump($folders);
    $path .= $folders[0] . '/' ;

    while(true)
    {
        $folders = getFoldersAndFiles($path);
        if(!empty($folders[0]) )
        {
            $path .= $folders[0] . '/';
        }
        else
        {
            break;
        }

    }
    $files = getFoldersAndFiles($path, "files");
    $latestPost = $path . $files[0];

    return $latestPost;
}
function getAllPosts($path = "posts")
{
  global $paths;
  $dirs = scandir($path);
  $returnPath =$path;
  foreach($dirs as $subdir)
  {
    $currentPath = $path . '/' . $subdir;
    if(strstr($subdir,".md") == true)
    {
      array_push($paths,$currentPath);
      //var_dump($paths);
    }
    if(strstr($subdir,".") == false)
    {

        getAllPosts($currentPath);
    }
  }

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

		$timestamp = fgets($file);
        $title = fgets($file);
        $contents .= $title;

        $title = substr($title,1, strlen($title));

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

	return array("timestamp" => $timestamp, "title" => $title, "content" => $contents);
}
function getFoldersAndFiles($directory, $typeToScanFor = "folders")
{
    $items = scandir($directory);
    $itemsVisible = array();

    if($typeToScanFor == "folders")
    {
        foreach($items as $value)
        {
            if(strpos($value, '.') === false)
            {
                array_push($itemsVisible, $value);
            }
        }
        sort($itemsVisible);
    }
    else if($typeToScanFor == "files")
    {
        foreach($items as $value)
        {
            if(substr($value,0,1) != '.')
            {
                array_push($itemsVisible, $value);
            }
        }
        sort($itemsVisible);
    }


    return array_reverse($itemsVisible);
}

?>
