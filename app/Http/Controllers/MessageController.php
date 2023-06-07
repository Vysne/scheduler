<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($userId)
    {
        return view('messages-page', ['messages' => $this->extendedMessages($userId), 'receiver' => $userId]);
    }

    public function extendedMessages($senderId)
    {
        $userId = Auth::id();

        $messages = DB::table('messages')
            ->join('user_information', 'messages.sender_id', '=', 'user_information.user_id')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->select('user_information.user-image', 'users.name', 'messages.message', 'messages.sender_id', 'messages.created_at')
            ->whereIn('receiver_id', [$userId, $senderId])
            ->get()
            ->toArray();

        return json_decode(json_encode($messages), true);
    }

    public function showMessages()
    {
        $userId = Auth::id();

        $messages = DB::table('messages')
            ->join('user_information', 'messages.sender_id', '=', 'user_information.user_id')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->select('user_information.user-image', 'users.name', 'messages.message', 'messages.sender_id', 'messages.created_at')
            ->where('receiver_id', $userId)
            ->get()
            ->toArray();

        $messagesArray = json_decode(json_encode($messages), true);
        $senderIds = array_column($messagesArray, 'sender_id');
        $uniqueSenderIds = array_unique($senderIds);

        $uniqueResult = [];
        foreach ($uniqueSenderIds as $senderId) {
            foreach ($messagesArray as $item) {
                if ($item['sender_id'] === $senderId) {
                    $uniqueResult[] = $item;
                    break;
                }
            }
        }

        return $uniqueResult;
//        return json_decode(json_encode($messages), true);
    }

    public function sendMessage(Request $request)
    {
        DB::table('messages')
            ->insert([
                'sender_id' => request('sender_id'),
                'receiver_id' => request('receiver_id'),
                'message' => request('message')
            ]);

        return redirect('/messages/' . request('receiver_id'));
    }
}
