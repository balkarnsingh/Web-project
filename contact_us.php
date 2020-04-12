<?php
function clean_string($string) {
 
  $bad = array("content-type","bcc:","to:","cc:","href");

  $string =  str_replace($bad,"",$string);

  if(empty($string))
    return "NOT SET";
  else
    return $string;

}

if(isset($_POST['contact'])){

    if(empty($_POST['name']) and empty($_POST['email']) and empty($_POST['message']) and empty($_POST['city']) and empty($_POST['phone'])){

        echo "<script>alert('All of the fields are required.'); document.getElementById('contact').scrollIntoView()</script>"; 

    }else{

         $email_exp = "/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/";
 
        if(!preg_match($email_exp,$_POST['email'])) {

            echo "<script>alert('Please enter a valid email address.'); document.getElementById('contact').scrollIntoView();</script>"; 

        }else {

            $from_email = 'from@balkarn-project-management.000webhostapp.com/';

            $email_message = "Full Name: ".clean_string($_POST['name'])."\n";
            $email_message .= "Email: ".clean_string($_POST['email'])."\n";
            $email_message .= "phone: ".clean_string($_POST['phone'])."\n";
            $email_message .= "city: ".clean_string($_POST['city'])."\n";
            $email_message .= "Message: ".clean_string($_POST['message'])."\n";


            $headers = 'From: '.$from_email."\r\n".
                        'Reply-To: '.$from_email."\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            

            $to      = 'balkarnsinghdk@gmail.com';
            $subject = 'Contact US';

            mail($to, $subject, $email_message, $headers);

            echo "<script>alert('Thank you for contacting, We will get back to you as soon as possible.')</script>"; 
        }
    }
}
?>