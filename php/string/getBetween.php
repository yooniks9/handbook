<?php
function getBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}

//usage
$mystring = "aaa bbb ccc ddd eee fff gggg";
$start = "aaa";
$end = "gggg";
$result = getBetween($mystring,$start,$end);

echo $result; // return : " bbb ccc ddd eee fff "