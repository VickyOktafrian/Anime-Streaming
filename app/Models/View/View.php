<?php

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class View extends Model
{
    use HasFactory;
    protected $table = 'views';
    protected $fillable = ['show_id','user_id'];
}
