<?php
// Original code provided by andy@sailor.nu
// from sailwave discussion board on yahoo groups.
// 
// no direct access
defined('_JEXEC') or die;

class plgButtonSailwave extends JPlugin {
    
    public function onDisplay($name) {
        $button = new JObject();
        $button->set('text','HelloButton');
        $button->set('name', 'HelloButton');
        return $button;
    }
}
?>
