<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;

    protected $table = 'villages';

    protected $primaryKey = 'id';
    public $incrementing = false; // karena ID dimasukkan manual
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'district_id',
        'name',
        'alt_name',
        'latitude',
        'longitude',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
