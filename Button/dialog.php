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
        <form name="inserthtml" id="inserthtml" onSubmit="return false;">
            <fieldset>
                <table class="properties">                   
                    <tr>
                        <td colspan="2"><h3><?= JText::_('Sailwave Results Inserter') ?></h3></td>
                    </tr>
                    <tr><td colspan="2"><b>If the Sailwave Results file has already been uploaded select it below:</b></td></tr>
                    <tr>
                        <td>Select File: </td>
                        <td nowrap>
                   <?php
                   $filepath = JPATH_BASE. DIRECTORY_SEPARATOR . "results";
                   if ( $_GET['dir'] ) {
                        $filepath = $filepath. DIRECTORY_SEPARATOR . $_GET['dir'];
                        $filechain = $_GET['dir'] . DIRECTORY_SEPARATOR;
                   } else {
                       $filechain = "";
                   }
                      
                   $files = scandir ( $filepath);
                   foreach($files as $file) {
                       if (is_dir($filepath. DIRECTORY_SEPARATOR . $file)){
                                   echo "<a href='?dir=".$filechain . $file."&ih_name=".$ih_name ."'>".$file . "/</a><br />";
                       } else {
                           if (pathinfo(JPATH_BASE. DIRECTORY_SEPARATOR .$file, PATHINFO_EXTENSION)=="html"){
                            echo "<a href='#' onclick=\"document.getElementById('filename').value = '". $filechain.  $file. "';\">".pathinfo(JPATH_BASE. DIRECTORY_SEPARATOR .$file, PATHINFO_FILENAME)."</a><br />";
                           }
                       }
                   }
   

                   ?>
                    </tr>
                    <tr><td colspan="2"><b>Otherwise enter the filename below, and ensure the scorer knows the correct filename to upload:</b></td></tr>
                    <tr>
                        <td>Filename : </td>
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