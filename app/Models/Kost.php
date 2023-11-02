<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kota;
use App\Models\User;
use Fasilitas;

class Kost extends Model
{
    use HasFactory;
    /**
     * - Mapping table
     * - Mapping kolom
     */
    protected $table = 'kost';
    protected $guarded = [];  
}