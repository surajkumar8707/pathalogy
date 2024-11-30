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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'report_test')
            ->withPivot('id', 'category_id', 'sub_category_id', 'lower_value') // Include pivot table fields
            ->withTimestamps();
    }
}
