<?  
/*
 * Insert HTML editor button plugin for Joomla! file  
 */
    define( '_JEXEC', 1 );
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'JPATH_BASE', realpath( '..'.DS.'..'.DS.'..'.DS ) );   
    require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
    require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );
    $mainframe =& JFactory::getApplication('administrator');       
    jimport( 'joomla.plugin.plugin' ); 
    $language = JFactory::getLanguage();
    //$language->load('plg_editors-xtd_sailwave-button', JPATH_ADMINISTRATOR, NULL, true);
    //$language->load('plg_editors-xtd_sailwave-button', JPATH_SITE, NULL, true);
    $language->load('plg_editors-xtd_sailwave-button');
    $ih_name = addslashes( $_GET['ih_name'] );
?>
<html>
    <head>
    <title><?= JText::_('Sailwave Results Inserter') ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="dialog.css" />
    <script type="text/javascript">
 
        function InsertHtmlDialogokClick() {
            var result="OK";
               var filenamed = document.getElementById("filename").value ;
            window.parent.SailwaveCallback( '<?= $ih_name ?>', result, filenamed );
            window.parent.SqueezeBox.close();     
        }
 
        function InsertHtmlDialogcancelClick() {
            window.parent.SqueezeBox.close();
        }      
    </script>
    </head>
    <body>
        <?php 
            print_r ($language);
           ?>
        <form name="inserthtml" id="inserthtml" onSubmit="return false;">
            <fieldset>
                <table class="properties">                   
                    <tr>
                        <td colspan="2"><h3><?= JText::_('Sailwave Results Inserter') ?></h3></td>
                    </tr>
                    <tr><td colspan="2"><b><?= JText::_(PLG_EDITORS-XTD_SAILWAVE_IFUPLOADED) ?></b></td></tr>
                    <tr>
                        <td><?= JText::_(PLG_EDITORS-XTD_SAILWAVE_SELECTFILE) ?></td>
                        <td nowrap>
                   <?php
                   $corepath = JPATH_BASE. DIRECTORY_SEPARATOR . "results";
                   $filepath = $corepath;
                   if ( $_GET['dir'] ) {
                        $filepath = $filepath. DIRECTORY_SEPARATOR . $_GET['dir'];
                        $filechain = $_GET['dir'] . DIRECTORY_SEPARATOR;
                   } else {
                       $filechain = "";
                   }
                      
                   $files = scandir ( $filepath);
                   foreach($files as $file) {
                       if (is_dir($filepath. DIRECTORY_SEPARATOR . $file)){
                           if ($file != "."){
                               if ($file ==".." && realpath($filepath)!= $corepath) {
                                   echo "<a href='?dir=".$filechain . $file."&ih_name=".$ih_name ."'>".$file . "/</a><br />";
                               } elseif ($file !="..") {
                                   echo "<a href='?dir=".$filechain . $file."&ih_name=".$ih_name ."'>".$file . "/</a><br />";
                               }
                           }        
                       } else {            
                           if (pathinfo(JPATH_BASE. DIRECTORY_SEPARATOR .$file, PATHINFO_EXTENSION)=="html"){
                                 echo "<a href='#' onclick=\"document.getElementById('filename').value = '". $filechain.  pathinfo(JPATH_BASE. DIRECTORY_SEPARATOR .$file, PATHINFO_FILENAME). "';\">".pathinfo(JPATH_BASE. DIRECTORY_SEPARATOR .$file, PATHINFO_FILENAME)."</a><br />";
                           }
                       }
                   }
   

                   ?>
                    </tr>
                    <tr><td colspan="2"><b><?= JText::_(PLG_EDITORS-XTD_SAILWAVE_TYPEFILE) ?></b></td></tr>
                    <tr>
                        <td><?= JText::_(PLG_EDITORS-XTD_SAILWAVE_FILENAME) ?></td>
                        <td nowrap><input class="" id="filename" name="filename" value=""></td>
                    </tr
         </table>
            </fieldset>
            <fieldset>
                <table class="properties">
                    <tr>
                        <td colspan="1" align="left" valign="bottom" nowrap>
                            <input type="submit" value="<?= JText::_('Insert') ?>" onClick="InsertHtmlDialogokClick()" class="bt">
                            <input type="button" value="<?= JText::_('Cancel') ?>" onClick="InsertHtmlDialogcancelClick()" class="bt">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </body>
</html>