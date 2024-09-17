<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $guarded = [
       
    ];

    public function penghuni_rumahs()
    {
        return $this->hasMany(PenghuniRumah::class);
    }


}
