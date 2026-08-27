@extends('front.layouts.app')
@section('content')

<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner">
            <div class="container">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="{{ Url('/') }}" rel="home"><span itemprop="name">Home</span></a></li>
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
                    <div class="product-filter-outer">                           
                        <div class="product-filter-area">
                            <div class="product-filters">
                                <div class="product-filter dropdown">
                                    <select name="category_id" class="form-control product-filter-select" id="category_id" onchange="getSubCategory();">
                                        <option value="">Select Category</option>
                                        @foreach($AllMainCategory as $cat)
                                            <option value="{{ $cat->id }}" {{ $category->id == $cat->id ? "selected" : ""}}>{{ $cat->name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="product-filter dropdown">
                                    <select name="sub_category_id" class="form-control product-filter-select" id="sub_category_id" onchange="getSubChildCategory();">
                                        <option value="">Select Sub Category</option> 
                                    </select>
                                </div>
                                <div class="product-filter dropdown">
                                    <select name="sub_child_category_id" class="form-control product-filter-select" id="sub_child_category_id">
                                        <option value="">Select Sub Child Category</option>
                                    </select>
                                </div>
                                <div class="product-filter dropdown">
                                    <select name="variantValuesColor" class="form-control product-filter-select" id="variantValuesColor">
                                        <option value="">Select Variant Colors</option>
                                            @foreach($variantColor as $col)
                                                <option value="{{ $col->id }}">{{ $col->name }}</option>
                                            @endforeach 
                                    </select>
                                </div>
                                <div class="product-filter dropdown">
                                    <select name="price_range" class="form-control product-filter-select" id="price_range">
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
                                <div id="grid" class=""><a href="javascript:void(0);" title="3 Column"><span></span><span></span><span></span></a></div>
                                <div id="grid_large" class="active"><a href="javascript:void(0);" title="4 Column"><span></span><span></span><span></span><span></span></a></div>                                       
                            </div>    
                            </div>
                        </div> 
                    </div>
                    <div class="product-filter-overlay"></div> 
                    <div class="products-area">
                        <ul class="products column-4" id="product-list">
                            @include("front.modules.shop.load_more_data")
                        </ul>
                        <div id="productLoader" style="display:none; text-align:center;"></div>
                    </div>
                    <!-- products-are  -->
                </div>
            </div>
        </div>
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
        width: 20px; /* Forces icons to a normal size */
        height: 20px;
        display: inline-block;
    }

    nav[role="navigation"] div:last-child {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
    .text-sm, .text-gray-700, .leading-5, .dark:text-gray-400{
        padding:20px;
    }
</style>
<script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
<script>
    var url= "{{ route('front-get-category') }}"; 
    function getSubCategory(){
        var parentId =$('select[name="category_id"]').val();
        $.ajax({
            url:url,
            data:{
                parentId:parentId,
            },
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success:function(response){
                $('#sub_category_id').empty(); 
                let s = new Option("Select Sub Category",""); 
                $('#sub_category_id').append(s);  
                response.forEach(function(item, index) {
                    let r = `<option value="${item.id}">${item.name}</option>`;
                    $('#sub_category_id').append(r);
                });
            },
            error:function(error){
                console.log(err); 
            }

        }); 
    }

    function getSubChildCategory(){
        var parentId =$('select[name="sub_category_id"]').val();
        $.ajax({
            url:url,
            data:{
                parentId:parentId,
            },
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success:function(response){
                console.log(response);
                $('#sub_child_category_id').empty(); 
                let s = new Option("Select Sub Category",""); 
                $('#sub_child_category_id').append(s);  
                response.forEach(function(item, index) {
                    let r = `<option value="${item.id}">${item.name}</option>`;
                    $('#sub_child_category_id').append(r);
                });
            },
            error:function(error){
                console.log(err); 
            }

        });
    }
    
    
    $(document).on('change', '.product-filter-select', function () {
    console.log('Filter changed');
    offset = 0;
    hasMore = true;
    loadProducts(true);

    function loadProducts(reset = false)
    {
        let categoryId = $('select[name="category_id"]').val();
        let subCategoryId = $('select[name="sub_category_id"]').val();
        let subChildCategoryId = $('select[name="sub_child_category_id"]').val();
        let color = $('select[name="variantValuesColor"]').val();
        let priceRange = $('select[name="price_range"]').val();
        let sortBy = $('select[name="sortBy"]').val();
        
        if(subChildCategoryId){
            let subChildCategoryName = $('#sub_child_category_id option:selected').text();
            $('#pageTitle').text(subChildCategoryName);
        }else if (subCategoryId) {
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
                sub_child_category_id:subChildCategoryId,
                variantValuesColor: color,
                price_range: priceRange,
                sortBy: sortBy,
                offset: offset,
                limit: 20
            },

            beforeSend: function () {
                $('#productLoader').show();
            },

            success: function (response) {
                console.log(response); 
                if (reset == true) {
                    $('#product-list').html(response.html);
                } else {
                    $('#product-list').append(response.html);
                }
                hasMore = response.hasMore;
                offset = response.nextOffset;
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            },

            complete: function () {
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

window.addEventListener('scroll', function () {

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

            beforeSend: function () {
                $('#productLoader').show();
            },
            success: function (response) {
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
            error: function (xhr) {
                console.log('AJAX ERROR:', xhr.status);
                console.log(xhr.responseText);
            },

            complete: function () {
                loading = false;
                if (hasMore) {
                    $('#productLoader').hide();
                }
            }
        });
    }

});

</script>

