<?php
$fields = [
    'name' => [
        'field_name' => 'Имя',
        'required' => 1,
],

    'email' => [
        'field_name' => 'Адрес электронной почты',
        'required' => 1,
],

    'address' => [
        'field_name' => 'Адрес',
        'required' => 0,
],

    'phone' => [
        'field_name' => 'Телефон',
        'required' => 1,
],

    'comment' => [
        'field_name' => 'Комментарий',
        'required' => 0,
],

    'agree' => [
        'field_name' => 'Согласие с обработкой персональных данных',
        'required' => 1,
        'mailable' => 0,
],

    'captcha' => [
        'field_name' => 'Captcha',
        'required' => 1,
        'mailable' => 0,
],
];
$mail_settings = [
    'host' => 'smtp.mailtrap.io',
    'smtp_auth' => true,
    'username' => 'bc981753f0d294',
    'password' => '9da63423c44c7d',
    'smtp_secure' => null,
    'port' => 2525,
    'from_email' => 'eae56b1496-7ad1f9@inbox.mailtrap.io',
    'from_name' => 'My Site',
    'to_email' => 'user@mail.com',
];
