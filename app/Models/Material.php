<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function facilities() {
        return $this->belongsToMany(Facility::class, 'facility_material');
    }
}
