<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setoran';
    protected $fillable = ['nasabah_id', 'berat', 'harga', 'total', 'tanggal_setor'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
