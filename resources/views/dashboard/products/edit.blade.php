@extends('layouts.dashboard')

@section("style")
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endsection
@section("scripts")
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElm = document.querySelector("[name=tags]"),
    tagify = new Tagify (inputElm);

</script>
@endsection
@section("title","Categories")

@section('content')
<form action="{{route('products.update',$products->id)}}" method="post" class="p-3" enctype="multipart/form-data">
  @method("PUT")
    @csrf
    <div class="from-group">
      <label for="">Product Name</label>
      <input type="text" name="name" class="form-control" value="{{$products->name}}">
    </div>
    <div class="from-group">
      <label for="">Category</label>
      <select name="category_id" class="form-control form-select">
        {{-- <option value="">Category</option> --}}
        @foreach (App\models\Category::All() as $parent)
            <option value={{$parent->id}} @selected($products->parent_id == $parent->id)>{{$parent->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="from-group">
      <label for="">Products Description</label>
      <textarea name="description" id=""  class="form-control">{{$products->description}}</textarea>
    </div>
    <div class="from-group">
      <label for="">Products image</label>
      <input type="file" name="image" class="form-control">
    </div>
    <div class="from-group">
      <label for="">Price</label>
      <input type="number" name="price" class="form-control" value={{$products->price}}>
    </div>
    <div class="from-group">
      <label for="">Compare Price</label>
      <input type="number" name="price" class="form-control" value={{$products->compare_price}}>
    </div>
    <div class="from-group">
      <label for="">Tags</label>
      <input type="text" name="tags" class="form-control" value="{{$tags}}">
    </div>
    <div class="form-group">
      <label for="">CategoryStatus</label>
      <div class="form-check">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="Active" value="active"  @checked($products->status == "active")>
          <label class="form-check-label" for="Active">
            Active
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="Archived" value="draft" @checked($products->status == "archived")>
          <label class="form-check-label" for="Archived">
            Draft
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="Archived" value="archived" @checked($products->status == "archived")>
          <label class="form-check-label" for="Archived">
            Archived
          </label>
        </div>
      </div>
    </div>
    <div class="from-group">  
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection