<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=['created_at','updated_at'];

    protected $fillable = [
        'content',
        'original_link',
        'user_id',
        'account_id',
        'social_network_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function SocialNetwork()
    {
        return $this->belongsTo(SocialNetwork::class);
    }

}
