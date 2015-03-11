<?php
// Original code provided by andy@sailor.nu
// from sailwave discussion board on yahoo groups.
// 
// no direct access
defined('_JEXEC') or die;

class plgContentSailwave extends JPlugin {
    
    public function onContentPrepare($context, &$row, &$params, $page = 0) {
  
        //Look for a {sailwave: *} pattern
        if (strpos ( $row->text , "{sailwave:" ) === false ) {
            // No match found so leave the function
            return;
        }
        $lang = JFactory::getLanguage();
        $lang->load('plg_content_sailwave', JPATH_ADMINISTRATOR, NULL, true);
        $lang->load('plg_content_sailwave', JPATH_SITE, NULL, true);
        $remains = strstr($row->text , '{sailwave:');
        $sailwaveChunk = strstr($remains, '}', true);
        $sailwavePieces = explode (":",$sailwaveChunk);
        $fileref = trim($sailwavePieces[1]);
        //
        // set source file name and path
        $sailwavePath  = $this->params->get('sailwave_ftp_folder');
        $resultFile = JPATH_BASE.DIRECTORY_SEPARATOR.$sailwavePath.DIRECTORY_SEPARATOR.$fileref.".html";
        $scorestart = "<h3 class=";
        $scoreend = "<footer>";
        $scorestartKey = 0;
        $scoreendKey = 0;
        
        $sailwaveStyle = $this->params->get('sailwave_style');

        // read raw text as array
        if (file_exists( $resultFile)!=TRUE) {
            #Sailwave file does not exist
            $html = "<p class='info'>".JText::_(PLG_CONTENT_SAILWAVE_NO_RESULT)."</p>";
        } else {
            $rawText = file($resultFile) or die("Cannot read file");
        
            // join remaining data into string
            $resultData = join('', $rawText);

            //find the substrings
            $scorestartKey = strpos ( $resultData , $scorestart );
            $scoreendKey = strpos ( $resultData , $scoreend );

            //pull out just the results and the Sailwave footer
            $html=substr ( $resultData , $scorestartKey , $scoreendKey-$scorestartKey );
            $html = "<style>".$sailwaveStyle."</style> <div class='sailwave'" . $html."</div>";
        }
        //put it on the page

    $row->text = str_replace($sailwaveChunk."}",$html,$row->text);
   
    }
}
?>
