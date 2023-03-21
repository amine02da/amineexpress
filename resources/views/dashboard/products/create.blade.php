@extends('layouts.dashboard')

@section("title","Products")

@section('content')
{{-- @if($errors->any())
<div class="alert alert-danger">
  <h3>Error Found !</h3>
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif --}}
<form action="{{route('products.store')}}" method="post" class="p-3" enctype="multipart/form-data">
    @csrf
    <div class="from-group">
      <label for="">Product Name</label>
      <input type="text" name="name" value="{{old('name')}}" class="form-control">
      @error("name")
     
      <div class="text-danger">
        {{$message}}
      </div>
      @enderror
    </div>
    <div class="from-group">
      <label for="">Category</label>
      <select name="category_id" class="form-control form-select">
        @foreach ($categoires as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="from-group">
      <label for="">Products Description</label>
      <textarea name="description" id=""  class="form-control"></textarea>
    </div>
    <div class="from-group">
      <label for="">Products image</label>
      <input type="file" name="image" class="form-control">
    </div>
    <div class="from-group">
      <label for="">Price</label>
      <input type="number" name="price" class="form-control" >
    </div>
    <div class="from-group">
      <label for="">Compare Price</label>
      <input type="number" name="compare_price" class="form-control" >
    </div>
    <div class="from-group">
      <label for="">Tags</label>
      <input type="text" name="tags" class="form-control" >
    </div>
    <div class="form-group">
      <label for="">Product Status</label>
      <div class="form-check">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="Active" value="active">
          <label class="form-check-label" for="Active">
            Active
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="Archived" value="draft">
          <label class="form-check-label" for="Archived">
            Draft
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="Archived" value="archived">
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