<?php 

namespace App\Http\Helpers;
use Mail;

class sendMail {
    
    // private $mail;
    
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    public function welcomeMessage($data)
    {
        $mail["title"] = "Welcome to ".env('APP_NAME');
        $mail["salute"] = "Hello ".$data['name'].",";

        $mail["message"] = "Thank you for joining ".env('APP_NAME');
        $mail["message"] .= "<br><br>".env('APP_NAME')." is an online lending market place that allows you to buy ";
        $mail["message"] .= "<br><br>units in our portfolios’ that are then used to lend to small businesses.";
        $mail["message"] .= "<br><br>You have been successfully registered, please click the link below to activate your dashboard.";
        $mail['buttonTitle'] = 'Activate dashboard';
        $mail['targetUrl'] = $data['url'];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function sendPasswordRecoveryMail($data)
    {
        $mail["title"] = "Password Recovery";
        $mail["salute"] = "Hello ".$data["name"];

        $mail["message"] = "Someone, hopefully you, requested a change to your password on your ".env('APP_NAME')." account.";
        $mail["message"] .= "<br><br>If you didn't make this request, grab a coffee and relax.";
        $mail["buttonTitle"] = "Recover Password";
        $mail["targetUrl"] = $data["url"];

//        dd("Hey");
        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function Contact($data)
    {
        $mail["title"] = "Rouzo: Message From ".$data["name"];
        $mail["salute"] = "Hello Rouzo";
        $mail["message"] = $data["message"];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from($data["email"], $data["name"]);
            $m->to(env('SENDER_EMAIL'))->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

}
