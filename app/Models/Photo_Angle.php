<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo_Angle extends Model
{
    use HasFactory;

    protected $table = 'photo_angles'; // Nama tabel
    protected $primaryKey = 'Id_Photo_Angle'; // Nama primary key

    public $timestamps = false; // Jika tabel tidak memiliki created_at dan updated_at

    protected $fillable = [
        'Name_Photo_Angle',
        'Icon_Photo_Angle'
    ];
}
