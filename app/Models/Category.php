<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'title'];
    
    /**
     * Handle the title attribute for backward compatibility
     */
    public function getTitleAttribute()
    {
        return $this->category_name;
    }
    
    /**
     * Set both title and category_name when title is set
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['category_name'] = $value;
    }
}