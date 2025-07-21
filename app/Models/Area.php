<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas'; // Nama tabel
    protected $primaryKey = 'Id_Area'; // Nama primary key

    public $timestamps = false; // Jika tabel tidak memiliki created_at dan updated_at

    protected $fillable = [
        'Name_Area'
    ];

    public function area_photo()
    {
        return $this->hasMany(Area_Photo::class, 'Id_Area', 'Id_Area');
    }
}
