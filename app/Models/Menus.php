<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Menus extends Model
{
    protected $table = 'menus';
    protected $fillable = ['menu_id', 'nama_menu', 'deskripsi', 'harga','category', 'is_active'];

    // Model Dtrans
}