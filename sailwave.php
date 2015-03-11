<?php
// Original code provided by andy@sailor.nu
// from sailwave discussion board on yahoo groups.
// 
// no direct access
defined('_JEXEC') or die;

class plgContentSailwave extends JPlugin {
    
    public function onContentPrepare($context, &$row, &$params, $page = 0) {
        $row->text = str_replace("{sailwave: 01012015}","Sailwave Results Here",$row->text);
    
        // set source file name and path
        $resultFile = "results/namresults.html";
        $scorestart = "<h3 class=";
        $scoreend = "<footer>";
        $scorestartKey = 0;
        $scoreendKey = 0;

        // read raw text as array
        $rawText = file($resultFile) or die("Cannot read file");

        // join remaining data into string
        $resultData = join('', $rawText);

        //find the substrings
        $scorestartKey = strpos ( $resultData , $scorestart );
        $scoreendKey = strpos ( $resultData , $scoreend );

        //pull out just the results and the Sailwave footer
        $html=substr ( $resultData , $scorestartKey , $scoreendKey-$scorestartKey );

        //put it on the page
        echo $html;
        
    }
}
?>
