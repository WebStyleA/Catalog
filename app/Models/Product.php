<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function manufactures()
    {
        return $this->belongsTo(Manufactures::class,"manufactures_id");
    }

    public function scopeName($query, $name){
        if ($name) {
            return $query->where('name', 'like', "{$name}%");
        }
        return $query;
    }


    public function scopeCategoryId($query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        }
        return $query;
    }

    public function scopeManufactureId($query, $manufactureId)
    {
        if ($manufactureId) {
            return $query->where('manufactures_id', $manufactureId);
        }

        return $query;
    }
}
