<?php
ob_start();
$token = "6052776820:AAFoQuUnPwxzrMd0tDAr6XBzHdWFXrzYmkw";
$info = json_decode(file_get_contents("https://api.telegram.org/bot$token/getMe"));
$userr = $info->result->username;
define('API_KEY', $token);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/"
     .$method;
$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
bot('setwebhook',[
"url"=>$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']
]);
function hmo($hmoooo,$d666d6){$sttr = str_replace(".","",$d666d6);return preg_match("#$sttr#",$hmoooo);}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id ?? $update->callback_query->message->chat->id;
$from_id = $message->from->id ?? $update->callback_query->from->id;
$text = $message->text;
$message_id = $message->message_id ?? $update->callback_query->message->message_id;
$name = $message->from->first_name ?? $update->callback_query->from->first_name;
$username = $message->from->username;
$data = $update->callback_query->data;
mkdir("hmo");
if(!$text){
if($message->photo){
	$base64 = base64_encode(rand(5,555))."png";
	$file_id = "https://api.telegram.org/file/bot".API_KEY."/".bot("getfile",["file_id"=>$message->photo[0]->file_id])->result->file_path;
	file_put_contents("hmo/$base64.png",file_get_contents($file_id));
	}elseif($message->video){
	$base64 = base64_encode(rand(5,555))."mp4";
	$file_id = "https://api.telegram.org/file/bot".API_KEY."/".bot("getfile",["file_id"=>$message->video->file_id])->result->file_path;
	file_put_contents("hmo/$base64.mp4",file_get_contents($file_id));
	}elseif($message->sticker){
	$base64 = base64_encode(rand(5,555))."jpg";
	$file_id = "https://api.telegram.org/file/bot".API_KEY."/".bot("getfile",["file_id"=>$message->sticker->file_id])->result->file_path;
	file_put_contents("hmo/$base64.jpg",file_get_contents($file_id));
	}elseif($message->voice){
	$base64 = base64_encode(rand(5,555))."ogg";
	$file_id = "https://api.telegram.org/file/bot".API_KEY."/".bot("getfile",["file_id"=>$message->voice->file_id])->result->file_path;
	file_put_contents("hmo/$base64.ogg",file_get_contents($file_id));
	}elseif($message->audio){
	$base64 = base64_encode(rand(5,555))."mp3";
	$file_id = "https://api.telegram.org/file/bot".API_KEY."/".bot("getfile",["file_id"=>$message->audio->file_id])->result->file_path;
	file_put_contents("hmo/$base64.mp3",file_get_contents($file_id));
	}
	bot("sendmessage",[
	'chat_id'=>$chat_id,
	'text'=>"• الرابط خاص بك في البوت :
https://t.me/$userr?start=h$base64
",
	'reply_to_message_id'=>$message->message_id,
	"parse_mode"=>"markdown"
	]);
}
$start = str_replace("/start h","",$text);
	if(hmo($start,"png")){
		$send = "photo";
		$z = "$start.png";
		}elseif(hmo($start,"mp4")){
		$send = "video";
		$z = "$start.mp4";
		}elseif(hmo($start,"ogg")){
		$send = "voice";
		$z = "$start.ogg";
		}elseif(hmo($start,"mp3")){
		$send = "audio";
		$z = "$start.mp3";
		}elseif(hmo($start,"jpg")){
		$send = "sticker";
		$z = "$start.jpg";
		}
	if($text == "/start h$start") {
	bot("Send".$send,[
	"chat_id"=>$chat_id,
	"$send"=>new CURLFile("hmo/$z")
]);
}
if($text == "/start"){
	bot("sendmessage",[
	'chat_id'=>$chat_id,
	'text'=>"• اهلا عزيزي في بوت رفع ملفات 

ارسل صوره او فيديو لخ .
",
	'reply_to_message_id'=>$message->message_id,
	"parse_mode"=>"markdown"
	]);
	}
