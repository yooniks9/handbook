<?php
//create folder
$year = date("Y");
$month = date("m");
if (!file_exists("/var/www/public/uploads/images/$year/$month")) {
    mkdir("/var/www/public/uploads/images/$year/$month", 0775, true);
}

$html = $post['body'];
$dom = new \DomDocument();
libxml_use_internal_errors(true);
$dom->loadHtml('<?xml encoding="utf-8" ?>' .$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();
$images = $dom->getElementsByTagName('img');
        
foreach($images as $img){
    $src = $img->getAttribute('src');
    
    // if the img source is 'data-url'
    if(preg_match('/data:image/', $src)){
        
        // get the mimetype
        preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
        $mimetype = $groups['mime'];
        
        // Generating a random filename
        $filename = uniqid();
        $filepath = "/uploads/images/$year/$month/$filename.$mimetype";

        // @see http://image.intervention.io/api/
        $image = Image::make($src)
            // resize if required
            /* ->resize(300, 200) */
            ->encode($mimetype, 100) 	// encode file to the specified mimetype
            ->save(public_path($filepath));
            
        $new_src = $filepath;
        $img->removeAttribute('src');
        $img->setAttribute('src', $new_src);
    } // <!--endif
    // save to local if external source
    if(preg_match('/http/', $src)){
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
        
        $filepath = "/var/www/public/uploads/images/$year/$month/$filename.$file_ext";
        $new_src = $filepath;
        $img->removeAttribute('src');
        $img->setAttribute('src', $new_src);
    }
} // <!--endforeach

$result = $dom->saveHTML();

//result: you will see all the images post or external links are saved to your local storage