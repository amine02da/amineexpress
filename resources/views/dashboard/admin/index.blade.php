@extends('layouts.dashboard')

@section("title","Dashboard")

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Dashboard Page</li>
                </ol>
              </div>
            </div>
          </div>  
        </div>

        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="card card-info card-outline">
                  <div class="d-flex">
                  <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text">
                      {{App\Models\Product::count()}}
                    </p>
                    <a href="/dashboard/products" class="card-link">Show Products</a>
                  </div>
                  <img src="{{asset('assets/images/product.svg')}}" alt="orderImage" width="130px" class="m-2" style="color: aqua">
                    </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-warning card-outline">
                  <div class="d-flex">
                  <div class="card-body">
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text">
                      {{App\Models\Category::count()}}
                    </p>
                    <a href="/dashboard/products" class="card-link">Show Categories</a>
                  </div>
                  <img src="{{asset('assets/images/category.svg')}}" alt="orderImage" width="130px" class="m-2">
                </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-success card-outline">
                  <div class="d-flex">
                    <div class="card-body">
                      <h5 class="card-title">Total Orders</h5>
                      <p class="card-text">
                        {{App\Models\Order::count()}}
                      </p>
                      <a href="/dashboard/orders" class="card-link">Show Orders</a>
                    </div>
                    <img src="{{asset('assets/images/order.svg')}}" alt="orderImage" width="130px" class="m-2">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- /.content -->
@endsection