<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMutasi extends Model
{
    protected $table = 'kas_mutasi';
protected $primaryKey = 'id_mutasi';
protected $fillable = ['id_transaksi','nominal','tipe','keterangan','tanggal'];
}
