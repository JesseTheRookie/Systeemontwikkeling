<?php 
class Contact{

    public function __construct() {
        return $this->mysqli=new mysqli($this->host, $this->user, $this->pass, $this->db);
    }
    
    public function contact_us($data){
        $fname=$data['name'];
        $lname=$data['surname'];
        $email=$data['email'];
        $phone=$data['phone'];
        $message=$data['message'];
        $q="insert into contact_us set first_name='$firstname', last_name='$lastname', email='$email', phone='$phone', message='$message'";
       $data= $this->mysqli->query($q);
       if($data==true){
           $body="One message received from Haarlem Festival contact us. details are below..<br> first_name='$firstname', last_name='$lastname', email='$email', phone='$phone', message='$message'";
           return $this->sent_mail("a.k.cagdas@live.nl", "Message received from Haarlem Festival", $body);
       }
    }
      public function sent_mail($to,$subject,$body){
$mailFromName="Haarlem Filmfestival";
$mailFrom="a.k.cagdas@live.nl";
/////////////////////////////////////////////////////////////
//Mail Header
$mailHeader = 'MIME-Version: 1.0'."\r\n";
$mailHeader .= "From: $mailFromName <$mailFrom>\r\n";
$mailHeader .= "Reply-To: $mailFrom\r\n";
$mailHeader .= "Return-Path: $mailFrom\r\n";
//$mailHeader .= "CC: $mailCC\r\n";
//$mailHeader .= "BCC: $mailBCC\r\n";
$mailHeader .= 'X-Mailer: PHP'.phpversion()."\r\n";
$mailHeader .= 'Content-Type: text/html; charset=utf-8'."\r\n";
/////////////////////////////////////////////////////////////
//Email to Admin
if(mail($to, $subject, $body, $mailHeader)){
 return true;
 }else{
return false;
 }
    }
}


?>