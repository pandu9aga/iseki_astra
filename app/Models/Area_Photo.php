<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area_Photo extends Model
{
    use HasFactory;

    protected $table = 'area_photos'; // Nama tabel
    protected $primaryKey = 'Id_Area_Photo'; // Nama primary key

    public $timestamps = false; // Jika tabel tidak memiliki created_at dan updated_at

    protected $fillable = [
        'Id_Area',
        'Id_Photo_Angle'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'Id_Area', 'Id_Area');
    }

    public function photo_angle()
    {
        return $this->belongsTo(Photo_Angle::class, 'Id_Photo_Angle', 'Id_Photo_Angle');
    }
}
