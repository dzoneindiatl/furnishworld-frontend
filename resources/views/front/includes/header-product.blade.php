@foreach($products->take(12) as $product)
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{$product->images['first']}}" alt="">
                            </div>
                            <div class="hover-panel">
                                <div class="hover-content">
                                    <h3>
                                        {{ $product->name }}
                                    </h3>
                                    <div class="price-wrap">
                                        <span class="price">₹{{ $product->selling_price }}</span>
                                        <span class="old-price">₹{{ $product->buying_price }}</span>
                                    </div>
                                    <div class="product-actions">
                                        <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => $product->sku]) }}" class="action-btn add_to_cart_btn">
                                            Buy now
                                        </a>

                                        <button class="wishlist-btn">
                                            <span class="material-symbols-outlined">favorite</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach