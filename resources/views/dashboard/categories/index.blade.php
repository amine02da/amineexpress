@extends('layouts.dashboard')

@section("title","Categories")

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 d-inline-block">Categories</h1>
                <a href="{{route('categories.create')}}" class="mb-2 ml-3 btn btn-sm btn-outline-primary">Create +</a>
                <a href="{{route('categories.trash')}}" class="mb-2 ml-3 btn btn-sm btn-outline-dark">Archives</a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Dashborad</a></li>
                  <li class="breadcrumb-item active">Categories</li>
                </ol>
              </div>
            </div>
          </div>  
        </div>
        @if(session()->has("success"))
        <div class="alert alert-success">
          {{session("success")}}
        </div>
        @endif
        <form action="{{route('categories.index')}}" method="get">
          <input type="text" name="name" placeholder="search by name...">
         <input type="submit" value="Search" class="btn btn-dark">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Id</th>
                    <th>Name</th>
                    {{-- <th>number</th> --}}
                    <th>Parent</th>
                    <th>Create At</th>
                    <th colspan="2" >Options</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($categories as $categorie)
                    <tr>
                        <td><img src="{{$categorie->UrlImage}}" alt="" width="50" height="50"></td>
                        <td>{{$categorie->id}}</td>
                        <td>{{$categorie->name}}</td>
                        {{-- <td>{{$categorie->products_count}}</td> --}}
                        <td>{{$categorie->parent ? $categorie->parent->name : "Primary Category" }}</td>
                        <td>{{$categorie->created_at}}</td>
                        <td>
                            <a href="{{route('categories.edit',$categorie->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('categories.destroy',$categorie->id)}}" method="post">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            No categories defined.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{$categories->links()}}
@endsection