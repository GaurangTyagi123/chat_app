<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat_Data extends Model
{
    protected $fillable = ['chat','user_id','chats_id'];
    public function chat(){
        return $this->belongsTo(Chats::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
