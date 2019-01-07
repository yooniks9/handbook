<?php
//驗證IPv4
function isIPv4($str){
    if (filter_var($str, FILTER_VALIDATE_IP)) {
        return true;    // valid
    } else {
        return false;   // invalid
    }
}
