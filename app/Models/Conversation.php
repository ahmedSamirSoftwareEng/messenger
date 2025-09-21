<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'user_id',
    ];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')
        ->withPivot(['role', 'joined_at']);
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id')
            ->latest();
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function lastMessage()
    {
        return $this->belongsTo(Conversation::class, 'last_message_id')
            ->withDefault();
    }
}
