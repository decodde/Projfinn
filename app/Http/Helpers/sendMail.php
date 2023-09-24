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

    public function welcomeMessageBus($data)
    {
        $mail["title"] = "Welcome to ".env('APP_NAME');
        $mail["salute"] = "Hello ".$data['name'].",";

        $mail["message"] = "Thank you for joining ".env('APP_NAME');
        $mail["message"] .= "<br><br> On behalf of the ".env('APP_NAME')." team powered by Owoafara, I will like to welcome you to the family. ";
        $mail["message"] .= "<br><br> Rouzo is an online lending market place that allows investors to buy units in our portfolios\' that are then used to lend to small businesses.";
        $mail["message"] .= "<br><br>You have been successfully registered, please click the link below to activate your dashboard.";
        $mail['buttonTitle'] = 'Activate dashboard';
        $mail['targetUrl'] = $data['url'];
        $mail["message"] .= "<br><br> Welcome once again.";
        $mail["message"] .= "<br><br> From";
        $mail["message"] .= "<br><br> 'Tale and the Rouzo team";
        $mail["message"] .= "<br><br>Powered by Owoafara.";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }
    
    public function welcomeMessageInt($data)
    {
        $mail["title"] = "Welcome to ".env('APP_NAME');
        $mail["salute"] = "Hello ".$data['name'].",";

        $mail["message"] = "Thank you for joining ".env('APP_NAME');
        $mail["message"] .= "<br><br> On behalf of the ".env('APP_NAME')." team powered by Owoafara, I will like to welcome you to the family. ";
        $mail["message"] .= "<br><br> Rouzo is an online lending market place that allows investors to buy units in our portfolios\' that are then used to lend to small businesses.";
        $mail["message"] .= "<br><br>You have been successfully registered, please click the link below to activate your dashboard.";
        $mail['buttonTitle'] = 'Activate dashboard';
        $mail['targetUrl'] = $data['url'];
        $mail["message"] .= "<br><br> Welcome once again.";
        $mail["message"] .= "<br><br> From";
        $mail["message"] .= "<br><br> 'Tale and the Rouzo team";
        $mail["message"] .= "<br><br>Powered by Owoafara.";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function InviteBusiness($data)
    {
        $mail["title"] = "Business: Invite to ".env('APP_NAME');
        $mail["salute"] = "Hello ".$data['businessName'].",";

        $mail["message"] = $data['name']." invited you to join rouzo ".env('APP_NAME');
        $mail["message"] .= "<br><br>".env('APP_NAME')." is an online lending market place that allows you to buy ";
        $mail["message"] .= "<br><br>units in our portfolios’ that are then used to lend to small businesses.";
        $mail["message"] .= "<br><br>please click the link below to register";
        $mail['buttonTitle'] = 'Register Now';
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
    
        public function sendToAdmin($data, $user)
    {
        $mail["title"] = "Rouzo: A Business Applied for Funding ";
        $mail["salute"] = "Hello Rouzo";
        $mail["message"] = "A business with the name '". $user->business()->name."' just applied for Funding, Please login and view the application";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $user) {
            $m->from($user->email, $user->name);
            $m->to(env('BUSINESS_EMAIL'))->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function sendMailForPayment($data)
    {
        $mail["title"] = "Rouzo: Funding application Update";
        $mail["salute"] = "Hello ".$data["name"];
        $mail["message"] = "Your Funding Application has been Approved . Login into your dashboard to view it'". $data["name"];
        $mail['buttonTitle'] = 'Login to Your dashboard';
        $mail['targetUrl'] = $data['url'];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data["email"])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }


    public function sendMailForDebugging($data)
    {
        $mail["title"] = "Debug From Rouzo ";
        $mail["salute"] = "Hello Rouzo";
        $mail["message"] = "ACCOUNTNAME: ".$data["nubanMatch"]->account_name."ACCOUNTNUMBER: ".$data["nubanMatch"]->account_number."BVN: ".$data["bvnMatch"]->bvn."BVN_firstNAME: ".$data["bvnMatch"]->first_name."BVN_lastNAME: ".$data["bvnMatch"]->last_name;

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from("no-reply@owoafara.com", "Mayorwa");
            $m->to("thisgeekcodes@gmail.com")->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }
    
    public function sendFundingReminder($data){
        $mail["title"] = "Rouzo: Your Repayment is due Today";
        $mail["salute"] = "Hello ".$data["name"];
        $mail["message"] = "Your Fund Repayment for this month is due today, Pay today to avoid negative scoring";
        $mail['buttonTitle'] = 'Login to Your dashboard to make the payment';
        $mail['targetUrl'] = $data['url'];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data["email"])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function sendPreFundReminder($data){
        $mail["title"] = "Rouzo: Your Repayment is going to be due Tomorrow";
        $mail["salute"] = "Hello ".$data["name"];
        $mail["message"] = "Your Fund Repayment for ". $data["date"] . " is going to be due tomorrow, Pay on time to avoid negative scoring";
        $mail['buttonTitle'] = 'Login to Your dashboard to make the payment';
        $mail['targetUrl'] = $data['url'];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data["email"])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }

    public function sendPostFundReminder($data){
        $mail["title"] = "Rouzo: Your Repayment is overdue";
        $mail["salute"] = "Hello ".$data["name"];
        $mail["message"] = "Your Fund Repayment for ". $data["date"] . " is overdue, Pay before the end of today to avoid negative credit scoring";
        $mail['buttonTitle'] = 'Login to Your dashboard to make the payment';
        $mail['targetUrl'] = $data['url'];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data["email"])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }
    
    
    public function sendInvestmentMature($data){
        $mail["title"] = "Rouzo: Your Investment Has Matured";
        $mail["salute"] = "Hello ".$data["name"];
        $mail["message"] = "Your Investment of ". $data["amount"] . " in the ". $data["portfolio"] ." has matured and has been transferred to your Stash";
        $mail['buttonTitle'] = 'Login to Your dashboard to Withdraw it';
        $mail['targetUrl'] = $data['url'];

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data["email"])->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }
    
    public function sendTransferReminder($user)
    {
        $mail["title"] = "Rouzo: An Investor Has Requested for a Transfer";
        $mail["salute"] = "Hello Rouzo";
        $mail["message"] = "An Investor with the name '". $user->investor()->name."' just requested for a transfer, Please login and view the request";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $user) {
            $m->from('no-reply@owoafara.com', env('SENDER_NAME'));
            $m->to(env('SENDER_EMAIL'))->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }
    
    public function sendTransferBReminder($user)
    {
        $mail["title"] = "Rouzo: A Business Has Requested for a Transfer";
        $mail["salute"] = "Hello Rouzo";
        $mail["message"] = "A Business with the name '". $user->name."' just requested for a transfer, Please login and view the request";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $user) {
            $m->from('no-reply@owoafara.com', env('SENDER_NAME'));
            $m->to(env('SENDER_EMAIL'))->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }
    
    public function sendTransferIReminder($user)
    {
        $mail["title"] = "Rouzo: An Introducer Has Requested for a Transfer";
        $mail["salute"] = "Hello Rouzo";
        $mail["message"] = "An Introducer with the name '". $user->name."' just requested for a transfer, Please login and view the request";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $user) {
            $m->from('no-reply@owoafara.com', env('SENDER_NAME'));
            $m->to(env('SENDER_EMAIL'))->subject($mail['title']);
            $m->replyTo('no-reply@owoafara.com');
        });
    }
}
