<?php
/**
* @source Derived from the core joomla menu module.
*
* @copyright Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved. Modifed by Calum Polwart
* @license GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
//THIS STUFF BELONGS IN HELPER
$sailwavepath = realpath(JPATH_SITE . DIRECTORY_SEPARATOR . "results");  //TODO
$pathdepth = substr_count ( $sailwavepath , DIRECTORY_SEPARATOR );
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($sailwavepath), RecursiveIteratorIterator::SELF_FIRST);
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
            //TODO remove empty folders?
            $menuItem->    id = $counter;
            $menuItem->    menutype = "";
            $menuItem->    title = $alias;
            $menuItem->    alias = $name;
            $menuItem->    note = "";
            $menuItem->    route = $name;
            $menuItem->    link = $name; //TODO
            $menuItem->    type = "separator"; //TODO
            $menuItem->    level = substr_count ( $name , DIRECTORY_SEPARATOR )-$pathdepth ; 
            //$menuItem->title = $menuItem->alias . "(".$menuItem->level.")";
            $menuItem->    language = "*";
            $menuItem->    browserNav = 0;
            $menuItem->    access = 1;
            if($name == $sailwavepath) {
                $menuItem->    home = 1;
            } else {
                $menuItem -> home = 0;
            }
            $menuItem->    img = "";
            $menuItem->    template_style_id = 0; 
            $menuItem->    component_id = "";
            $parent = dirname ( $name );
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
            $menuItem->id = $counter;
            $menuItem->    menutype = "";
            $menuItem->    title = $alias;
            $menuItem->    alias = $name;
            $menuItem->    note = "";
            $menuItem->    route = $name;
            $menuItem->    link = $name; //TODO
            $menuItem->    type = "url"; //TODO
            $menuItem->    level = substr_count ( $name , DIRECTORY_SEPARATOR )-$pathdepth; 
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
        $list [ $incrementer ] = $menuItem;
        $incrementer ++;
        }
    }
echo "</ul>";
//print_r($items);
?>

<?php // The menu class is deprecated. Use nav instead. ?>
<ul class="nav menu<?php echo $class_sfx;?>"<?php
$tag = '';

if ($params->get('tag_id') != null)
{
$tag = $params->get('tag_id') . '';
echo ' id="' . $tag . '"';
}
?>>
<?php
foreach ($list as $i => &$item)
{
$class = 'item-' . $item->id;

if (($item->id == $active_id) OR ($item->type == 'alias' AND $item->params->get('aliasoptions') == $active_id))
{
$class .= ' current';
}

if (in_array($item->id, $path))
{
$class .= ' active';
}
elseif ($item->type == 'alias')
{
$aliasToId = $item->params->get('aliasoptions');

if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
{
$class .= ' active';
}
elseif (in_array($aliasToId, $path))
{
$class .= ' alias-parent-active';
}
}

if ($item->type == 'separator')
{
$class .= ' divider';
}

if ($item->deeper)
{
$class .= ' deeper';
}

if ($item->parent)
{
$class .= ' parent';
}

if (!empty($class))
{
$class = ' class="' . trim($class) . '"';
}

echo '<li' . $class . '>';

// Render the menu item.
switch ($item->type) :
case 'separator':
case 'url':
case 'component':
case 'heading':
require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type); //todo
break;

default:
require JModuleHelper::getLayoutPath('mod_menu', 'default_url'); //todo
break;
endswitch;

// The next item is deeper.
if ($item->deeper)
{
echo '<ul class="nav-child unstyled small">';
}
elseif ($item->shallower)
{
// The next item is shallower.
echo '</li>';
echo str_repeat('</ul></li>', $item->level_diff);
}
else
{
// The next item is on the same level.
echo '</li>';
}
}
?></ul>

