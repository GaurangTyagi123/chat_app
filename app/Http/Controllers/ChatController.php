<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chats;
use App\Models\User;
class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all(['name','id']);
        return view('home')->with(['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'reciever_id' => 'required',
            'chat_name' => 'required',
            'sender_id' => 'required'
        ]);
        $user = User::find($data['sender_id']);
        $chatExists = Chats::where('user_id', $user->id);
        if ($chatExists)
            return response()->json(['message' => 'chat already exists', 'status' => false, 'content' => []]);
        else {
            $chatRoom = $user->chats()->create([
                'user_id' => $data['sender_id'],
                'reciever_id' => $data['reciever_id'],
                'chat_name' => $data['chat_name'],
            ]);
            return response()->json(['message' => 'chat created sucessfully', 'status' => true, 'content' => $chatRoom->with('chat_data')->get()])->setStatusCode(200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $chat = Chats::where('reciever_id',$id)->orWhere('user_id',$id)->with('chat_data')->get()->first();
        $users = User::all(['name','id']);
        if($chat){
            return view('home')->with(compact('chat','users'));
        }
        else{
            $user_id = auth()->user()->id;
            $reciever = User::find($id);
            $chat = auth()->user()->chats()->create([
                'user_id' => $user_id,
                'reciever_id' => $id,
                'chat_name' => "$reciever->name's chat"
            ])->with('chat_data')->get()->where('reciever_id',$id)->first();
            return view('home')->with(compact('users', 'chat'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
