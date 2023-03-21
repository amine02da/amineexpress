<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable  = ["parent_id","name","slug","description","image","status"];

    public function scopeActive(Builder $builder){
        $builder->where("status" , "=" , "active");
    }

    public function Products(){
        return $this->hasMany(Product::class,"category_id","id");
    }

    
    public function parent(){
        return $this->belongsTo(Category::class,"parent_id","id");
    }
    public function category(){
        return $this->hasMany(Category::class,"parent_id","id");
    }

    public static function rules(){
        // 
        return [
            "name" => [
                "required",
                "string",
                "min:3",
                "max:255",
                function ($attribute, $value, $fails) {
                    if(strtolower($value) == "laravel"){
                        $fails("this name is forbidden !");
                    }
                }
                
            ],
            // "name" => "required|string|min:3|max:255",

            "parent_id" => "nullable|int|exists:categories,id",
            "status" => "in:active,archived",
            //validation second method
            "image" => [
                "image",
                "max:1048576"
            ]
        ];
    }
    // Accessors
    public function getUrlImageAttribute()
    {
        if(!$this->image){
            return "imge.png";
        }
        if(Str::startsWith($this->image,["http://" , "https://"])){
            return $this->image;
        }
        return asset("storage/".$this->image);
    }
}
