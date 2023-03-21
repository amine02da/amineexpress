<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        "store_id",
        "category_id",
        "name","slug",
        "description",
        "image",
        "price",
        "compare_price",
        "status"
    ];

    //start api 
    protected $hidden = 
    [
        "created_at", "updated_at", "deleted_at","image"
    ];

    protected $appends = [
        "UrlImage"
    ];
    //end api 
    
    // globalscope
    protected static function booted(){
        static::addGlobalScope("store",function(Builder $builder){
    
            $user = Auth::user();
            if($user && $user->store_id){
                $builder->where("store_id", "=", $user->store_id);
            }
        });
        // api
        static::creating(function(Product $product)
        {
            $product->slug = Str::slug($product->name);
        });
    }


    // relationship
    public function Category(){
        return $this->belongsTo(Category::class,"category_id","id")->withDefault();
    }

    public function store(){
        return $this->belongsTo(Store::class,"store_id","id");
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    // localscope

    public function scopeActive(Builder $builder)
    {
      $builder->where("status", "=" ,"active");
    }

    // Accessors
    public function getUrlImageAttribute()
    {
        if(!$this->image){
            return asset("defaultImg/default_product.png");
        }
        if(Str::startsWith($this->image,["http://" , "https://"])){
            return $this->image;
        }
        return asset("storage/".$this->image);
    }

    public function getPercentAttribute() 
    {
        if(!$this->compare_price){
            return 0;
        }
        return number_format( 100 - (100 * $this->price / $this->compare_price), 1);   
    }

    //api filter
    public function scopeFilter(Builder $builder, $filters) {

        $options = array_merge([
            "store_id" => null,
            "category_id" => null,
            "tag_id" => null,
            "status" => "active"
        ],$filters);
 
        $builder->when($options["status"],function($builder,$value){
            $builder->where("status",$value);
        });
        $builder->when($options["store_id"],function($builder,$value){
            $builder->where("store_id",$value);
        });

        $builder->when($options["category_id"],function($builder,$value){
            $builder->where("category_id",$value);
        });

        // $builder->when($options["tag_id"],function($builder,$value){
        //     $builder->whereHas("tags",function($builder) use ($value){
        //         $builder->where("id",$value);
        //     });
        // });
    }
    //end filter
}
