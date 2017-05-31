<?php
    function returnPageName($url){
        //Position where file name begins
        $posBeforeFileName = strrpos($url, "/") + 1;
        //Returning e.g.: "index.php?andeverythingafter"
        $pageNameAndAfter = substr($url, $posBeforeFileName);
        //Get the start of ".php" or ".html"
        $posStartExtention = strrpos($pageNameAndAfter,".");
        //Only keeping page name just before the start of the extention
        $pageName = substr($pageNameAndAfter, 0, $posStartExtention);
        return $pageName;
    }
?>