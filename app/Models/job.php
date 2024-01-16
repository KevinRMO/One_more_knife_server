<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'title',
        'date_start',
        'date_end',
        'salary',
        'description_job',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');

    }
}
