<?php

include_once("../vendor/autoload.php");

use tdt\pages\Generator;

$generator = new Generator();
//set Title
$generator->setTitle("This is an example page");

//add a javascript library
//$generator->addJS("http://....js");

//add some css
//$generator->addCSS("http://....css");

//add a menu item: title, url, weight, active, open in new window
$generator->addMenuItem("This page", "#",0,true,false);
$generator->addMenuItem("This page", "#",1,true,false);
$generator->addMenuItem("This page", "#",2,true,false);

//make some body

$body = '<h1>Hello World!</h1><table border=3><tr><td>subject</td><td>object</td><td>predicate</td></tr></table><ul><li>item<li>item2<ul><li>item2.1<li>item2.2</ul></ul>';

//generate the page
$generator->generate($body);