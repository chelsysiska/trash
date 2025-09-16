<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';
    protected $fillable = ['tanggal', 'keterangan', 'jenis', 'jumlah'];
}
