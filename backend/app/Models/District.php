<?php

namespace App\Models;

use App\Models\State;
use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

}
