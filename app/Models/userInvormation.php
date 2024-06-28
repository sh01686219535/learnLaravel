<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userInvormation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'name',
        'phone',
        'email',
        'password',
        'curd_id',
        'image',
        'description'
    ];
}
