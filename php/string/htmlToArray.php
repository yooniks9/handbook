<?php
$html = <<<HTM
<p>aaaaaaaaaaaa</p>
<p>bbbbbbbbbbbb</p>
<p>cccccccccccc</p>
<p>dddddddddddd</p>
HTM;

$dom = new \DOMDocument();
$paragraphs = array();
libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="utf-8" ?>' .$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD); // fix utf problem
libxml_clear_errors();

foreach($dom->getElementsByTagName('p') as $node){
    $paragraphs[] = $dom->saveHTML($node);
}
var_dump($paragraphs);

// result
// array(4) { [0]=> string(19) "
//     aaaaaaaaaaaa
    
//     " [1]=> string(19) "
//     bbbbbbbbbbbb
    
//     " [2]=> string(19) "
//     cccccccccccc
    
//     " [3]=> string(19) "
//     dddddddddddd
    
//     " }

// revert to original
$revert = implode(" ",$paragraphs);
var_dump($revert);

//result
// string(79) "
// aaaaaaaaaaaa

// bbbbbbbbbbbb

// cccccccccccc

// dddddddddddd

// "