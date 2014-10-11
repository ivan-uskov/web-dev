<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$title}</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
    {foreach from=$pageStyles item=style}
      <link rel="stylesheet" type="text/css" href="css/{$style}" media="all" />
    {/foreach}
  </head>
  <body>
    <div class="main">
      {include file="top_menu.tpl"}
      {include file="$content_template"}
    </div>
    {foreach from=$scripts item=scriptName}
      <script type="text/javascript" src="js/{$scriptName}"></script>
    {/foreach}
  </body>
</html>