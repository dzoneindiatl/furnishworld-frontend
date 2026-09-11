@extends('front.layouts.app')
@section('content')
<style>
    .filter_sub_categories {
    display: none;
}

.filter_category_item.active > .filter_sub_categories {
    display: block;
}

.filter_child_categories {
    display: none;
}

.filter_sub_category.active > .filter_child_categories {
    display: block;
}
</style>
    <section class="site-content">
        <div class="offer-banner" bis_skin_checked="1">
            <div class="offer-banner-content" bis_skin_checked="1">
                <span class="offer-highlight">UPTO 70% OFF</span>
                <span class="offer-divider">|</span>
                <span class="offer-delivery">FREE DELIVERY AVAILABLE</span>
            </div>
        </div>
        <div class="page-banner-section">
            <div class="page-banner">
                <div class="container">
                    <div class="page-banner-wrap">
                        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                            <ul class="breadcrumb-items">
                                <li class="breadcrumb-item trail-begin"><a href="{{ Url('/') }}" rel="home"><span
                                            itemprop="name">Home</span></a></li>
                                <li class="breadcrumb-item trail-end"><span itemprop="name">Product List</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper product-cat-content-wrapper">
            <div class="container">
                <div class="page-header text-center">
                    <h1 class="page-title" id="pageTitle">{{ ucwords($category->name) }}</h1>
                </div>
                <div class="content-area">
                    <div class="product-cat-page">
                        <div class="filter_left_sidebar">
                            <h4 class="filter_head">Filters</h4>
                            <div class="filter_left_sidebar_inner">
                                <div class="filter_left_sidebar_box active">
                                    <div class="inner_filter_sec">
                                        <h5 class="filter_tab_head">
                                            Price Range
                                            <span class="filter_arrow">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </h5>
                                        <div class="filter_tab_content">
                                            <div class="price_range_filter">
                                                <div class="price_range_values">
                                                    <span>₹<span id="minPriceText">200</span></span>
                                                    <span>₹<span id="maxPriceText">99,999</span></span>
                                                </div>
                                                <div class="price_slider">
                                                    <div class="slider_track"></div>
                                                    <input type="range" id="minRange" min="200" max="99999" value="200" step="100" name="price_range[]">
                                                    <input type="range" id="maxRange" min="200" max="99999" value="99999" step="100" name="price_range[]">
                                                </div>

                                                <div class="price_input_wrapper">
                                                    <div class="price_input_box">
                                                        <label>Min Price</label>
                                                        <div class="price_input">
                                                            <span>₹</span>
                                                            <input type="number" id="minPrice" value="200" min="200" max="99999" name="price_range[]">
                                                        </div>
                                                    </div>

                                                    <div class="price_input_box">
                                                        <label>Max Price</label>
                                                        <div class="price_input">
                                                            <span>₹</span>
                                                            <input type="number" id="maxPrice" value="99999" min="200" max="99999" name="price_range[]">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter_left_sidebar_box">
                                    <div class="inner_filter_sec">
                                        <h5 class="filter_tab_head">
                                            Select Category
                                            <span class="filter_arrow">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </h5>

                                        <div class="filter_tab_content">
                                            <div class="filter_category">
                                                @foreach($AllMainCategory as $cat)
                                                    <div class="filter_category_item">
                                                        <div class="filter_category_head">
                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" name="category_id[]" id="category_{{ $cat->id }}" value="{{ $cat->id }}">
                                                                <label for="category_{{ $cat->id }}">{{ $cat->name }}</label>
                                                            </div>
                                                            <button type="button" class="category_arrow">
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                        </div>
                                                        <div class="filter_sub_categories">
                                                            @foreach($allSubCategory as $sub)
                                                                @if($sub->parent_id == $cat->id)
                                                                    @php
                                                                        $hasChildren = $allChildCategory
                                                                            ->where('parent_id', $sub->id)
                                                                            ->count() > 0;
                                                                    @endphp

                                                                    <div class="filter_sub_category">
                                                                        <div class="filter_sub_category_head">
                                                                            <div class="filter_toggle_button">
                                                                                <input type="checkbox"
                                                                                    id="subcategory_{{ $sub->id }}"
                                                                                    value="{{ $sub->id }}" name="sub_category_id[]">

                                                                                <label for="subcategory_{{ $sub->id }}">
                                                                                    {{ $sub->name }}
                                                                                </label>
                                                                            </div>
                                                                            @if($hasChildren)
                                                                                <button type="button"
                                                                                        class="subcategory_arrow">
                                                                                    <i class="fa fa-angle-down"></i>
                                                                                </button>
                                                                            @endif
                                                                        </div>

                                                                        @if($hasChildren)
                                                                            <div class="filter_child_categories">
                                                                                @foreach($allChildCategory as $child)
                                                                                    @if($child->parent_id == $sub->id)
                                                                                        <div class="filter_toggle_button">
                                                                                            <input type="checkbox" id="childcategory_{{ $child->id }}" name="sub_child_category_id[]" value="{{ $child->id }}">
                                                                                            <label for="childcategory_{{ $child->id }}">{{ $child->name }}</label>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                            <div class=""></div>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter_left_sidebar_box">
                                    <div class="inner_filter_sec">
                                        <h5 class="filter_tab_head">
                                            Colors
                                            <span class="filter_arrow">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </h5>
                                        <div class="filter_tab_content">
                                            <div class="color_filter">
                                                @foreach($variantColor as $col)
                                                    <label class="color_option">
                                                        <input type="checkbox" name="variantValuesColor[]" value="{{ $col->id }}">
                                                        <span class="color_circle" style="background:{{ $col->color_code }}"></span>
                                                        <span class="color_name">{{ $col->name }}</span>
                                                    </label>
                                                @endforeach     
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- <div class="product-filter-overlay"></div>  --}}
                    <div class="products-area">
                        <div class="product-area-top-sec">
                            <span class="tracking-count"><b>Total:</b> {{ $results->count() }}</span>
                            <div class="sort_by_wrapper">
                                <span class="sort_by_label">Sort By :</span>

                                <div class="sort_select_box">
                                    <select name="sortBy" id="sortBy">
                                        <option value="">Select Recommended</option>
                                        <option value="best_seller">Best Seller</option>
                                        <option value="is_featured">Featured</option>
                                        <option value="trending">Trending</option>
                                        <option value="low_high">Price: Low to High</option>
                                        <option value="high_low">Price: High to Low</option>
                                        <option value="latest">Latest</option>
                                    </select>

                                    <span class="sort_arrow">
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="product-display-mode"> 
                                <div id="grid" class="">
                                    <a href="javascript:void(0)" title="2 Column"><span></span><span></span></a>
                                </div>
                                <div id="grid_large" class="active">
                                    <a href="javascript:void(0)" title="3 Column"><span></span><span></span><span></span>
                                    </a>
                                </div>
                            </div>
                            <div class="product-display-mode mobile-view-mode">
                                <div id="grid" class=""><a href="javascript:void(0);"
                                        title="1 Column"><span></span></a></div>
                                <div id="grid_large" class="active"><a href="javascript:void(0);"
                                        title="2 Column"><span></span><span></span></a></div>
                            </div>
                        </div>
                        <ul class="products column-3" id="product-list">
                            @include('front.modules.shop.load_more_data')
                        </ul>
                        <div id="productLoader" style="display:none; text-align:center;"></div>
                    </div>
                    <!-- products-are  -->
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('.filter_tab_head').on('click', function() {
                    let currentBox = $(this).closest('.filter_left_sidebar_box');
                    currentBox.toggleClass('active');
                });
            });
            $(document).on('click', '.product-color-option', function (e) {
                e.preventDefault();
                e.stopPropagation();
                let colorOption = $(this);
                let variantValueId = colorOption.attr('data-variant-value-id');
                let productImageBox = colorOption.closest('.product-image');
                let productId = productImageBox.attr('data-product-id');
                console.log('Product ID:', productId);
                console.log('Variant Value ID:', variantValueId);
                $.ajax({
                    url: "{{ route('front-product-variant-image') }}",
                    type: "GET",

                    data: {
                        product_id: productId,
                        variant_value_id: variantValueId
                    },

                    success: function (response) {

                        let mainImage = productImageBox.find('.main-image');
                        console.log('Variant Image Response:', response);

                        if (response.first_image) {
                            productImageBox
                                .find('.product-image .product-main-image .main-image')
                                .attr('src', response.first_image);
                                mainImage.attr('src', response.first_image);

                                 productImageBox.find('.hover-image').attr('src',response.second_image || response.first_image);
                                // console.log('New src:', mainImage.attr('src'));
                                // console.log('DOM src:', mainImage[0].src);
                        }

                        colorOption
                            .closest('.product-option-colors')
                            .find('.product-color-option')
                            .removeClass('active');

                        colorOption.addClass('active');
                    },

                    error: function (xhr) {
                        console.log('Variant image AJAX error:', xhr.responseText);
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.category_arrow').on('click', function () {
                    $(this)
                        .closest('.filter_category_item')
                        .toggleClass('active');
                });
                $('.subcategory_arrow').on('click', function () {
                    $(this)
                        .closest('.filter_sub_category')
                        .toggleClass('active');
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const minRange = document.getElementById('minRange');
                const maxRange = document.getElementById('maxRange');
                const minPrice = document.getElementById('minPrice');
                const maxPrice = document.getElementById('maxPrice');
                const minPriceText = document.getElementById('minPriceText');
                const maxPriceText = document.getElementById('maxPriceText');
                const minimumGap = 200;
                function formatPrice(value) {
                    return Number(value).toLocaleString('en-IN');
                }

                function updatePriceText() {
                    minPriceText.textContent = formatPrice(minRange.value);
                    maxPriceText.textContent = formatPrice(maxRange.value);
                }
                minRange.addEventListener('input', function() {
                    if (parseInt(maxRange.value) - parseInt(minRange.value) <= minimumGap) {
                        minRange.value =parseInt(maxRange.value) - minimumGap;
                    }
                    minPrice.value = minRange.value;
                    updatePriceText();
                });
                maxRange.addEventListener('input', function() {
                    if (parseInt(maxRange.value) - parseInt(minRange.value) <= minimumGap) {
                        maxRange.value = parseInt(minRange.value) + minimumGap;
                    }
                    maxPrice.value = maxRange.value;
                    updatePriceText();
                });

                minPrice.addEventListener('input', function() {
                    let value = parseInt(this.value);
                    if (value < parseInt(minRange.min)) {
                        value = parseInt(minRange.min);
                    }

                    if (value > parseInt(maxRange.value) - minimumGap) {
                        value = parseInt(maxRange.value) - minimumGap;
                    }
                    minRange.value = value;
                    updatePriceText();
                });

                maxPrice.addEventListener('input', function() {
                    let value = parseInt(this.value);
                    if (value > parseInt(maxRange.max)) {
                        value = parseInt(maxRange.max);
                    }
                    if (value < parseInt(minRange.value) + minimumGap) {
                        value = parseInt(minRange.value) + minimumGap;
                    }

                    maxRange.value = value;
                    updatePriceText();
                });
                document.querySelector('.price_reset_btn').addEventListener('click', function() {
                    minRange.value = 200;
                    maxRange.value = 100000;
                    minPrice.value = 200;
                    maxPrice.value = 100000;
                    updatePriceText();
                });
                updatePriceText();
            });
        </script>
        </div>
    </section>

@endsection

<style>
    .pagination svg {
        width: 20px;
        /* Forces icons to a normal size */
        height: 20px;
        display: inline-block;
    }

    nav[role="navigation"] div:last-child {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .text-sm,
    .text-gray-700,
    .leading-5,
    .dark:text-gray-400 {
        padding: 20px;
    }
</style>
<script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
<script>
    var url = "{{ route('front-get-category') }}";

    function getSubCategory() {
        var parentId = $('select[name="category_id"]').val();
        $.ajax({
            url: url,
            data: {
                parentId: parentId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#sub_category_id').empty();
                let s = new Option("Select Sub Category", "");
                $('#sub_category_id').append(s);
                response.forEach(function(item, index) {
                    let r = `<option value="${item.id}">${item.name}</option>`;
                    $('#sub_category_id').append(r);
                });
            },
            error: function(error) {
                console.log(err);
            }

        });
    }

    function getSubChildCategory() {
        var parentId = $('select[name="sub_category_id"]').val();
        $.ajax({
            url: url,
            data: {
                parentId: parentId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                $('#sub_child_category_id').empty();
                let s = new Option("Select Sub Category", "");
                $('#sub_child_category_id').append(s);
                response.forEach(function(item, index) {
                    let r = `<option value="${item.id}">${item.name}</option>`;
                    $('#sub_child_category_id').append(r);
                });
            },
            error: function(error) {
                console.log(err);
            }

        });
    }


    $(document).on('change','.product-filter-select, input[name="category_id[]"], input[name="sub_category_id[]"], input[name="sub_child_category_id[]"], input[name="variantValuesColor[]"], #minRange, #maxRange, #minPrice, #maxPrice, select[name="sortBy"]',function () {
        console.log('Filter changed');
        offset = 0;
        hasMore = true;
        loadProducts(true);
    });
            function loadProducts(reset = false){
                let categoryIds = $('input[name="category_id[]"]:checked').map(function () { return $(this).val();}).get();
                let subCategoryIds = $('input[name="sub_category_id[]"]:checked').map(function () {return $(this).val();}).get();
                let subChildCategoryIds = $('input[name="sub_child_category_id[]"]:checked').map(function () {return $(this).val();}).get();
                let colorIds = $('input[name="variantValuesColor[]"]:checked').map(function () {return $(this).val();}).get();
                let sortBy = $('select[name="sortBy"]').val() || '';
                let minPrice = parseInt($('#minPrice').val()) || 200;
                let maxPrice = parseInt($('#maxPrice').val()) || 99999;
                let priceRange = minPrice + '-' + maxPrice;

                $.ajax({
                    url: "{{ route('category.show', ['path' => $path]) }}",
                    method:"GET",
                    data: {
                        category_id: categoryIds,
                        sub_category_id: subCategoryIds,
                        sub_child_category_id: subChildCategoryIds,
                        variantValuesColor: colorIds,
                        price_range: priceRange,
                        sortBy: sortBy,
                        offset: offset,
                        limit: 20
                    },
                    success:function(response){
                        console.log(response); 
                        if (reset == true) {
                            $('#product-list').html(response.html);
                        } else {
                            $('#product-list').append(response.html);
                        }
                        hasMore = response.hasMore;
                        offset = response.nextOffset;
                    },
                    error:function(xhr){
                        console.log(xhr.responseText);
                    },
                    complete: function() {
                        loading = false;
                        $('#productLoader').hide();
                    }
                }); 
            }
</script>
<script>
    let offset = {{ $results->count() }};
    let loading = false;
    let hasMore = {{ $hasMore ? 'true' : 'false' }};

    window.addEventListener('scroll', function() {

        if (loading || !hasMore) {
            return;
        }

        const scrollTop = window.scrollY;
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;
        if (scrollTop + windowHeight >= documentHeight - 500) {
            loading = true;
            $.ajax({
                url: window.location.href,
                type: 'GET',
                data: {
                    offset: offset,
                    limit: 8,
                    ajax: 1
                },

                beforeSend: function() {
                    $('#productLoader').show();
                },
                success: function(response) {
                    console.log('AJAX RESPONSE:', response);
                    if (response.html && response.html.trim() !== '') {
                        $('#product-list').append(response.html);
                        offset = response.nextOffset;
                        hasMore = response.hasMore;
                    } else {
                        hasMore = false;
                    }
                },
                error: function(xhr) {
                    console.log('AJAX ERROR:', xhr.status);
                    console.log(xhr.responseText);
                },

                complete: function() {
                    loading = false;
                    if (hasMore) {
                        $('#productLoader').hide();
                    }
                }
            });
        }

    });
</script>
