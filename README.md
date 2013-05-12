# tdt/pages

A library to print nice pages quickly

## Why

When we need nice pages across a project which main focus is API output, and not a CMS, we might use a very simple and light system to print simple, yet beautiful and interactive pages.

## Usage

```php

use tdt\pages\Generator;
$generator = new Generator();
//set Title
$generator->setTitle("This is an example page");

//add a javascript library
$generator->addJS("http://....js");

//add some css
$generator->addCSS("http://....css");

//add a menu item: title, url, weight, active, open in new window
$generator->addMenuItem("This page", "#",0,true,false);

//generate the page
$generator->generate("<h1>Hello World!</h1>");

```

## Copyright & license

© OKFN Belgium
AGPLv3
