<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id"; // hna fax bdlna id khasna n9olha lih hna 

    protected $fillable = ["first_name","last_name","birthday","gender","street_adress","city","state","post_code","country","locale"] ;
    public function user(){
        return $this->belongsTo(profile::class,"user_id","id");
    }


}
