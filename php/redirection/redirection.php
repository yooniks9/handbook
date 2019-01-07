<?php
    
    header("Location: http://example.com/myOtherPage.php");
    die();
    
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}