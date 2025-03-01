<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'echeance',
        'statut',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
