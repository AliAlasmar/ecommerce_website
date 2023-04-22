<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;
    use HasFactory;
    protected $fillable =[
        'name','mobile','email','password','lat','lng','category_id','address','logo','active','created_at','updated_at'
    ];

    public function category (){
        return $this->belongsTo('App\Models\MainCategory','category_id','id');
    }

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function getActiveAttribute( $value)
    {
        return  $value === 1 ? 'مفعل' : "غير مفعل";
    }
}
