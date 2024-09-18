<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru_ps extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_guru_ps'; 

    protected $fillable = [
        'nama',
        'rayon_id',
        'id_user'
    ];

    public function rayon() {
        $this->belongsTo(rayon::class, 'rayon_id', 'id');
    }

    public function user() {
        $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
