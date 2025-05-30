<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Promo extends Model
{
    protected $table = 'promo';
    protected $fillable = ['promo_id', 'nama_promo', 'kode_promo','deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'is_active'];

    // Model Dtrans
}