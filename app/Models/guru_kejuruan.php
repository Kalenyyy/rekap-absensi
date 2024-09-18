<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru_kejuruan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama',
        'id_user'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id_guru');
    }
}
