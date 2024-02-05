<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($menu){
            $menu->slug=Str::slug($menu->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
