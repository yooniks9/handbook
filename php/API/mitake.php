<?php

    public static function send(
        $phoneNo, 
        $state, 
        $reference
    ){
        switch ($state) {
            case '5':
                // 已到貨
                $smsMsg = "您好，您訂購的產品已配達指定超商，提醒您在".date('m月d日', strtotime('+7 days'))."前領取，謝謝您的支持。";
                break;
            case '6':
                // 已取消
                $smsMsg = "您好，您的訂單(".$reference.")剛才已經申請取消囉！ 若您是信用卡付款，我們會再為您安排取消請款，謝謝您。";
                break;
            default:
                continue;
        }
        
        if (self::isPhone($phoneNo) && !empty($smsMsg)){
            $url = "http://smexpress.mitake.com.tw/SmSendGet.asp?encoding=UTF8&username=".MITAKE_USER."&password=".MITAKE_PASS."&smbody=".$smsMsg."&dstaddr=".$phoneNo;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            $result=curl_exec($ch);
            curl_close($ch);
        } else {
            $result = "not send";
        }
        return $result;
    }
