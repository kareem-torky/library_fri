<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'msg' => 'required|string',
        ]);

        Message::create($data);

        return response()->json([
            'success' => 'message sent successfully'
        ]);
    }
}
