<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;
    protected $table = "tasks";

    protected $fillable = ['task','content','sDate','eDate','image','user_id'];
}
