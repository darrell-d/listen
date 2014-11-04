<?php
class MarkdownReader
{

  private $raw_text;

  function __construct($source)
  {
    if(is_file($source))
    {
      $file = fopen($source, "r");
      while(!feof($file))
      {
        $line = fread($file, filesize($source));
        echo $line;
      }
      fclose($file);
    }
    else
    {
      echo "Not";
    }
  }

  function read()
  {

  }

}
?>
