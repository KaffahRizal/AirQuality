<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceProfile extends Model
{
    use HasFactory;

    protected $table = 'province_profiles';

    protected $fillable = [
        'province_id',
        'year',
        'population',
        'gdp',
        'num_elementary',
        'num_middle',
        'num_high',
        'num_university',
    ];

    /**
     * Relationship to the Province model
     */
    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }
}
