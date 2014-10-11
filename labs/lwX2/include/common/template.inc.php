<?php
    /**
     * Берёт файл /template/<$templateName> заменяют все входящие строки
     * формата {$<название переменной>} на конкретное значение
     * @param string $templateName название шаблона
     * @param array $vars ассоциативный массив
     * который содержит переменные и их значения
     * для замещение в шаблоне
     * @return string возвращает шаблон с заменённым placeholder
     */
    function getView($templateName, $vars = array())
    {
        $smarty = new Smarty();
        $smarty->template_dir = TEMPLATE_DIR;
        $smarty->compile_dir = TEMPLATE_COMPILED_DIR;
        $smarty->assign($vars);
        return $smarty->fetch($templateName);
    }

    function getViewOld($templateName, $vars = array())
    {
        $tpl = null;
        $templatePath = SITE_ROOT . TPL_PATH . $templateName;
        if(file_exists($templatePath))
        {
            $tpl = file_get_contents($templatePath);
            $tpl = preg_replace('/[{][$]([a-zA-Z]{0,30})[}]/e', 'isset($vars["$1"]) ? $vars["$1"] : ""', $tpl);
        }
        return $tpl;
    }

    /**
     * Из массива имён стилей формирует соответсвующий html текст
     * @param array $styles
     * @return string
     */
    function addStyles($styles)
    {
        $stylesHtml = '';
        foreach ($styles as $num => $styleName)
        {
            $stylePath = STYLES_DIR . $styleName;
            $stylesHtml = $stylesHtml .
                 '<link rel="stylesheet" type="text/css" href="' . $stylePath . '" media="all" />';
        }
        return $stylesHtml;

    }

    function addScripts($scripts)
    {
        $scriptsHtml = '';
        foreach ($scripts as $num => $scriptName)
        {
            $javascriptPath = JAVA_SCRIPTS_DIR . $scriptName;
            $scriptsHtml = $scriptsHtml .
                '<script type="text/javascript" src="' . $javascriptPath . '"></script>';
         //   var_dump($scriptsHtml);
        }
        return $scriptsHtml;

    }

    function buildPage($vars)
    {
        return getView(MAIN_TEMPLATE_PATH, (array)$vars);
    }
