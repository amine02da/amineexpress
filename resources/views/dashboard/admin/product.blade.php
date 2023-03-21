@extends('layouts.dashboard')

@section("title","Products")

@section('content')

        <!-- Content Header (Page header) -->
        @if(session()->has("success"))
          <p class="alert alert-success">{{session("success")}}</p>
        @endif
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 d-inline-block">Products</h1>
                <a href="{{route('products.create')}}" class="mb-2 ml-3 btn btn-sm btn-outline-primary">Create +</a>
                {{-- <a href="{{route('products.trash')}}" class="mb-2 ml-3 btn btn-sm btn-outline-dark">Archives</a> --}}
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Dashborad</a></li>
                  <li class="breadcrumb-item active">Products</li>
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
        <form action="{{route('products.index')}}" method="get">
          <input type="text" name="name" placeholder="search by name...">
         <input type="submit" value="Search" class="btn btn-dark">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>avatar</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Store</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th colspan="2" >Options</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td><img src="{{$product->UrlImage}}" alt="" width="50" height="50"></td>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{($product->category->name)}}</td>
                        <td>{{$product->store->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->status}}</td>
                        {{-- <td>{{($product->price) ? $product->parent_id : "Primary Product" }}</td> --}}
                        <td>{{$product->created_at}}</td>
                        <td>
                            <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('products.destroy',$product->id)}}" method="post">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            No products defined.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{$products->withQueryString()->links()}}
@endsection