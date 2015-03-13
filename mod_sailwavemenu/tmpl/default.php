<?php
/**
* @source Derived from the core joomla menu module.
*
* @copyright Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved. Modifed by Calum Polwart
* @license GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$path = realpath(JPATH_SITE . DIRECTORY_SEPARATOR . "results");  //TODO

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
echo "<ul>";
$counter = 0;
$incrementer = 0;
$items = array();
foreach($objects as $name => $object){
       $counter ++ ;
       $alias = pathinfo($name, PATHINFO_FILENAME);
       $filetype =  pathinfo($name, PATHINFO_EXTENSION);
       $menuItem = new stdClass();
       $validEntry = FALSE;
    if (is_dir($name))
        {
        if ($alias!=".." && $alias !="." && $alias !="") {
            echo "<li>".$counter."|D|". $alias . "</li>";
            //TODO remove empty folders?
            $menuItem->    id = $counter;
            $menuItem->    menutype = "";
            $menuItem->    title = $alias;
            $menuItem->    alias = $name;
            $menuItem->    note = "";
            $menuItem->    route = $name;
            $menuItem->    link = $name; //TODO
            $menuItem->    type = "component"; //TODO
            $menuItem->    level = ""; //TODO
            $menuItem->    language = "*";
            $menuItem->    browserNav = 0;
            $menuItem->    access = 1;
            $menuItem->    home = 0;
            $menuItem->    img = "";
            $menuItem->    template_style_id = 0; 
            $menuItem->    component_id = "";
            $menuItem->    parent_id = 1 ;//TODO
            $menuItem->    component = "com_sailwave"; 
            $menuItem->    deeper = "";
            $menuItem->    shallower = "";
            $menuItem->    level_diff = 0;
            $menuItem->    parent ="";
            $menuItem->    active ="";
            $menuItem->    flink = "";
            $menuItem->    anchor_css ="";
            $menuItem->    anchor_title="";
            $menuItem->    menu_image ="";
            $validEntry = TRUE;
        }
    } 
    else {
        if ($filetype=="html"){
            echo "<li>" .$counter."|F|". $alias."</li>";
            $menuItem->id = $counter;
            $menuItem->    menutype = "";
            $menuItem->    title = $alias;
            $menuItem->    alias = $name;
            $menuItem->    note = "";
            $menuItem->    route = $name;
            $menuItem->    link = $name; //TODO
            $menuItem->    type = "component"; //TODO
            $menuItem->    level = ""; //TODO
            $menuItem->    language = "*";
            $menuItem->    browserNav = 0;
            $menuItem->    access = 1;
            $menuItem->    home = 0;
            $menuItem->    img = "";
            $menuItem->    template_style_id = 0; 
            $menuItem->    component_id = "";
            $menuItem->    parent_id = 1 ;//TODO
            $menuItem->    component = "com_sailwave"; 
            $menuItem->    deeper = "";
            $menuItem->    shallower = "";
            $menuItem->    level_diff = 0;
            $menuItem->    parent ="";
            $menuItem->    active ="";
            $menuItem->    flink = "";
            $menuItem->    anchor_css ="";
            $menuItem->    anchor_title="";
            $menuItem->    menu_image ="";
            $validEntry = TRUE;    
        }
    } 
    if ($validEntry){
        $items [ $incrementer ] = $menuItem;
        $incrementer ++;
        }
    }
echo "</ul>";
print_r($items);
?>


