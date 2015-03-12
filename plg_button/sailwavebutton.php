<?php
/**
 * @author Calum Polwart using examples from internet
 * @date: 12 Mar 2015
 *
 * @copyright  Copyright (C) 2015 Calum Polwart
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

class plgButtonSailwavebutton extends JPlugin {
    	/**
* Load the language file on instantiation.
*
* @var boolean
* @since 3.1
*/
protected $autoloadLanguage = true;
    
    function onDisplay($name) {
        $doc = JFactory::getDocument();
        $jsCode = "     
            function SailwaveCallback( editor, result, filenamed){
                if( result  ) { 
                        var textInsertion = '{sailwave: '+filenamed+'}';
                    jInsertEditorText(textInsertion, editor);
                }
            }
       
            ";
        $doc->addScriptDeclaration($jsCode);
        $link = '../plugins/editors-xtd/sailwavebutton/dialog.php?ih_name='.$name;
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
