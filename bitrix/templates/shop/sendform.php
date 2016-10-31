<?
session_start();
$admin = 'info@eltreco.ru'; // На какой адрес отправлять письма

if ( isset( $_POST['sendMail'] ) ) {  // название кнопки отправки формы --- name="sendMail"
   $nname  = htmlspecialchars(substr( $_POST['nname'], 0, 250 ));
   //$email   = htmlspecialchars(substr( $_POST['email'], 0, 250 ));
   $phone = htmlspecialchars(substr( $_POST['phone'], 0, 64 ));
   $message = htmlspecialchars(substr( $_POST['message'], 0, 250 ));
   $res = htmlspecialchars(substr( $_POST['res'], 0, 250 ));
   
   $error = '';
   if ( empty( $nname ) ) $error = $error.'<li><i class="icon-remove"></i>Вы не представились</li>';
   if ( empty( $phone ) ) $error = $error.'<li><i class="icon-remove"></i>Вы не указали телефон для связи</li>';
   if ( empty( $res ) OR ($_POST['res'] != $_SESSION['res'])) $error = $error.'<li><i class="icon-remove"></i>Неправильный ответ на вопрос</li>';
   //if ( empty( $email ) ) $error = $error.'<li><i class="icon-remove"></i>Укажите электронную почту</li>';
   //if ( !empty( $email ) and !preg_match( "#^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,6}$#i", $email ) )
   	 //$error = $error.'<li><i>Поле "Электронная почта" должно соответствовать формату name@site.ru</i></li>';
   if ( !empty( $error ) ) {
     $_SESSION['sendMailForm']['error'] = '<div class="warning"><ul>'.$error.'</ul></div>';
     $_SESSION['sendMailForm']['nname'] = $nname;
    // $_SESSION['sendMailForm']['email'] = $email;
	$_SESSION['sendMailForm']['phone'] = $phone;
     $_SESSION['sendMailForm']['message'] = $message;
     header( 'Location: sendform.php');
     die();
   }

   if ( !empty( $_FILES['resume_file']['tmp_name'] ) and $_FILES['resume_file']['error'] == 0 ) {
     $files[0]['tmpfile'] = $_FILES['resume_file']['tmp_name'];
     $files[0]['name'] = $_FILES['resume_file']['name'];
   }
   
   $body = "Имя: ".$nname."<br>";
   $body .= " Телефон: ".$phone."<br>";
   //$body .= " Почта: ".$email."<br>";
   $body .= " Комментарий: ".$message."<br><br>";
   
	if (multi_attach_mail($admin, $body,$files, $email)) {
		echo '<div class="done" id="done">Спасибо, форма успешно отправлена.</div>';
		}
	else {
		echo '<p>Ошибка при отправке письма</p>';
		}
	die();
}

function multi_attach_mail($admin,$body, $files, $sendermail){
   // email fields: to, from, subject, and so on
   $from = "info@eltreco.ru  <".$sendermail.">"; 
   $subject = "Ваши пожелания |  info@eltreco.ru "; // название письма
   $message = $body;
   $headers = "From: $from";

	// boundary 
	$semi_rand = md5(time()); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

	// headers for attachment 
	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

	// multipart boundary 
	$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"utf8\"\n" .
	"Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

	// preparing attachments
	for($i=0;$i<count($files);$i++){
		if(is_file($files[$i]['tmpfile'])){
			$message .= "--{$mime_boundary}\n";
			$fp = @fopen($files[$i]['tmpfile'],"rb");
			$data = @fread($fp,filesize($files[$i]['tmpfile']));
			@fclose($fp);
			$data = chunk_split(base64_encode($data));
			$message .= "Content-Type: application/octet-stream; name==?utf8?B?".base64_encode($files[$i]['name'])."?=\n" . 
			"Content-Description: =?utf8?B?".base64_encode($files[$i]['name'])."?=\n" .
			"Content-Disposition: attachment;\n" . " filename==?utf8?B?".base64_encode($files[$i]['name'])."?=; size=".filesize($files[$i]['tmpfile']).";\n" . 
			"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
			}
		}
	$message .= "--{$mime_boundary}--";
	//$returnpath = "-f" . $sendermail;
	$returnpath = $sendermail;
	$ok = @mail($admin, $subject, $message, $headers, $returnpath); 
	return $ok;
   }


if (!function_exists('quoted_printable_encode')) {
function quoted_printable_encode ( $string ) {
	// rule #2, #3 (leaves space and tab characters in tact)
	$string = preg_replace_callback (
	'/[^\x21-\x3C\x3E-\x7E\x09\x20]/',
	'quoted_printable_encode_character',
	$string
	);
	$newline = "=\r\n"; // '=' + CRLF (rule #4)
	// make sure the splitting of lines does not interfere with escaped characters
	// (chunk_split fails here)
	$string = preg_replace ( '/(.{73}[^=]{0,3})/', '$1'.$newline, $string);
	return $string;
	}
}

function quoted_printable_encode_character ( $matches ) {
	$character = $matches[0];
	return sprintf ( '=%02x', ord ( $character ) );
}

if (isset($_SESSION['sendMailForm'])) {
	echo $_SESSION['sendMailForm']['error'];
	$nname = htmlspecialchars($_SESSION['sendMailForm']['nname']);
	$phone = htmlspecialchars($_SESSION['sendMailForm']['phone']);
	unset($_SESSION['sendMailForm']);
	} else {
	$nname = '';
	$phone = '';
}
?>