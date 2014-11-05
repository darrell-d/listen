<?php
include('Symbols.php');
class MarkdownReader
{


  private $raw_text;
  private $output;
  private $line_count;

  function __construct($source)
  {
    $line_count = 0;
    if(is_file($source))
    {
      $file = fopen($source, "r");
      while(!feof($file))
      {
        $line = fgets($file);
        $this->output .= $this->parse($line);
      }
      fclose($file);
    }
    else
    {
      //Deal with raw text
    }
    //echo $this->output ;
  }

  function parse($line)
  {
    $this->line_count++;
    //Parse basic # tags
    if(gettype(strpos($line,"#")) == "integer")
    {
      $line = str_replace("#","",$line);
      $line = "<h1>" . $line . "</h1>";
    }



    return $line;
  }

}
?>
