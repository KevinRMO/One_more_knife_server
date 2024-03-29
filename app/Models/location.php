<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'zip_code',
        'city',
        'description_location',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
