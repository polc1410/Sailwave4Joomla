<?php
// Original code provided by andy@sailor.nu
// from sailwave discussion board on yahoo groups.
// 
// no direct access
defined('_JEXEC') or die;

class plgButtonSailwave extends JPlugin {
    
    function onDisplay($name) {
        $button = new JObject();
        $button->set('text','Sailwave');
        $button->set('onclick', 'alert(\'Sailwave Pressed\');');
        $button->set('name', 'Sailwave');
        return $button;
    }
}
?>
