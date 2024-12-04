<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    // Lấy danh sách người dùng
    public function getUsers()
    {
        // Kiểm tra xem người dùng có phải là admin hay không
        if (auth()->user()->role == 1) {
            // Admin có thể thấy tất cả người dùng trừ chính mình
            $users = User::where('id', '!=', auth()->id())->get();
        } else {
            // Client chỉ thấy admin
            $users = User::where('role', 1)->get();
        }

        return view('chat.users', compact('users'));
    }


    public function getMessages($receiverId)
    {
        $receiver = User::findOrFail($receiverId);
    
        $messages = Message::where(function ($query) use ($receiverId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($receiverId) {
                $query->where('sender_id', $receiverId)
                      ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'ASC') // Sắp xếp theo thứ tự tăng dần
            ->get();
    
        return view('chat.messages', compact('messages', 'receiver'));
    }
    

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return back();
    }
}
