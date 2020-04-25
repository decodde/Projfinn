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
        $mail["message"] .= "<br><br>".env('APP_NAME')." is a finance matching and business support platform,";
        $mail["message"] .= "<br><br>that matches small businesses with financing options and supports them to grow their businesses.";
        $mail["message"] .= "<br><br>by providing practical resources, training, community and support.";
        $mail["message"] .= "<br><br>Your organization has been successfully registered, please click the link below to activate your dashboard.";
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

}
