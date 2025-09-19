<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontribusiNasabah extends Model
{
    protected $table = 'kontribusi_nasabah';
protected $fillable = ['id_nasabah','total_setoran'];


public function nasabah(){ 
        return $this->belongsTo(User::class,'id_nasabah','id_user'); 
    }
}
