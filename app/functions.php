<?php

function debug($data) 
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function load($data)
{

    foreach ($_POST as $k =>$v) {

        if (array_key_exists($k, $data)) {
            $data[$k]['value'] = trim($v);
        }
        
    }

    return $data;
}

function validate($data)
{
    $errors = '';

    foreach ($data as $k => $v) {

        if ($data[$k]['required'] && empty($data[$k] ['value'])) {
            $errors .="<li>Вы не заполнили поле {$data[$k]['field_name']}</li>";
        }

    }

    if (! check_captcha($data['captcha']['value'])) {
        $errors .="<li>Неверно заполнено поле Captcha</li>";
    }

    return $errors;
}
function set_captcha()
{
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha'] = $num1 + $num2;

    return "Сколько будет {$num1} + {$num2}?";
}

function check_captcha($res)
{

    return $_SESSION['captcha'] == $res;
}

function send_mail($fields, $mail_settings)
{
    $mail = new \PHPMailer\PHPMailer\PHPMailer();

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = $mail_settings['host'];
        $mail->SMTPAuth   = $mail_settings['smtp_auth'];
        $mail->Username   = $mail_settings['username'];
        $mail->Password   = $mail_settings['password'];
        $mail->SMTPSecure = $mail_settings['smtp_secure'];
        $mail->Port       = $mail_settings['port'];

        $mail->setFrom($mail_settings['from_email'], $mail_settings['from_name']);
        $mail->addAddress($mail_settings['to_email']);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Форма с сайта';
        $flag = true;
        $message = '';

        foreach ($fields as $k => $v) {

            if (isset($v['mailable']) && $v['mailable'] == 0) {

                continue;
            }

            $message .= ( ($flag = !$flag) ? '<tr>' : '<tr style="background-color: #f8f8f8;">') .
                "<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>{$v['field_name']}</b></td>
                    <td style='padding: 10px; border: #e9e9e9 1px solid;'>{$v['value']}</td></tr>";
        }

        $mail->Body = "<table style='width: 100%;'>$message</table>";

        if (! $mail->send()) {

            return false;
        }

        return true;

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        return false;
    }

}
?>