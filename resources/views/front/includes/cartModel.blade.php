 <div class="modal fade flip-modal add-cart-modal" id="addtocatt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="cart-head">
                    <a> <i class="fa-solid fa-arrow-left-long"></i>My Cart (<span class="center-main">0</span> items)</a>
                </div>
                <div class="add-cart-sec productListContainer" >
                    
                </div>
                <div class="add-cart-footer">
                <a href="{{ route('product.viewBag') }}" class="detail-cart-btn me-1">
                    View Cart
                </a>

                 @if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->id)
                 <a href="{{ Url('/checkout') }}" class="buy-now-btn">
                    Checkout
                </a>
                
                @else
                <a href="javascript::void('0')" data-bs-toggle="modal" data-bs-target="#login"  class="buy-now-btn">
                    Checkout
                </a>

                @endif
                </div>
            </div>
        </div>
    </div>
</div>