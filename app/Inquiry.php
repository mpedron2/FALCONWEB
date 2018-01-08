<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiry';
    protected $fillable = ['level', 'fullname', 'email', 'mobile', 'message'];
}
