<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Transaksi extends Model
{
protected $table = 'transaksi';
protected $primaryKey = 'id_transaksi';
protected $fillable = ['id_user','id_petugas','tanggal','total_berat','total_nilai','status'];


public function items(){ return $this->hasMany(TransaksiItem::class,'id_transaksi','id_transaksi'); }
public function user(){ return $this->belongsTo(User::class,'id_user','id_user'); }
}
