@extends('layouts.dashboard')

@section("title","Orders")

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 d-inline-block">Orders</h1>
                {{-- <a href="{{route('categories.create')}}" class="mb-2 ml-3 btn btn-sm btn-outline-primary">Create +</a>
                <a href="{{route('categories.trash')}}" class="mb-2 ml-3 btn btn-sm btn-outline-dark">Archives</a> --}}
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Dashborad</a></li>
                  <li class="breadcrumb-item active">Orders</li>
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
        <form action="{{route('orders.index')}}" method="get">
          <input type="text" name="numder" placeholder="search by number...">
         <input type="submit" value="Search" class="btn btn-dark">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Store Name</th>
                    <th>User Name</th>
                    <th>Payement Method</th>
                    <th>Status</th>
                    <th>Payement</th>
                    <th>Created at</th>
                    {{-- <th colspan="2" >Options</th> --}}
                </tr>
            </thead>
            <tbody>

                @forelse ($orders as $order)
                    <tr>
                        <td>{{$order->numder}}</td>
                        <td>{{$order->store->name}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->payment_method}}</td>
                        <td>
                        <select name="" id="" class="form-control">
                          <option value="">{{$order->status}}</option>
                          <option value="">processing</option>
                          <option value="">delivering</option>
                          <option value="">completed</option>
                          <option value="">canelled</option>
                          <option value="">refunded</option>
                        </select>
                        </td>
                        <td>
                        <select name="" id="" class="form-control">
                          <option value="">{{$order->payment_status}}</option>
                          <option value="">paid</option>
                          <option value="">failed</option>
                        </select>
                        </td>
                        <td>{{$order->created_at}}</td>
                        {{-- <td>
                            <a href="{{route('categories.edit',$order->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('categories.destroy',$order->id)}}" method="post">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td> --}}
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            No orders defined.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{$orders->links()}}
@endsection