<x-front-layout >
        <x-slot name="breadcrumd">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{$user->name}}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{route('home')}}"><i class="lni lni-home"></i>Home</a></li>
                            <li><a href="{{route('products.index')}}">Shop</a></li>
                            <li>{{$user->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
        <!-- Start Item Details -->
<form action="{{route('store.store')}}" method="post">
  @csrf
                       <div class="checkout-steps-form-style-1">
                        <ul id="accordionExample">
                            <li>
                                <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="true" aria-controls="collapseThree">Your Store Details </h6>
                                <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <label>Store Name</label>
                                                <div class="row">
                                                    <div class="col-md-6 form-input form">
                                                        <input type="text" name="name" placeholder="Store Name">
                                                    </div>
                                                    <div class="col-md-6 form-input form">
                                                        <input type="text" name="description" placeholder="description...">
                                                      </div>
                                                                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Logo</label>
                                                <div class="form-input form">
                                                  <input type="file" name="logo_image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Cover Image</label>
                                                <div class="form-input form">
                                                    <input type="file" name="cover_image" placeholder="Cover Image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Status</label>
                                                <div class="form-input form">
                                                    <select name="status" class="form-control">
                                                        <option>Active</option>
                                                        <option>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form button">
                                                <button class="btn" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFour" aria-expanded="false"
                                                    aria-controls="collapseFour">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </li>

                        </ul>
                    </div>
</form>
        <!-- End Item Details -->
    
        <!-- Review Modal -->

        <!-- End Review Modal -->

    @push("scripts")
        <script type="text/javascript">
            const current = document.getElementById("current");
            const opacity = 0.6;
            const imgs = document.querySelectorAll(".img");
            imgs.forEach(img => {
                img.addEventListener("click", (e) => {
                    //reset opacity
                    imgs.forEach(img => {
                        img.style.opacity = 1;
                    });
                    current.src = e.target.src;
                    //adding class 
                    //current.classList.add("fade-in");
                    //opacity
                    e.target.style.opacity = opacity;
                });
            });
         </script>
    @endpush  
</x-front-layout>

