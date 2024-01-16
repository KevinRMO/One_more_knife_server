<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'user_id',
        'comment',
        'rate_company'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
