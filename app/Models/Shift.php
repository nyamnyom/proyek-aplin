<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Shift extends Model
{
    protected $table = 'shift';
    protected $fillable = [
        'shift_id',
        'user_id',
        'hari_masuk',
        'jam_masuk',
        'jam_pulang',
    ];
}