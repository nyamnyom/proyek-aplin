<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Htrans extends Model
{
    protected $table = 'htrans';
    protected $fillable = ['total', 'payment_method', 'kasir_id'];

    // Model Htrans
}
