<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'state',
        'expiration_at',
        'priority',
        'category',
        'user_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'priority' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
