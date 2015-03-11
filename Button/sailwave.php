<?php
// Original code provided by andy@sailor.nu
// from sailwave discussion board on yahoo groups.
// 
// no direct access
defined('_JEXEC') or die;

class plgButtonSailwave extends JPlugin {
    
    function onDisplay($name) {
        $doc = JFactory::getDocument();
        $jsCode = "
                function insertText(nameOfEditor) {
                    jInsertEditorText('Hello World, I am doing just fine', nameOfEditor);
                }
               
            function SailwaveCallback( editor, result){
                if( result  ) { 
                    alert(result);
                    insertText('CALUM');
                }
            }
       
            ";
        $doc->addScriptDeclaration($jsCode);
        $link = '../plugins/editors-xtd/sailwave/dialog.php?ih_name='.$name;
        JHTML::_('behavior.modal');
        $button = new JObject();
        $button->set('modal', true);
        $button->set('text','Sailwave');
        //$button->set('onclick', 'insertText(\''.$name.'\');');
        $button->set('name', 'Sailwave');
        $button->set('link', $link);
        $button->set('options', "{handler: 'iframe', size: {x: 570, y: 400}}");
        return $button;
    }
}
?>
