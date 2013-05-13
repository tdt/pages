# tdt/pages

A library to print nice pages quickly

## Why

When we need nice pages across a project which main focus is API output, and not a CMS, we might use a very simple and light system to print simple, yet beautiful and interactive pages.

## Usage

```php

use tdt\pages\Generator;

$generator = new Generator();
// Set title
$generator->setTitle("This is an example page");

// Add a javascript library
$generator->addJS("http://....js");

// Add some CSS
$generator->addCSS("http://....css");

// Add a menu item: title, url, active, open in new window
$generator->addMenuItem("This page", "#", true, false);

// Generate the page
$generator->generate("<h1>Hello World!</h1>");

```

## Copyright & license

© OKFN Belgium
AGPLv3
