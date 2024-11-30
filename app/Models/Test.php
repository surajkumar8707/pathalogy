<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'sub_category_id', 'name', 'upper_value', 'lower_value', 'percent'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_test')->withPivot('id', 'category_id', 'sub_category_id', 'lower_value') // Include pivot table fields
            ->withTimestamps();
    }
}
