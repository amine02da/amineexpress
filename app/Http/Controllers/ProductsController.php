<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // if($user->store_id){
        //     $products = Product::where('store_id', '=', $user->store_id)->paginate();
        // }else{
        // }
        $products = Product::paginate(10);
        return view("dashboard.products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoires = Category::all();
        return view("dashboard.products.create",compact("categoires"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $request->merge([
            "store_id" => Auth::user()->store->id
        ]);

        $products = $request->except("image");
        
        if($request->hasFile("image"))
        {
            $file = $request->file("image");
            $path = $file->store("uplodes","public");
            $products["image"] = $path;
        }
        Product::create($products);
        return redirect("/dashboard/products")->with("success","product created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $tags = implode(",",$products->tag()->pluck("name")->toArray());
        return view("dashboard.products.edit",compact("products","tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        $Product->update($request->except("tags"));

        // $tags = explode(",", $request->post("tags")); sans tagifay
        $tags = json_decode($request->post("tags")); //with tagifay
        $tag_ids = [];

        foreach($tags as $t_name) {
            // $slug = Str::slug($t_name); sans tagifay
            $slug = Str::slug($t_name->value); //with tagifay
            $tag = Tag::where("slug", "=", $slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    // "name" => $t_name sans tagifay
                    "name" => $t_name->value, //with tagifay
                    "slug" => $slug
                ]);
            }
            $tag_ids[] = $tag->id; 
        }
        $Product->tag()->sync($tag_ids);


        return redirect()->route("products.index")->with("success","Product updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
