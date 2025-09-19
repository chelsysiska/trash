<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $table = 'transaksi_item';
protected $primaryKey = 'id_item';
protected $fillable = ['id_transaksi','id_jenis','berat_kg','harga_per_kg','subtotal'];


public function jenis(){ return $this->belongsTo(JenisSampah::class,'id_jenis','id_jenis'); }
}
