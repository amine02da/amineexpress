                                <div class="cart-items">
                                    <a href="javascript:void(0)" class="main-btn">
                                        <i class="lni lni-cart"></i>
                                        <span class="total-items">{{$items->count()}}</span>
                                    </a>
                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{$items->count()}} Items</span>
                                            <a href={{route('cart.index')}}>View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                            @foreach($items as $item)
                                            <li>
                                                <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                                                        class="lni lni-close"></i></a>
                                                <div class="cart-img-head">
                                                    <a class="cart-img" href="{{route("products.show",$item->products->slug)}}"><img
                                                            src="{{$item->products->UrlImage}}" alt="PRODUCT IMAGE"></a>
                                                </div>
                                                <div class="content">
                                                    <h4><a href="{{route("products.show",$item->products->slug)}}">{{$item->products->name}}</a></h4>
                                                    <p class="quantity">{{$item->quantity}}x - <span class="amount">{{App\Helpers\Currency::format($item->products->price)}}</span></p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount">{{App\Helpers\Currency::format($total)}}</span>
                                            </div>
                                            <div class="button">
                                                <a href="checkout.html" class="btn animate">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Shopping Item -->
                                </div>