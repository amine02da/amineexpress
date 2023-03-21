<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class profile extends Controller
{
    //
    public function edit() {
       $user = Auth::user();

       return view("dashboard.profile.edit",[
                    "user" => $user,
                    "countries" => Countries::getNames("en"),
                    'locale' => Languages::getNames("en"),
        ]);
    }

    public function update(Request $request) {
 
        $request->validate([
            "first_name"=>["required","string","max:255"],
            "last_name"=>["required","string","max:255"],
            "birthday" => ["nullable","date","before:today"],
            "gender" => ["in:male,female"],
            "country"=>["required","string"]
        ]);
        $user = $request->user(); //or $user = Auth::user(); 
        $user->profile->fill($request->all())->save(); //hadi ila kan model

        return redirect()->route("profile.edit")
                         ->with("success" , "Profile updated !");
                        
        
        
        
        // $profile = $user->profile(); //ikhtisar ⬆
        // if($profile->first_name){
        //     $profile->update($request->all()); //profile hya smyt relation Hasone liswbna f model user il kan 4t3del 3lih
        // }else {
            // $request->merge([
            //     "user_id" => $user->id
            // ]);
            // profile::create($request->all()); //ila mkanx 4tdir lih whed

            //ikhtisar🔽

        //     $user->profile()->create($request->all());
        // }

    }
}
