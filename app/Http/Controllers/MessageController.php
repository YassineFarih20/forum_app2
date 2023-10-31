<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function SendMessge(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'name' => 'required',
            'text' => 'required',
        ]);

        if (isset($request)) {

            $msg = new Message();
            $msg->title = strip_tags($request->title);
            $msg->name = strip_tags($request->name);
            $msg->email = strip_tags($request->email);
            $msg->text = strip_tags($request->text);
            $msg->status = false;

            $msg->save();

            return redirect()->back();
        }
    }
}
