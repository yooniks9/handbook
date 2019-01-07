<?php
//驗證信箱
function isEmail($str){
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return true;    // valid
    } else {
        return false;   // invalid
    }
}
?>