<?php

namespace App\Http\Controllers;

use App\Mail\SendWelcomeMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        try {
            $toEmailAddress = "";
            $welcomeEmail = "Hey welcome to YouHeal Hospital";

            $response = Mail::to($toEmailAddress)->send(new SendWelcomeMail($welcomeEmail));

            dd($response);

        } catch (Exception $e) {
            Log::error("Unable to send email". $e->getMessage());
        }
    }
}
