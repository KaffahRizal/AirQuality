<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regency extends Model
{
    use HasFactory;

    protected $table = 'regencies';

    protected $primaryKey = 'id';
    public $incrementing = false; // karena kamu pakai ID manual

    protected $fillable = [
        'id',
        'province_id',
        'name',
        'alt_name',
        'latitude',
        'longitude',
    ];

    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }
}
