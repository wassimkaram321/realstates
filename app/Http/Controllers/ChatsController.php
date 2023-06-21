<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Validator;



class ChatsController extends Controller
{
    // app/Http/Controllers/ChatsController.php
public function __construct()
{
  $this->middleware('auth');
}

/**
 * Show chats
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
  return view('chat');
}

/**
 * Fetch all messages
 *
 * @return Message
 */
public function fetchMessages()
{
  return Message::with('user')->get();
}

/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
public function sendMessage(Request $request)
{
        // $user = Auth::user();
    // dd($user->messages());
    // $message = $user->messages()->create([
    //   'message' => $request->input('message')
    // ]);
    // broadcast(new MessageSent($user, $message))->toOthers();
    // return ['status' => 'Message Sent!'];

    $validator = Validator::make($request->all(), [
      // 'receiver_id' => 'required|exists:users,id',
      'message' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 400);
    }

    $message = new Message();
    $message->user_id = Auth::id();
    // $message->receiver_id = $request->input('receiver_id');
    $message->message = $request->input('message');
    $message->save();

    // Broadcast the message to the Pusher channel
    event(new \App\Events\MessageSent(Auth::user(), $message));

    return response()->json(['message' => 'Message sent successfully']);
  }
}
