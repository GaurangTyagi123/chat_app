<?php

namespace App\Http\Controllers;

use App\Models\Chat_Data;
use App\Models\Chats;
use App\Events\ChatMessage;
use Illuminate\Http\Request;

class ChatAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $data = $request->validate([
            'user_id' => 'required',
            'chats_id' => 'required',
            'message' => 'required'
        ]);
        $chat_messages = Chat_Data::where([['user_id',$data['user_id']],['chats_id',$data['chats_id']]])->get();
        $message = json_decode($chat_messages[0]->chat,true);
        $newMessage = [
            'id' => $data['user_id'],
            'created_at' => time(),
            'message' => $data['message']
        ];
        if ($message){
            array_push($message, $newMessage);
            $message = json_encode($message);
        } else {
            $message = $newMessage;
            $message = json_encode([$message]);
        }

        
        $chat_messages[0]->chat = $message;
        $chat_messages[0]->save();
        broadcast(new ChatMessage(['message'=>$newMessage,'id'=>$chat_messages[0]->chats_id]))->toOthers();
        return response()->json($newMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chatRoom = Chats::where('id', $id)->with('chat_data')->get();
        return response()->json($chatRoom->first()->chat_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
