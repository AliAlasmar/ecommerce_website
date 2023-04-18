<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable =[
        'abbr','locale','name','direction','active','created_at','updated_at'
    ];
    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function getActiveAttribute( $value)
    {
        return  $value === 1 ? 'مفعل' : "غير مفعل";
    }
}
