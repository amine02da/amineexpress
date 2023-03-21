<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $request = request();
        $query = Category::query();

        if($name = $request->query("name")){
            $query->where("name", "LIKE", "%{$name}%");
        }

        
        $categories = $query
        // ->withCount("Products") // => get number of products ref to category usign realationShip 
        // ->withCount(["Products"=>function($query){$query->where('status','=','active')}])
        // ->selectRaw("(SELECT count(*) from products where category_id = categories.id) as product_count")
        ->paginate(4)
        ; //return collection object (all data)
        // $categories = Category::active()->paginate(); localscop 
        
        return view("dashboard.categories.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        return view("dashboard.categories.create",compact("parents"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(Category::rules());

        $request->merge([
            "slug" => Str::slug($request->name)
        ]);

        $data = $request->except("image");

        if($request->hasFile("image")){
            $file = $request->file("image");
            $path = $file->store("uploads", "public");
            $data["image"] = $path;
        }
        $categories = Category::create($data);
        return redirect()->route("categories.index")
                        ->with("success","Category created");
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
        
        //
        $category = Category::findOrFail($id);
        
        $parents = Category::where("id", "<>", $id)
            ->where(function ($query) use ($id) {
                $query->whereNull("parent_id")
                    ->OrWhere("parent_id", "<>", $id);
            })->get();
        return view("dashboard.categories.edit",compact("category","parents"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(Category::rules());
        
        $category = Category::findOrFail($id);

        $old_file = $category->image;
        $data = $request->except("image");
        
        if($request->hasFile("image")){
            $file = $request->file("image");
            $path = $file->store("uploads", "public");
            $data["image"] = $path;
        }    
        
        $category->update($data);
        if($old_file && isset($data["image"])){
            Storage::disk("public")->delete($old_file);
        }
        return redirect()->route("categories.index")
                        ->with("success","Category updated ");
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
        $Category = Category::findOrFail($id);
        $Category->delete();
        if($Category->image){
            Storage::disk("public")->delete($Category->image);
        }
        return redirect()->route("categories.index")
                        ->with("success","Category deleted");
    }

    public function trash() {
        $categories = Category::onlyTrashed()->get();
        return view("dashboard.categories.trash",compact("categories"));
    }

    public function restore($id) {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()->route("categories.trash")
        ->with("success","Category restored"); 
    }

    public function forceDelete($id) {
        $categorie = Category::onlyTrashed()->findOrFail($id);
        $categorie->forceDelete();
        return redirect()->route("categories.trash")
        ->with("success","Category Deleted"); 
    }
}
