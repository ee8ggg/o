 <?php
ob_start();
$API_KEY = "TO";// توكن 
$admin = 0000;// ايديك
$sudo = array("0000","00000","","","");// ايديك
define('API_KEY',$API_KEY);

if(!is_file(webhook.txt)){
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']); 
file_put_contents("webhook.txt","yes");
}
function bot($method,$datas=[]){
$Alsh = http_build_query($datas);
$url = "https://api.telegram.org/bot".API_KEY."/".$method."?$Alsh";
$Alsh = file_get_contents($url);
return json_decode($Alsh);}
//»»»»»»»»»»»»»»»»»»
 
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$id = $message->from->id;

//if($id == $admin){
if(in_array($id, $sudo)){
if(preg_match('/انشاء مجلد .*/',$text)){
	 	$text = str_replace('انشاء مجلد ','',$text);

	 	mkdir($text);

bot('sendMessage',[
	           'chat_id'=>$chat_id,
	           'text'=>'تم انشاء مجلد جديد بأسم ؛ '.$text
	        ]);
	}
if(preg_match('/حذف مجلد .*/',$text)){
	 	$text = str_replace('حذف مجلد ','',$text);
$sc = scandir($text);
		for($i=0;$i<count($sc);$i++){
			if(is_file($sc[$i])){
				unlink("$text/".$sc[$i]);
			}
		}
	 	rmdir($text);
bot('sendMessage',[
	           'chat_id'=>$chat_id,
	           'text'=>'تم حذف المجلد  ؛ '.$text
	        ]);
	}
if(preg_match('/جلب ملف .*/',$text)){
	 	$text = str_replace('جلب ملف ','',$text);
	 	bot('sendDocumet',[
	 		'chat_id'=>$admin,
	 		'document'=>new CURLFile(trim($text))
	 	]);
	}
	
if($message->reply_to_message->document and preg_match('/رفع الملف .*/',$text)){
$text = str_replace('رفع الملف ','',$text);
	 	mkdir($text);
	    $file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->reply_to_message->document->file_id])->result->file_path;
	    
	    file_put_contents("$text/".$message->reply_to_message->document->file_name,file_get_contents($file));
	    bot('sendMessage',[
	           'chat_id'=>$chat_id,
	           'text'=>'تم رفع الملف ؛ '.$message->reply_to_message->document->file_name.'
https://alivrx.tk/'.$text.'/'.$message->reply_to_message->document->file_name
	        ]);
	}
	
if($text == 'جلب الكل'){
		$sc = scandir(__DIR__);
		for($i=0;$i<count($sc);$i++){
			if(is_file($sc[$i])){
				bot('sendDocument',[
					'chat_id'=>$admin,
					'document'=>new CURLFile($sc[$i])
				]);
			}
		}
	}
}

if($message->reply_to_message->document and preg_match('/فك ضغط .*/',$text)){
$textt = str_replace('فك ضغط ','',$text);
$nz = str_replace('.zip','',$textt);
   #mkdir($text);
   
     $file = "https://api.telegram.org/file/bot".API_KEY."/".bot('getfile',['file_id'=>$message->reply_to_message->document->file_id])->result->file_path;
     
     file_put_contents("$textt.zip",file_get_contents($file));

$zip = new ZipArchive; 
if ($zip->open($textt.'.zip') === TRUE) { 
$txt = "تم فك المجلد بنجاح\n"; 
    $zip->extractTo($textt); 
    $zip->close(); 
}else{ 
$txt ="حدث خطأ"; 
} 
     
  
bot('sendMessage',[
           'chat_id'=>$chat_id,
            'text'=>"$txt \nفي مجلد $textt
المسار
".$_SERVER['SERVER_NAME']."/$textt",
         ]);
         
unlink("$textt.zip");
}


if($text == "اصدار الاستضافه" or $text == "الاصدار"){
  $ver = phpversion();  
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"
• ᴘʜᴘ ᴠᴇʀ : <code>$ver</code>
",
 'parse_mode'=>"HTML",'reply_to_message_id'=>$message_id,
  ]); 
  }

$admin = $admin;
$kingZip14 = "00000"; // دومينك
function kingZip($kingZip1, $kingZip2){
$kingZip4 = realpath($kingZip1);
$kingZip = new ZipArchive();
$kingZip->open($kingZip2, ZipArchive::CREATE | ZipArchive::OVERWRITE);
$kingZip3 = new RecursiveIteratorIterator(
new RecursiveDirectoryIterator($kingZip4),
RecursiveIteratorIterator::LEAVES_ONLY);
foreach($kingZip3 as $kingZip5 => $kingZip6){
if(!$kingZip6->isDir()){
$kingZip7 = $kingZip6->getRealPath();
$kingZip8 = substr($kingZip7, strlen($kingZip4) + 1);
$kingZip->addFile($kingZip7, $kingZip8);
}}
$kingZip->close();
}
function kingZip1($kingZip9, $kingZip10 = 2){
$kingZip11=array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
$kingZip12=floor((strlen($kingZip9) - 1) / 3);
return sprintf("%.{$kingZip10}f", $kingZip9 / pow(1024, $kingZip12)) . @$kingZip11[$kingZip12];
}
$kingZip15 = json_decode(file_get_contents('php://input'));
$kingZip16 = $kingZip15->message;
$kingZip17 = $kingZip16->text;
$kingZip18 = $kingZip16->message_id;
if($kingZip17 == "0000" and $from_id = $admin){
$Rking = "$admin";
date_default_timezone_set("Asia/Damascus");
$kingZip13 = date("{h-i-s}");
kingZip('', "Backup-$kingZip13.zip");
bot('senddocument',[
'chat_id'=>$Rking,
'document'=>"https://$kingZip14/Backup-$kingZip13.zip",
'caption'=>"Backup. 📦
Today's date : ".date('Y/m/d')." 📆
The Time is : ".date('h:i A')." ⏰
File size : ".kingZip1(filesize("Backup-$kingZip13.zip"))." 🏷",
'reply_to_message_id'=>$kingZip18,
]);
unlink("Backup-$kingZip13.zip");
}
?>
