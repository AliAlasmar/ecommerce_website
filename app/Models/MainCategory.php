<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'translation_lang','translation_of','name','slug','photo','active','created_at','updated_at'
    ];

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function getActiveAttribute( $value)
    {
        return  $value === 1 ? 'مفعل' : "غير مفعل";
    }

    public function categories (){
        return $this->hasMany(self::class,'translation_of','id');
    }

    public function vendors (){
        return $this->hasMany('App\Models\Vendor','category_id','id');
    }

    public function abbrs (){
        return $this->hasOne('App\Models\Language','abbr','translation_lang');
    }
}
