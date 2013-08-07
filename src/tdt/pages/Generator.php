<?php
/**
 * A class which generates a page for RESTful APIs with these features
 *  * Load javascript libraries
 *  * Load css style sheets
 *  * Set menu items (+active link)
 *  * Set title
 *
 * It *does not* print HTTP Headers!
 *
 * Copyright (C) 2013 by OKFN Belgium
 * License: AGPLv3
 * Author: Pieter Colpaert
 * Author: Michiel Vancoillie
 */

namespace tdt\pages;

define('PACKAGE_PATH', '/packages/tdt/pages/');

use Mustache_Engine;

class Generator {

    private $js, $css, $menuitems, $title, $baseURL;
    private $mustache;

    /**
     * Constructs a page
     * @param array $config     contains standard configuration with items: js (array of URLs), css (array of URLs), and title (string), baseURL
     */
    public function __construct($config = array()){
        $this->js = array();
        $this->css = array();
        $this->menuitems = array();
        $this->title = "The DataTank";

        if(class_exists('\app\core\Config')){
            // Get root folder for building relative URLS for assets
            $this->baseURL = '/'. \app\core\Config::get('general', 'subdir') . PACKAGE_PATH;
        }else{
            // Assume the example file is served
            $this->baseURL = '../public/';
        }

        if(!empty($config)){

            if(isset($config["js"])){
                $this->js = $config["js"];
            }

            if(isset($config["css"])){
                $this->css = $config["css"];
            }

            if(isset($config["title"])){
                $this->title = $config["title"];
            }

            if(isset($config["baseURL"])){
                $this->baseURL = $config["baseURL"];
            }
        }

        $this->mustache = new Mustache_Engine;
    }

    /**
     * BaseURL setter
     * @param string  $url      URL to the public folder (where the assets are)
     */
    public function setBaseURL($url){
        $this->baseURL = $baseURL;
    }

    /**
     * Title setter
     * @param string  $title     the page title
     */
    public function setTitle($title){
        $this->title = $title;
    }

    /**
     * Add a JS link
     * @param string  $url       a public URL to the JS file
     */
    public function addJS($url){
        $this->js[] = $url;
    }

    /**
     * Add a CSS link
     * @param string  $url       a public URL to the CSS file
     */
    public function addCSS($url){
        $this->css[] = $url;
    }

    /**
     * Add a menu item
     * @param string  $title     the menu caption
     * @param string  $url       the URL to link to
     * @param boolean $active    set this menu item as the active one
     * @param boolean $newwindow open link in new window
     */
    public function addMenuItem($title, $url, $active = false, $newwindow=false){
        $item = new \stdClass();
        $item->title = $title;
        $item->url = $url;

        $item->active = $active;
        $item->newwindow = $newwindow;

        $this->menuitems[] = $item;
    }

    /**
     * Generate the page
     * @param string $body
     */
    public function generate($body){

        // Set the data
        $data = array();
        $data['title'] = $this->title;
        $data['javascript'] = $this->js;
        $data['css'] = $this->css;
        $data['body'] = $body;
        $menu = new \stdClass();
        $menu->items = $this->menuitems;
        $data['menu'] = $menu;

        // Push default JS
        array_push($data['javascript'], $this->baseURL . 'js/script.min.js');

        // Push default CSS
        array_push($data['css'], $this->baseURL  . 'css/main.css');

        $data['logo'] = $this->baseURL  . 'img/logo.png';

        // Get default template
        $template = @file_get_contents(__DIR__."/../../../includes/template/base.html");

        // Render HTML
        echo $this->mustache->render($template, $data);
    }
}
