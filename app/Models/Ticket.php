<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "subject",
        "description",
        "category",
        "priority",
        "attachment",
        "status"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function chatMessages() {
        return $this->hasMany(ChatMessage::class);
    }
}
