<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'age',
        'refer_by_doctor'
    ];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'report_test');
    }
}
