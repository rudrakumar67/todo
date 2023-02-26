<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    public function userDetails(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
