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
        $mail["message"] .= "<br><br>Projfinn is a finance matching and business support platform,";
        $mail["message"] .= "<br><br>that matches and medium businesses with financing options and supports them to grow their businesses.";
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

        $mail["message"] = "Someone, hopefully you, requested a change to your ".env('APP_NAME')." account.";
        $mail["message"] .= "<br><br>If you didn't make this request, grab a coffee and relax.";
        $mail["buttonTitle"] = "Recover Password";
        $mail["targetUrl"] = $data["url"];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function approvedBusiness($data) {
        $mail["title"] = "Business Profile Approval on ".env('APP_NAME');
        $mail["salute"] = "Dear ".$data['name'].",";
        
        $mail["message"] = "This is to notify you that your profile on ".env('APP_NAME').",";
        $mail["message"] .= "<br>has been successfully approved by our due diligence team after passing through several stages of verification.";
        $mail["message"] .= "<br><br>Following this action, your profile will now be listed for matching with potential lenders on our platform.";
        $mail["message"] .= "<br><br>We shall send communication mails on how well your profile is doing.";
        $mail["message"] .= "<br><br><br>Owoafara is a finance matching and business support platform,";
        $mail["message"] .= "<br><br>that matches small businesses with financing options and supports them to grow their businesses.";
        $mail["message"] .= "<br><br>by providing practical resources, training, community and support.";
        $mail["message"] .= "<br><br>Your organization has been successfully registered, please click the link below to activate your dashboard.";
        $mail['buttonTitle'] = 'Login to dashboard';
        $mail['targetUrl'] = \URL('/');
        
        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function sendMatchMail($data) {
        $mail["title"] = "New Potential Matches on ".env('APP_NAME');
        $mail["salute"] = "Dear ".$data['name'].",";
        
        $mail["message"] = "You have ".$data['matches']." potential business to fund on ".env('APP_NAME').",";
        $mail["message"] .= "<br>Kindly login to your dashboard to match with these businesses and fund their ventures.";
        $mail["message"] .= "<br><br><br>";
        $mail["message"] .= "<br><br>Projfinn is a finance matching and business support platform,";
        $mail["message"] .= "<br><br>that matches small businesses with financing options and supports them to grow their businesses.";
        $mail["message"] .= "<br><br>by providing practical resources, training, community and support.";
        $mail["message"] .= "<br><br>Your organization has been successfully registered, please click the link below to activate your dashboard.";
        $mail['buttonTitle'] = 'Match Businesses';
        $mail['targetUrl'] = \URL('/login');
        
        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function profileCompletionMail($data) {
        $mail['title'] = 'Profile Completion Reminder';
        $mail['salute'] = 'Hello '.$data['name'].',';

        $mail['message'] = 'This is to notify you that your business profile is yet to be completed on '.env('APP_NAME').',';
        $mail['message'] .= '<br>Kindly login to your dashboard to complete your profile.';
        $mail['message'] .= '<br>By doing this it would allow your profile to be eligible for matching with lenders.';
        $mail["message"] .= "<br><br>Owoafara is a finance matching and business support platform,";
        $mail["message"] .= "<br><br>that matches small businesses with financing options and supports them to grow their businesses.";
        $mail["message"] .= "<br><br>by providing practical resources, training, community and support.";

        $mail['buttonTitle'] = 'Complete Profile';
        $mail['targetUrl'] = \URL('/login');
        
        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public static function notifyAdminBusinessProfileCompleted($business) {
        $mail["title"] = "Business Profile Completion on ".env('APP_NAME');
        $mail["salute"] = "Hello Administrator";
        
        $mail["message"] = "The business with the name <h3>".$business->name."</h3> has just completed their profile on ".env('APP_NAME').",";
        $mail["message"] .= "<br>Kindly login to the administrator's dashboard to confirm and approve their profile for matching.";
        $mail["message"] .= "<br><br>You will only get this mail once.";
        $mail['buttonTitle'] = "Administrator Login";
        $mail['targetUrl'] = \URL('/office');

        $recipients = explode(' | ', env('ADMIN_EMAILS'));
        
        Mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $recipients) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($recipients)->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function matchBusinessNotification($business, $lender) {
        $mail["title"] = "Congratulations, You Got A New Match! ".env('APP_NAME');
        $mail["salute"] = "Hello ".$business->name;
        
        $mail["message"] = "You are matched with a lender <h3>".$lender."</h3> on ".env('APP_NAME').",";
        $mail["message"] .= "<br>Kindly login to the dashboard to view your matches.";
        $mail['buttonTitle'] = "Dashboard Login";
        $mail['targetUrl'] = \URL('/login');

        Mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $business) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($business->email)->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function notifyBusinessLenderPays($business, $lender) {
        $mail["title"] = "Lender Fund Release ".env('APP_NAME');
        $mail["salute"] = "Hello ".$business->name;
        
        $mail["message"] = "Your matched lender <h3>".$lender->name."</h3> on ".env('APP_NAME').",";
        $mail["message"] .= "<br>Confirms the release of funds into your account.";
        $mail["message"] .= "<br>Kindly login to your dashboard to confirm this.";
        $mail['buttonTitle'] = "Dashboard Login";
        $mail['targetUrl'] = \URL('/login');

        Mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $business) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($business->email)->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function sendInvoiceLender($lender, $business, $match) {
        $mail['title'] = 'OWOAFARA MATCH INVOICE';
        $mail['salute'] = 'Hello '.$lender->name;
        $mail['message'] = 'Below is a breakdown invoice of your match and loan <br> disbursement to <h3>'.$business->name.'</h3> on '.env('APP_NAME');
        $mail['message'] .= '<br> Kindly attend to this invoice by paying the commissioned amount indicated.';
        
        $adminMails = explode(' | ', env('ADMIN_EMAILS'));
        Mail::send('emails.invoice', ['data' => (object) $mail, 'match' => $match, 'business' => $business, 'lender' => $lender], function($m) use ($mail, $lender, $adminMails) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($lender->email, $lender->name)->subject($mail['title']);
            $m->bcc($adminMails);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

}
