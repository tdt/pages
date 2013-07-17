<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link href="css/prettify.css" rel="stylesheet" type="text/css">



</head>

<body>

    <div class="navbar">  
      <div class="navcontent">
          <a class="brand" href="#"> <img src="img/logo.png"alt="logo"> </a>

      <!--<ul class="nav">

        <li class="navtab"> <a class="active" href="{{relpath}}package">Resources</a> </li>
        <li class="navtab"> <a href="{{relpath}}users">Users</a> </li>
        <li class="navtab"> <a href="{{relpath}}routes">Routes</a> </li>
        <li class="navtab"> <a href="{{relpath}}inputfile">Input</a> </li>
      </ul>
  -->

</div>
</div>


<div class="container">

    <div class="row-fluid">

        <div class="span8">    
<pre class="prettyprint linenums:1 lang-js ">
<?php
    $data = array (
        "fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
        "numbers" => array(1, 2, 3, 4, 5, 6),
        "holes"   => array("first", 5 => "second", "third")
    );
    $json_string = pretty_json(json_encode($data));
    echo $json_string;

    function pretty_json($json) {

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;
        
        // If this character is the end of an element, 
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element, 
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }
            
            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        $prevChar = $char;
    }

    return $result;
}
?>
</pre>
        </div>


        <div class="span4">
            <div class="well"> 
                <dl>
                    <dt>Description lists</dt>
                    <dd>A description list is perfect for defining terms.</dd>
                </dl>
            </div>
            
            <div class="well">this is for statistics</div>
            <div class="well">this is for statistics</div>
        </div>

    </div>
</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/prettify.js" type="text/javascript"></script>
<script  type="text/javascript">prettyPrint()</script>


</body>

<footer>
</footer>

</html>