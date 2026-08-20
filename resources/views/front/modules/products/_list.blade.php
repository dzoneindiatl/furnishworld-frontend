<div class="row shop-page-r-row">
    @dd("t1");
@if($products->count() > 0)
    @foreach($products as $product)
        <div class="col-md-4">
            <div class="product-slider">
                <div class="product-card">
                    @php
                        $mainImages = $product->product_main_images->take(2);
                        $firstImage = $mainImages->first();
                        $secondImage = $mainImages->skip(1)->first();

                        $discountType = (float) $product->selling_price;
                        $buyingPrice = (float) $product->buying_price;
                        $savings = $buyingPrice - $discountType;

                        // Calculate discount percentage
                        $discountPercentage = ($buyingPrice > 0 && $savings > 0) ? (($savings / $buyingPrice) * 100) : 0;
                    @endphp

                    @if($product->discount)
                        <div class="discount-badge">-{{ number_format($discountPercentage, 0)  }}%</div>
                    @endif
                    
                    <a href="{{ route('product.details', ['encrypted_id' => Crypt::encrypt($product->id)]) }}">
                        <img src="{{ $firstImage ? asset('uploads/products/' . $firstImage->graphic) : asset('img/no-image.jpg') }}" 
                            alt="{{ $product->name }}" 
                            class="default-image">

                        <img src="{{ $secondImage 
                                    ? asset('uploads/products/' . $secondImage->graphic) 
                                    : ($firstImage 
                                            ? asset('uploads/products/' . $firstImage->graphic) 
                                            : asset('img/no-image.jpg')) }}" 
                            alt="{{ $product->name }} Hover" 
                            class="hover-image">
                    </a>


                    <div class="product-info">
                        <h5>{{  $product->name }}</h5>
                        <p class="mb-0">{{ $product->brand->name ?? 'No Brand' }}</p>
                        <p class="price">
                            ₹{{ $discountType }}
                            @if($buyingPrice > $discountType)
                                <del>₹{{ $buyingPrice }}</del>
                            @endif
                        </p>
                        <p class="save-price">
                            Save  ₹{{ number_format($savings, 2) }}
                        </p>
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">
                                Add To Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="text-center w-100">No products available in this category.</p>
@endif
</div>

{{-- Pagination --}}
@if($products->hasPages())
    <div class="pagignation-box mt-5 mb-5">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($products->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-left"></i></span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($products->links()->elements[0] as $page => $url)
                <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
            @else
                <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-right"></i></span></li>
            @endif
        </ul>
    </div>
@endif