<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable=['number'];
    public $timestamps=false;
    protected $casts=[
        'watched'=>'boolean'
    ];
    public function seasons(){
        return $this->belongTo(Season::class);
    }


}
