<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'location','slug','parent_id'
    ];

    public function locations(){
        return $this->hasMany(Location::class,'parent_id');
    }
}
