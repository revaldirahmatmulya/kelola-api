<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranIuran extends Model
{
    use HasFactory;

    protected $guarded = [
       
    ];

    public function penghuniRumah()
    {
        return $this->belongsTo(PenghuniRumah::class, 'PenghuniRumah_id');
    }
    



}
