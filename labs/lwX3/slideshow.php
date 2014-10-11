<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    //require_once(SCRIPTS_DIR . "sign_in.inc.php");

    $scripts = array('lib/jquery.slideshow.js', 'slideshow.js');
    $styles = array('form_styles.css', 'jQuerySlideShow.css', 'slideshow.css');

    $vars['title']             = 'SlideShow';
    $vars['scripts']           = $scripts;
    $vars['pageStyles']        = $styles;
    $vars['content_template']  = 'slideshow.tpl';

    echo buildPage($vars);