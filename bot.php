<?php
define('API_KEY',"512744759:AAEEBjj4BWvNrg2SmcZOHGhG_yDssIsoQSI"); //<====== 
$chuser = "ahmadrezam1331"; //<==== آی دی کاتال
/*
آی دی کانال را بدون
@
وارد کنید
**مهم:
ربات حتما باید ادمین کانال باشد
--------------------------------
FoxLearn.ir | Telegram:@foxlearnir
*/
//******************
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
		return "null";
    }else{
        return json_decode($res);
    }
}
//******************
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$textmsg = $message->text;
$type = $update->message->chat->type;
//******************
$isjoin = bot('getChatMember',['chat_id'=>"@$chuser",'user_id'=>$from_id]);
$isjoin = $isjoin->result->status;
//******************
if($type == "private")
{
	if($isjoin != "left")
	{
		//دستورات اصلی ربات را در این بخش قرار دهید ==>
		if($textmsg == "/start")
		{
			bot('sendMessage',['chat_id'=>$chat_id,'text'=>"سلام,شما در کانال ما عضو هستید."]);
		}
		//<==دستورات اصلی ربات را در این بخش قرار دهید
	}
	else{
		bot('sendMessage',['chat_id'=>$chat_id,'text'=>"شما در کانال @$chuser عضو نیستنید.لطفا پس از عضویت به ربات برگردید و دستور /start را ارسال کنید."]);
	}
}
//FoxLearn.ir | Telegram:@foxlearnir
