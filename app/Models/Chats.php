<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $fillable = ['chat_name','sender_id','reciever_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function chat_data(){
        return $this->hasMany(Chat_Data::class);
    }
    public static function boot(){
        parent::boot();
        static::created(function ($chat) {
            $chat->chat_data()->create([
                'chat' => '',
                'user_id' => $chat->user_id
            ]);
            $chat->chat_data()->create([
                'chat' => '',
                'user_id' => $chat->reciever_id
            ]);
        });
    }
}
