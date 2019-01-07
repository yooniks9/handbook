<?php
$html = <<<HTM
<a href="https://placeholder.com"><img src="http://via.placeholder.com/350x150.png"></a>
<a href="https://placeholder.com"><img src="http://via.placeholder.com/400x150.png"></a>
<a href="https://placeholder.com"><img src="http://via.placeholder.com/350x400.png"></a>
<a href="https://placeholder.com"><img src="http://via.placeholder.com/350x300.png"></a>
HTM;

//create folder
$year = date("Y");
$month = date("m");
if (!file_exists("/var/www/public/uploads/images/$year/$month")) {
    mkdir("/var/www/public/uploads/images/$year/$month", 0775, true);
}
$new_images = array();
$dom = new \DomDocument();
libxml_use_internal_errors(true);
$dom->loadHtml('<?xml encoding="utf-8" ?>' .$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();
$images = $dom->getElementsByTagName('img');

foreach($images as $img){
    $src = $img->getAttribute('src');
    $file_ext = pathinfo($src, PATHINFO_EXTENSION);
    $file_ext = preg_replace('/\?.*/', '', $file_ext);
    
    $filename = uniqid();
    $storage = "/var/www/public/uploads/images/$year/$month/$filename.$file_ext";
    
    // save image to storage
    $ch = curl_init($src);
    $fp = fopen($storage, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    
    $filepath = "/uploads/images/$year/$month/$filename.$file_ext";
    $new_src = $filepath;
    $img->removeAttribute('src');
    $img->setAttribute('src', $new_src);
} // <!--endforeach

$result = $dom->saveHTML();
echo($result);

//result you will see the images and saved to your local storage
// <?xml encoding="utf-8" ?>
// <a href="https://placeholder.com"><img src="/uploads/images/2018/01/5a6ff51238f86.png"></a>
// <a href="https://placeholder.com"><img src="/uploads/images/2018/01/5a6ff5128c5a2.png"></a>
// <a href="https://placeholder.com"><img src="/uploads/images/2018/01/5a6ff512dfd76.png"></a>
// <a href="https://placeholder.com"><img src="/uploads/images/2018/01/5a6ff51340f05.png"></a>
