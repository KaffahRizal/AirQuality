<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $primaryKey = 'id';
    public $incrementing = false; // karena ID kamu diisi manual

    protected $fillable = [
        'id',
        'regency_id',
        'name',
        'alt_name',
        'latitude',
        'longitude',
    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
