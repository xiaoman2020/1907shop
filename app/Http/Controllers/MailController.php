<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendemail()
    {
        Mail::to('2727057431@qq.com')->send(new OrderShipped());
    }
}