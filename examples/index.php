<?php

include_once("../vendor/autoload.php");

use tdt\pages\Generator;

$generator = new Generator();
// Set title
$generator->setTitle("This is an example page");

// Add a javascript library
// $generator->addJS("http://....js");

// Add some CSS
// $generator->addCSS("http://....css");

// Add a menu item: title, url, weight, active, open in new window
$generator->addMenuItem("This page", "http://thedatatank.com", false, true);
$generator->addMenuItem("This page", "#", true, false);
$generator->addMenuItem("This page", "#", false, false);

// Body
$body = '
<h1>Hello World!</h1>
<table class="table">
    <thead>
        <th>Subject</th>
        <th>Object</th>
        <th>Predicate</th>
    </thead>
    <tr>
        <td>subject</td>
        <td>object</td>
        <td>predicate</td>
    </tr>
</table>
<ul>
    <li>item</li>
    <li>item2</li>
    <ul>
        <li>item2.1</li>
        <li>item2.2</li>
    </ul>
</ul>';

// Generate the page
$generator->generate($body);