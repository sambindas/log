<?php

use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function currentUser() {
	if (\Illuminate\Support\Facades\Session::has('authUser')) {
		return (object)session()->get('authUser');
	}
	return false;
}

function sanitizeInput($posts_data, $exempted=[], $default_filter=FILTER_SANITIZE_STRING)
{
    if (!is_array($posts_data)) {
        $posts_data = [$posts_data];
    }
    $args = array();
    foreach ($posts_data as $prk=>$prv) {
        if (!in_array($prk, array_keys($args))) {
            if (is_array($prv)) {
                $args[$prk] = array(
                    'filter' => $default_filter,
                    'flags' => FILTER_REQUIRE_ARRAY,
                );
            } else {
                if (is_array($exempted) && in_array($prk, $exempted)) {
                    $args[$prk] = '';
                } else {
                    $args[$prk] = FILTER_SANITIZE_STRING;
                }
            }
        }
    }
    return filter_var_array($posts_data, $args);
}

function sendEmail ($data) {

    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'incidentlog00@gmail.com';
        $mail->Password = 'wallace@femi';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('incidentlog00@gmail.com', 'Test');
        $mail->addAddress($data['email']);
        //$mail->addCC($_POST['email-cc']);
        //$mail->addBCC($_POST['email-bcc']);
        $mail->addReplyTo('incidentlog00@gmail.com', 'Pseudo');

        // for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
        //     $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]); // Optional name
        // }

        $mail->isHTML(true);

        $mail->Subject = 'New Incident Submitted';
        $mail->Body    = $data['message'];
        // $mail->AltBody = plain text version of your message;

        if( !$mail->send() ) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return true;
        }

    } catch (Exception $e) {
        // return back()->with('error','Message could not be sent.');
    }
}

function generateToken($prefix='', $length=10)
{
    $bytes = random_bytes($length);
    return $prefix.bin2hex($bytes);
}

function getIncidentStageInfo($stage='')
{
    $stages = array(
        '#f6f6ad,Open', '#3f49b42,Done', '#3f49b42,Closed', '#42ebf4,Requires Approval', '#9C4646,Not Applicable' 
    );

    if ($stage!='' || $stage==0) {
        return $stages[$stage];
    }

    return $stages;
}

?>