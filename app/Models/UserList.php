<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    use HasFactory;
    protected $guarded=['created_at','updated_at'];
    
    protected $fillable = [
        'name',
    ];

    public function Users(){
        return $this->belongsToMany(User::class,'user_to_user_list');
    }

}
