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

use Mustache_Engine;

class Generator {

    private $js, $css, $menuitems, $title;
    private $mustache;

    /**
     * Constructs a page
     * @param config is an array of standard configuration with items: js (array of urls), css (array of urls), menuitems (associative array of urls) and title (string)
     */
    public function __construct($config = array()){
        $this->js = array();
        $this->css = array();
        $this->menuitems = array();
        $this->title = "The DataTank";

        if(!empty($config)){
            if(isset($config["js"])){
                $this->js = $config["js"];
            }
            if(isset($config["css"])){
                $this->css = $config["css"];
            }
            if(isset($config["menuitems"])){
                $this->menuitems = $config["menuitems"];
            }
            if(isset($config["title"])){
                $this->title = $config["title"];
            }
        }

        $this->mustache = new Mustache_Engine;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function addJS($url){
        $this->js[] = $url;
    }

    public function addCSS($url){
        $this->css[] = $url;
    }

    public function addMenuItem($title, $url, $active = false, $newwindow=false){
        $item = new \stdClass();
        $item->title = $title;
        $item->url = $url;

        $item->active = $active;
        $item->newwindow = $newwindow;

        $this->menuitems[] = $item;
    }

    public function generate($body){

        // Set data
        $data = array();
        $data['title'] = $this->title;
        $data['javascript'] = $this->js;
        $data['css'] = $this->css;
        $data['body'] = $body;
        $menu = new \stdClass();
        $menu->items = $this->menuitems;
        $data['menu'] = $menu;

        // Add bootstrap files as default
        $data['bootstrap_js'] = "";
        $bootstrap_js = @file_get_contents(__DIR__."/../../../includes/js/bootstrap.min.js");
        if($bootstrap_js){
            $data['bootstrap_js'] .= $bootstrap_js;
        }
        $data['bootstrap_css'] = "";
        $bootstrap_css = @file_get_contents(__DIR__."/../../../includes/css/bootstrap.min.css");
        if($bootstrap_css){
            $data['bootstrap_css'] .= $bootstrap_css;
        }
        $bootstrap_css = @file_get_contents(__DIR__."/../../../includes/css/bootstrap-responsive.min.css");
        if($bootstrap_css){
            $data['bootstrap_css'] .= $bootstrap_css;
        }

        // Get default template
        $template = @file_get_contents(__DIR__."/../../../includes/template/base.html");

        // Render HTML
        echo $this->mustache->render($template, $data);
    }
}
