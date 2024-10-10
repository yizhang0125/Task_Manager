<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $fillable = ['title', 'description', 'due_date', 'isCompleted'];

    protected $date = ['due_date'];
}
