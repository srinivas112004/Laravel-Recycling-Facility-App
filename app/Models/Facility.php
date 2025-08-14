<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['business_name','last_update_date','street_address'];
    protected $casts = ['last_update_date' => 'date'];

    public function materials() {
        return $this->belongsToMany(Material::class, 'facility_material');
    }
}
