@extends('layouts.dashboard')

@section("title","Categories")

@section('content')
<form action="{{route('categories.update',$category->id)}}" method="post" class="p-3" enctype="multipart/form-data">
  @method("PUT")
    @csrf
    <div class="from-group">
      <label for="">Category Name</label>
      <input type="text" name="name" class="form-control" value="{{$category->name}}">
    </div>
    <div class="from-group">
      <label for="">Category Parent</label>
      <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value={{$parent->id}} @selected($category->parent_id == $parent->id)>{{$parent->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="from-group">
      <label for="">Category Description</label>
      <textarea name="description" id=""  class="form-control">{{$category->description}}</textarea>
    </div>
    <div class="from-group">
      <label for="">Category image</label>
      <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
      <label for="">CategoryStatus</label>
      <div class="form-check">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="exampleRadios" id="Active" value="active"  @checked($category->status == "active")>
          <label class="form-check-label" for="Active">
            Active
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="exampleRadios" id="Archived" value="archived" @checked($category->status == "archived")>
          <label class="form-check-label" for="Archived">
            Archived
          </label>
        </div>
      </div>
    </div>
    <div class="from-group">  
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection