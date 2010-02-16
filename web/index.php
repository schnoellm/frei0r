<?php

/* TO CHANGE WEBSITE CONTENTS DON'T EDIT THIS FILE
   instead you should be modifying index.org
   and in general all *.org files (see orgmode.org)
   these files are then rendered serverside
   
   THIS PHP FILE CONTAINS NO RELEVANT CONTENT */


define("DYNE_DEBUG_RENDERING_TIME", false);
if (DYNE_DEBUG_RENDERING_TIME) {
    require_once "include/simple_timer.class.php";
    $smarty->assign("timer", new SimpleTimer);
}

/* Smarty template class configuration */
if (!defined('SMARTY_DIR')) {
    define("SMARTY_DIR", "/usr/share/php/smarty/libs/"); }
if (!is_dir(constant("SMARTY_DIR")) || !require_once("smarty/Smarty.class.php")) {
    echo "SMARTY is supposed to be installed in " . constant("SMARTY_DIR") . " but is not.";
    echo "Install it or edit SMARTY_DIR in " . __FILE__;
    exit;
}

function showfile($f) {
  $fd = fopen("$f","r");
  if(!$fd) { $text = "<h1>ERROR: $f not found</h1>";
 } else {	 
    $st = fstat($fd);
    $text = fread($fd,$st[size]); fclose($fd);
  }
  echo($text);
}

global $smarty;
$smarty = new Smarty;
$smarty->compile_check = true; 
$smarty->debugging     = false;
$smarty->caching       = 0;

$smarty->cache_dir     = "cache";
$smarty->template_dir  = "templates";
$smarty->compile_dir   = "templates_c";
$smarty->plugins_dir   = array('/usr/share/php/smarty/plugins');


$smarty->assign("page_class",  "software org-mode");
$smarty->assign("page_hgroup", "<h1>Frei0r</h1>");
$smarty->assign("page_title",  "free video effect plugins");

$smarty->display("PARTIALS/_header.tpl");

// sidebar
$smarty->display("software/doctypes.tpl");
showfile("toc.html");

// page content
showfile("body.html");

$smarty->display("PARTIALS/_footer.tpl");

?>
