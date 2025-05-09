<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Dtrans extends Model
{
    protected $table = 'dtrans';
    protected $fillable = ['htrans_id', 'menu_id', 'qty', 'price'];

    // Model Dtrans
}