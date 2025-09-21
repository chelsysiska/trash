<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setoran';
    protected $fillable = [
        'nasabah_id',
        'tanggal',
        'jenis_sampah_id',
        'berat',
        'harga_per_kg',
        'total_harga'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
