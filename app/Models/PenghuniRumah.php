<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenghuniRumah extends Model
{
    use HasFactory;
    

    protected $guarded = [
       
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function rumah()
    {
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }

    public function pembayaranIuran()
{
    return $this->hasMany(PembayaranIuran::class, 'PenghuniRumah_id');
}


}
