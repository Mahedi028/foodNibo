<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuOrder extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id','id');
    }
}
