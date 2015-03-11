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

        // read raw text as array
        if (file_exists( $resultFile)!=TRUE) {
            #Sailwave file does not exist
            $html = "<p class="info">Sorry no results are yet available.</p>";
        } else {
            $rawText = file($resultFile) or die("Cannot read file");
        
            // join remaining data into string
            $resultData = join('', $rawText);

            //find the substrings
            $scorestartKey = strpos ( $resultData , $scorestart );
            $scoreendKey = strpos ( $resultData , $scoreend );

            //pull out just the results and the Sailwave footer
            $html=substr ( $resultData , $scorestartKey , $scoreendKey-$scorestartKey );
        }
        //put it on the page
    $row->text = str_replace($sailwaveChunk."}",$html,$row->text);
   
    }
}
?>
