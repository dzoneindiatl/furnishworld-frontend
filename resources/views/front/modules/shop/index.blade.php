@extends('front.layouts.app')
@section('content')
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
        <!-- page-banner-section -->
        <div class="content-wrapper product-cat-content-wrapper">
            <div class="container">
                <div class="page-header text-center">
                    <h1 class="page-title" id="pageTitle">{{ ucwords($category->name) }}</h1>
                </div>
                <div class="content-area">
                    <div class="product-cat-page">
                        {{-- <div class="product-filter-outer">
                            <div class="product-filter-area">
                                <div class="product-filters">
                                    <div class="product-filter dropdown">
                                        <select name="category_id" class="form-control product-filter-select"
                                            id="category_id" onchange="getSubCategory();">
                                            <option value="">Select Category</option>
                                            @foreach ($AllMainCategory as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $category->id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="product-filter dropdown">
                                        <select name="sub_category_id" class="form-control product-filter-select"
                                            id="sub_category_id" onchange="getSubChildCategory();">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                                    <div class="product-filter dropdown">
                                        <select name="sub_child_category_id" class="form-control product-filter-select"
                                            id="sub_child_category_id">
                                            <option value="">Select Sub Child Category</option>
                                        </select>
                                    </div>
                                    <div class="product-filter dropdown">
                                        <select name="variantValuesColor" class="form-control product-filter-select"
                                            id="variantValuesColor">
                                            <option value="">Select Variant Colors</option>
                                            @foreach ($variantColor as $col)
                                                <option value="{{ $col->id }}">{{ $col->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="product-filter dropdown">
                                        <select name="price_range" class="form-control product-filter-select"
                                            id="price_range">
                                            <option value="">Select Price Range</option>
                                            <option value="1000-5000">1000-5000</option>
                                            <option value="5000-10000">5000-10000</option>
                                            <option value="10000-20000">10000-20000</option>
                                            <option value="20000-30000">20000-30000</option>
                                            <option value="30000-40000">30000-40000</option>
                                            <option value="40000-50000">40000-50000</option>
                                            <option value="50000-60000">50000-60000</option>
                                        </select>
                                    </div>
                                    <div class="product-filter dropdown">
                                        <select name="sortBy" class="form-control product-filter-select" id="">
                                            <option value="">Sort By</option>
                                            <option value="new_arrivals">New Arrivals</option>
                                            <option value="best_seller">Best Seller</option>
                                            <option value="featured">Featured</option>
                                            <option value="trending">Trending</option>
                                            <option value="low_high">Price Low To High</option>
                                            <option value="high_low">Price High To Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product-display-mode">
                                    <div id="grid" class=""><a href="javascript:void(0);"
                                            title="3 Column"><span></span><span></span><span></span></a></div>
                                    <div id="grid_large" class="active"><a href="javascript:void(0);"
                                            title="4 Column"><span></span><span></span><span></span><span></span></a></div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="filter_left_sidebar">
                            <h4 class="filter_head">Filters</h4>

                            <div class="filter_left_sidebar_inner">

                                <!-- Price -->
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

                                                <!-- Price values -->
                                                <div class="price_range_values">
                                                    <span>₹<span id="minPriceText">1000</span></span>
                                                    <span>₹<span id="maxPriceText">99,989</span></span>
                                                </div>

                                                <!-- Range Slider -->
                                                <div class="price_slider">
                                                    <div class="slider_track"></div>

                                                    <input type="range" id="minRange" min="1000" max="100000"
                                                        value="9" step="100">

                                                    <input type="range" id="maxRange" min="1000" max="100000"
                                                        value="99999" step="100">
                                                </div>

                                                <!-- Min / Max Input -->
                                                <div class="price_input_wrapper">

                                                    <div class="price_input_box">
                                                        <label>Min Price</label>

                                                        <div class="price_input">
                                                            <span>₹</span>
                                                            <input type="number" id="minPrice" value="1000"
                                                                min="1000" max="100000">
                                                        </div>
                                                    </div>

                                                    <div class="price_input_box">
                                                        <label>Max Price</label>

                                                        <div class="price_input">
                                                            <span>₹</span>
                                                            <input type="number" id="maxPrice" value="99999"
                                                                min="1000" max="100000">
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Buttons -->
                                                <!--div class="price_filter_action">

                                                                                                                                    <button type="button" class="price_apply_btn">
                                                                                                                                        Apply
                                                                                                                                    </button>

                                                                                                                                    <button type="button" class="price_reset_btn">
                                                                                                                                        Reset
                                                                                                                                    </button>

                                                                                                                                </div-->

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Type -->
                                <div class="filter_left_sidebar_box">
                                    <div class="inner_filter_sec">
                                        <h5 class="filter_tab_head">
                                            Select Category
                                            <span class="filter_arrow">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </h5>

                                        <div class="filter_tab_content">

                                            <!-- CATEGORY -->
                                            <div class="filter_category">

                                                <div class="filter_category_head">
                                                    <div class="filter_toggle_button">
                                                        <input type="checkbox" id="cat1">
                                                        <label for="cat1">Living Room</label>
                                                    </div>

                                                    <button type="button" class="category_arrow">
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                </div>


                                                <!-- SUB CATEGORIES -->
                                                <div class="filter_sub_categories">

                                                    <!-- SUB CATEGORY -->
                                                    <div class="filter_sub_category">

                                                        <div class="filter_sub_category_head">

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="sub1">
                                                                <label for="sub1">Sofa</label>
                                                            </div>

                                                            <button type="button" class="subcategory_arrow">
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>

                                                        </div>


                                                        <!-- SUB CHILD CATEGORY -->
                                                        <div class="filter_child_categories">

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="child1">
                                                                <label for="child1">2 Seater Sofa</label>
                                                            </div>

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="child2">
                                                                <label for="child2">3 Seater Sofa</label>
                                                            </div>

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="child3">
                                                                <label for="child3">Sectional Sofa</label>
                                                            </div>

                                                        </div>

                                                    </div>


                                                    <!-- ANOTHER SUB CATEGORY -->
                                                    <div class="filter_sub_category">

                                                        <div class="filter_sub_category_head">

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="sub2">
                                                                <label for="sub2">Chairs</label>
                                                            </div>

                                                            <button type="button" class="subcategory_arrow">
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>

                                                        </div>


                                                        <div class="filter_child_categories">

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="child4">
                                                                <label for="child4">Lounge Chair</label>
                                                            </div>

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="child5">
                                                                <label for="child5">Arm Chair</label>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>


                                            <!-- CATEGORY 2 -->
                                            <div class="filter_category">

                                                <div class="filter_category_head">

                                                    <div class="filter_toggle_button">
                                                        <input type="checkbox" id="cat2">
                                                        <label for="cat2">Bedroom</label>
                                                    </div>

                                                    <button type="button" class="category_arrow">
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>

                                                </div>


                                                <div class="filter_sub_categories">

                                                    <div class="filter_sub_category">

                                                        <div class="filter_sub_category_head">

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="sub3">
                                                                <label for="sub3">Beds</label>
                                                            </div>

                                                            <button type="button" class="subcategory_arrow">
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>

                                                        </div>

                                                        <div class="filter_child_categories">

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="child6">
                                                                <label for="child6">King Size Bed</label>
                                                            </div>

                                                            <div class="filter_toggle_button">
                                                                <input type="checkbox" id="child7">
                                                                <label for="child7">Queen Size Bed</label>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Metal -->
                                <div class="filter_left_sidebar_box">
                                    <div class="inner_filter_sec">
                                        <h5 class="filter_tab_head">
                                            Metal
                                            <span class="filter_arrow">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </h5>

                                        <div class="filter_tab_content">
                                            <div class="filter_label_val">
                                                <div class="filter_toggle_button">
                                                    <input type="checkbox" name="metal" id="metal1">
                                                    <label for="metal1">
                                                        Gold
                                                        {{-- <span class="filter_items_count">(46)</span> --}}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="filter_label_val">
                                                <div class="filter_toggle_button">
                                                    <input type="checkbox" name="metal" id="metal2">
                                                    <label for="metal2">
                                                        Rose Gold
                                                        {{-- <span class="filter_items_count">(50)</span> --}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="filter_left_sidebar_box">
                                    <div class="inner_filter_sec">
                                        <h5 class="filter_tab_head">
                                            Gender
                                            <span class="filter_arrow">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </h5>

                                        <div class="filter_tab_content">
                                            <div class="filter_label_val">
                                                <div class="filter_toggle_button">
                                                    <input type="checkbox" name="gender" id="gender1">
                                                    <label for="gender1">
                                                        Men
                                                        {{-- <span class="filter_items_count">(6)</span> --}}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="filter_label_val">
                                                <div class="filter_toggle_button">
                                                    <input type="checkbox" name="gender" id="gender2">
                                                    <label for="gender2">
                                                        Women
                                                        {{-- <span class="filter_items_count">(4)</span> --}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Colors -->
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

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="black">
                                                    <span class="color_circle" style="background:#000;"></span>
                                                    <span class="color_name">Black</span>
                                                </label>

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="white">
                                                    <span class="color_circle" style="background:#fff;"></span>
                                                    <span class="color_name">White</span>
                                                </label>

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="brown">
                                                    <span class="color_circle" style="background:#8B4513;"></span>
                                                    <span class="color_name">Brown</span>
                                                </label>

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="beige">
                                                    <span class="color_circle" style="background:#D8C3A5;"></span>
                                                    <span class="color_name">Beige</span>
                                                </label>

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="grey">
                                                    <span class="color_circle" style="background:#808080;"></span>
                                                    <span class="color_name">Grey</span>
                                                </label>

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="blue">
                                                    <span class="color_circle" style="background:#4169E1;"></span>
                                                    <span class="color_name">Blue</span>
                                                </label>

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="green">
                                                    <span class="color_circle" style="background:#228B22;"></span>
                                                    <span class="color_name">Green</span>
                                                </label>

                                                <label class="color_option">
                                                    <input type="checkbox" name="color[]" value="red">
                                                    <span class="color_circle" style="background:#C0392B;"></span>
                                                    <span class="color_name">Red</span>
                                                </label>

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
                            <span class="tracking-count"><b>Total</b> (100 Products)</span>
                            <div class="sort_by_wrapper">
                                <span class="sort_by_label">Sort By :</span>

                                <div class="sort_select_box">
                                    <select name="sort_by" id="sortBy">
                                        <option value="recommended">Recommended</option>
                                        <option value="newest">Newest</option>
                                        <option value="price_low_high">Price: Low to High</option>
                                        <option value="price_high_low">Price: High to Low</option>
                                        <option value="popular">Popular</option>
                                    </select>

                                    <span class="sort_arrow">
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="product-display-mode">
                                <div id="grid" class=""><a href="javascript:void(0);"
                                        title="2 Column"><span></span><span></span></a></div>
                                <div id="grid_large" class="active"><a href="javascript:void(0);"
                                        title="3 Column"><span></span><span></span><span></span></a></div>
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
        </script>

        <script>
            $(document).ready(function() {

                // Category open / close
                $('.category_arrow').on('click', function() {

                    $(this)
                        .closest('.filter_category')
                        .toggleClass('active');

                });


                // Sub category open / close
                $('.subcategory_arrow').on('click', function() {

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

                const minimumGap = 1000;


                function formatPrice(value) {
                    return Number(value).toLocaleString('en-IN');
                }


                function updatePriceText() {

                    minPriceText.textContent = formatPrice(minRange.value);
                    maxPriceText.textContent = formatPrice(maxRange.value);

                }


                // MIN RANGE
                minRange.addEventListener('input', function() {

                    if (
                        parseInt(maxRange.value) -
                        parseInt(minRange.value) <=
                        minimumGap
                    ) {

                        minRange.value =
                            parseInt(maxRange.value) - minimumGap;

                    }

                    minPrice.value = minRange.value;

                    updatePriceText();

                });


                // MAX RANGE
                maxRange.addEventListener('input', function() {

                    if (
                        parseInt(maxRange.value) -
                        parseInt(minRange.value) <=
                        minimumGap
                    ) {

                        maxRange.value =
                            parseInt(minRange.value) + minimumGap;

                    }

                    maxPrice.value = maxRange.value;

                    updatePriceText();

                });


                // MIN INPUT
                minPrice.addEventListener('input', function() {

                    let value = parseInt(this.value);

                    if (value < parseInt(minRange.min)) {
                        value = parseInt(minRange.min);
                    }

                    if (
                        value >
                        parseInt(maxRange.value) - minimumGap
                    ) {
                        value =
                            parseInt(maxRange.value) - minimumGap;
                    }

                    minRange.value = value;

                    updatePriceText();

                });


                // MAX INPUT
                maxPrice.addEventListener('input', function() {

                    let value = parseInt(this.value);

                    if (value > parseInt(maxRange.max)) {
                        value = parseInt(maxRange.max);
                    }

                    if (
                        value <
                        parseInt(minRange.value) + minimumGap
                    ) {
                        value =
                            parseInt(minRange.value) + minimumGap;
                    }

                    maxRange.value = value;

                    updatePriceText();

                });


                // RESET
                document.querySelector('.price_reset_btn')
                    .addEventListener('click', function() {

                        minRange.value = 1000;
                        maxRange.value = 100000;

                        minPrice.value = 1000;
                        maxPrice.value = 100000;

                        updatePriceText();

                    });


                updatePriceText();

            });
        </script>
        <!--content-wrapper -->
        </div>
        <!--container-->
    </section>
    <!--=====================================================
                                                                                                                                                        Site Section End
                                                                                                                                         =========================================================-->
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


    $(document).on('change', '.product-filter-select', function() {
        console.log('Filter changed');
        offset = 0;
        hasMore = true;
        loadProducts(true);

        function loadProducts(reset = false) {
            let categoryId = $('select[name="category_id"]').val();
            let subCategoryId = $('select[name="sub_category_id"]').val();
            let subChildCategoryId = $('select[name="sub_child_category_id"]').val();
            let color = $('select[name="variantValuesColor"]').val();
            let priceRange = $('select[name="price_range"]').val();
            let sortBy = $('select[name="sortBy"]').val();

            if (subChildCategoryId) {
                let subChildCategoryName = $('#sub_child_category_id option:selected').text();
                $('#pageTitle').text(subChildCategoryName);
            } else if (subCategoryId) {
                let subCategoryName = $('#sub_category_id option:selected').text();
                $('#pageTitle').text(subCategoryName);
            } else if (categoryId) {
                let categoryName = $('#category_id option:selected').text();
                $('#pageTitle').text(categoryName);
            }


            $.ajax({
                url: "{{ route('category.show', $slug) }}",
                type: "GET",

                data: {
                    category_id: categoryId,
                    sub_category_id: subCategoryId,
                    sub_child_category_id: subChildCategoryId,
                    variantValuesColor: color,
                    price_range: priceRange,
                    sortBy: sortBy,
                    offset: offset,
                    limit: 20
                },

                beforeSend: function() {
                    $('#productLoader').show();
                },

                success: function(response) {
                    console.log(response);
                    if (reset == true) {
                        $('#product-list').html(response.html);
                    } else {
                        $('#product-list').append(response.html);
                    }
                    hasMore = response.hasMore;
                    offset = response.nextOffset;
                },

                error: function(xhr) {
                    console.log(xhr.responseText);
                },

                complete: function() {
                    loading = false;
                    $('#productLoader').hide();
                }
            });
        }
    });
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

                    // if (!hasMore) {
                    //     $('#productLoader')
                    //         .html('No more products')
                    //         .show();
                    // }
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
