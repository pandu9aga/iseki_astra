<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types'; // Nama tabel
    protected $primaryKey = 'Id_Type'; // Nama primary key

    public $timestamps = false; // Jika tabel tidak memiliki created_at dan updated_at
}
