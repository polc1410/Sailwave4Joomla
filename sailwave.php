<?php
// Original code provided by andy@sailor.nu
// from sailwave discussion board on yahoo groups.
// 
// no direct access
defined('_JEXEC') or die;

class plgContentSailwave extends JPlugin {
    
    public function onContentPrepare($context, &$row, &$params, $page = 0) {
        $row->text = str_replace("{sailwave: 01012015}","Sailwave Results Here",$row->text);
    }
}
?>
