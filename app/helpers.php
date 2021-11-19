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

        $mail->setFrom('incidentlog00@gmail.com', 'Incident Log');
        $mail->addAddress($data['email']);
        //$mail->addCC($_POST['email-cc']);
        //$mail->addBCC($_POST['email-bcc']);
        //$mail->addReplyTo('incidentlog00@gmail.com', 'Pseudo');

        // for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
        //     $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]); // Optional name
        // }

        $mail->isHTML(true);

        $mail->Subject = $data['subject'];
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

function getSmarthealthCats($cat=false)
{
    $cats = ['general'=>'General', 'accounts'=>'Accounts & Profile', 
    'med_s'=>'Medical Services', 'payments'=>'Payments & Billing', 
    'med_r'=>'Medical Records', 'appointments'=>'Appointments'];

    if($cat && array_key_exists($cat, $cats)){
        return $cats[$cat];
    } else {
        return $cats;
    }
}

function getEmailTemplate($rest_of_content)
{
    $preheader = '<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>';
    $template = '<!doctype html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Support Portal</title>
        <style>
        @media only screen and (max-width: 620px) {
        table[class=body] h1 {
            font-size: 28px !important;
            margin-bottom: 10px !important;
        }
        table[class=body] p,
                table[class=body] ul,
                table[class=body] ol,
                table[class=body] td,
                table[class=body] span,
                table[class=body] a {
            font-size: 16px !important;
        }
        table[class=body] .wrapper,
                table[class=body] .article {
            padding: 10px !important;
        }
        table[class=body] .content {
            padding: 0 !important;
        }
        table[class=body] .container {
            padding: 0 !important;
            width: 100% !important;
        }
        table[class=body] .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important;
        }
        table[class=body] .btn table {
            width: 100% !important;
        }
        table[class=body] .btn a {
            width: 100% !important;
        }
        table[class=body] .img-responsive {
            height: auto !important;
            max-width: 100% !important;
            width: auto !important;
        }
        }

        @media all {
        .ExternalClass {
            width: 100%;
        }
        .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
            line-height: 100%;
        }
        .apple-link a {
            color: inherit !important;
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            text-decoration: none !important;
        }
        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }
        .btn-primary table td:hover {
            background-color: #34495e !important;
        }
        .btn-primary a:hover {
            background-color: #34495e !important;
            border-color: #34495e !important;
        }
        }
        </style>
    </head>
    <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
            <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
            <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                <tr>
                    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                        '.$rest_of_content.'
                        </tr>
                    </table>
                    </td>
                </tr>

                </table>

                <!-- START FOOTER -->
                <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                    <tr>
                    <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                        <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Powered by <a href="https://eclathealthcare.com/" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">e`Clat</a>, an Interswitch Healthtech Company</span>
                    </td>
                    </tr>
                </table>
                </div>
                <!-- END FOOTER -->
            </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        </tr>
        </table>
    </body>
    </html>';
    return $template;
}

?>