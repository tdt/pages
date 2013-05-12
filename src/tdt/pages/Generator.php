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
 */
class Generator {

    private $js,$css,$menuitems,$title;

    /**
     * Constructs a page
     * @param config is an array of standard configuration with items: js (array of urls), css (array of urls), menuitems (associative array of urls) and title (string)
     */
    public function __construct($config = array()){
        $this->js = array();
        $this->css = array();
        $this->menuitem = array();
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

    public function addMenuitem($title, $url, $weigth = 0, $active = false, $newwindow=false){
        $item = array();
        $item["title"] = $title;
        $item["url"] = $url;

        $item["weight"] = $weight;
        $item["active"] = $active;
        $item["newwindow"] = $newwindow;
        
        $this->menuitems[] = $item;
    }

    // src: http://stackoverflow.com/questions/2699086/sort-multidimensional-array-by-value-2
    private function aasort (&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
    }

    public function generate($body){
        //sort menu items
        $this->aasort($this->menuitems,"weight");

        // print HTML heading
?>
<html>
    <head profile="http://dublincore.org/documents/dcq-html/">
        <title><?php echo $this->title; ?></title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <meta name="DC.title" content="<?php echo $this->title; ?>"/>

<?php
        foreach($this->js as $url){
?>
        <script src="<?php echo $url; ?>"></script>
<?php
        }
?>
        <link rel="stylesheet" type="text/css" href="http://thedatatank.com/wp-content/themes/wordpress-theme-okfn/style.css" media="screen" />
        <style>
            body{
                margin-left: 200px;
                margin-top: 50px;
            }
        </style>
    </head>

    <body>
<?php
        // print HTML body header
?>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <div id="headline" class="brand"><?php echo $this->title; ?></div>
                    <div id="menu" class="menu">
                        <ul>
<?php
        foreach($this->menuitems as $item){
            $arg = "";
            if($item["newwindow"]){
                $arg .= "target=\"_blank\"";
            }
            //indent for nice html output
            echo "                            ";
            echo "<li><a href=\"" . $item["url"] ."\" " . $arg .">" . $item["title"]  . "</a></li>\n";
        }
        
?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php
        // print HTML body body
        echo $body;
        // print HTML footer
?>
        <footer>&copy; OKFN Belgium - We Open Data &ndash; The DataTank &ndash Visit our <a href="http://thedatatank.com/" target="_blank">website</a></footer>
    </body>
</html>
<?php
    }
    
}
