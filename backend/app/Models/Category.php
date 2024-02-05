<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];



    protected static function boot()
    {
        parent::boot();

        static::creating(function($category){
            $category->slug=Str::slug($category->name);
        });
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
