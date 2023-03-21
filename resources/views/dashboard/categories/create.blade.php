@extends('layouts.dashboard')

@section("title","Categories")

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
<form action="{{route('categories.store')}}" method="post" class="p-3" enctype="multipart/form-data">
    @csrf
    <div class="from-group">
      <label for="">Category Name</label>
      <input type="text" name="name" value="{{old('name')}}" class="form-control  @error("name") is-invalid @enderror">
      @error("name")
     
      <div class="text-danger">
        {{$message}}
      </div>
      @enderror
    </div>
    <div class="from-group">
      <label for="">Category Parent</label>
      <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value={{$parent->id}} >{{$parent->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="from-group">
      <label for="">Category Description</label>
      <textarea name="description" id=""  class="form-control">{{old('description')}}</textarea>
    </div>
    <div class="from-group">
      <label for="">Category image</label>
      <input type="file" name="image" class="form-control" accept="Image/*">
    </div>
    <div class="form-group">
      <label for="">CategoryStatus</label>
      <div class="form-check">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="exampleRadios" id="Active" value="active" >
          <label class="form-check-label" for="Active">
            Active
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="exampleRadios" id="Archived" value="archived"  >
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