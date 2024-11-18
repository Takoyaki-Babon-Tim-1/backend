<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendWelcomeEmail()
    {
        $title = 'Welcome to Takoyaki Babon Family!';
        $body = 'Thank you for participating!';

        Mail::to('sahalntesting@gmail.com')->send(new WelcomeMail($title, $body));

        return "Email sent successfully!";
    }
}