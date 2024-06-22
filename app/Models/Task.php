<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'title', 'description', 'status', 'due_date', 
    ];

    public function userDetails() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
