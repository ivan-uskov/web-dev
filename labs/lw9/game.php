<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    require_once(SCRIPTS_DIR . "sign_in.inc.php");

    $scripts = array('classes/block.class.js', 'classes/field.class.js', 'game.js');
    $styles = array('form_styles.css', 'game.css');

    $pageVars['title']      = 'Barley-Break';
    $pageVars['scripts']     = addScripts($scripts);
    $pageVars['pageStyles'] = addStyles($styles);

    $tplVars = array
    (

    );

    echo buildPage('game.tpl', $tplVars, $pageVars);

