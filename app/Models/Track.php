<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'tracks'; // Nama tabel
    protected $primaryKey = 'Id_Track'; // Nama primary key

    public $timestamps = false; // Jika tabel tidak memiliki created_at dan updated_at

    protected $fillable = [
        'Id_User',
        'Id_Type',
        'Id_Area',
        'Time_Track',
        'Status_Track'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Id_User', 'Id_User');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'Id_Area', 'Id_Area');
    }

    public function track_photo()
    {
        return $this->hasMany(Track_Photo::class, 'Id_Track', 'Id_Track');
    }
}
