<?php

    require_once("config.inc.php");
    require_once(SCRIPTS_DIR . "common.inc.php");
    require_once(SCRIPTS_DIR . "sign_in.inc.php");

    $scripts = array('lib/game.inc.js', 'game.js');
    $styles = array('form_styles.css', 'game.css');

    $vars['title']             = 'Barley-Break';
    $vars['scripts']           = $scripts;
    $vars['pageStyles']        = $styles;
    $vars ['content_template'] = 'game.tpl';

    echo buildPage($vars);

