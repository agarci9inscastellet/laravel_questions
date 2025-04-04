<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $fillable = [
        'question',
        'answer',
        'user_id',
        'url',
    ];


    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
