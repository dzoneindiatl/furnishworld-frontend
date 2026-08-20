<div class="your-orders">
    <ul class="nav tabs-coustom nav-tabs" id="orderTabs" role="tablist">
        <!--<li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-1-btn" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                role="tab">Order Items</button>
        </li>-->
        @if ($orderDetails->status == 2)
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-5-btn" data-bs-toggle="tab" data-bs-target="#tab-5" type="button"
                    role="tab">Cancelled Order</button>
            </li>
        @endif
        @if ($orderDetails->status == 6)
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-6-btn" data-bs-toggle="tab" data-bs-target="#tab-6" type="button"
                    role="tab">Returned Requested</button>
            </li>
        @endif
    </ul> 

    <ul class="nav tabs-coustom nav-tabs" id="orderTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-1-btn" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                role="tab">All Order Items</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-2-btn" data-bs-toggle="tab" data-bs-target="#tab-2" type="button"
                role="tab">Cancelled Order Items</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-3-btn" data-bs-toggle="tab" data-bs-target="#tab-3" type="button"
                role="tab">Delievered Order Items</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-4-btn" data-bs-toggle="tab" data-bs-target="#tab-4" type="button"
                role="tab">Refunded Order Items</button>
        </li>
    </ul>

    <input type="hidden" id="ordernumber" value="{{ $orderDetails->order_number }}">
    
    <div class="tab-content" id="orderTabsContent">
        <!-- All Orders -->
        <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
            <div class="order-tab-content" id="current-order-tab">
                <div class="order-details">
                    <a href="javascript:void" class="back-to-order" id="current_order_back">
                        <i class="fa-solid fa-chevron-left"></i> Back to order list
                    </a>
                    <div class="order-detail-head">
                        <h3>Order Details</h3>
                        <span>Placed On: {{ $orderDetails->created_at->format('M d, Y') }}</span>
                        <span>Order Number: {{ $orderDetails->order_number }}</span>
                        <a href="javascript:void(0);" class="btn btn-info btn-sm print-invoice-btn"
                            data-id="{{ $orderDetails->id }}" title="Generate Invoice"><i
                                class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                    </div>
                    <hr>
                    <div class="estimate-process">
                        <ul class="process-step-list" id="status_list_{{ $orderDetails->order_number }}"></ul>

                    </div>
                    <input type="checkbox" class="print-checkbox-select-all">
                    <ul class="order-product-list">
                        @php
                            $cancelRequest = orderCancellationRequest($orderDetails->id);
                            $refundRequest = orderRefundRequest($orderDetails->id);
                        @endphp
                        @foreach ($orderItems as $order)
                            @php
                                $combination = json_decode($order->combination);
                                $variantId = \App\Models\VariantValue::where(
                                    'name',
                                    'like',
                                    '%' . reset($combination) . '%',
                                )->value('id');
                                $img =
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)
                                        ->where('variant_id', $variantId)
                                        ->value('graphic') ??
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)->value(
                                        'graphic',
                                    );
                                $combinationData = '';
                                foreach ($combination as $key => $data) {
                                    $key = ucfirst($key);
                                    $combinationData .= "<p class='c-color'>$key: $data</p>";
                                }
                                $price = $order->selling_price * $order->qty;
                                $isCancelRequested = !empty($cancelRequest[$order->id])
                                    ? (array) $cancelRequest[$order->id]
                                    : [];
                                $isRefundRequested = !empty($refundRequest[$order->id])
                                    ? (array) $refundRequest[$order->id]
                                    : [];
                                //prx($isCancelRequested);
                            @endphp

                            <li>
                                <div class="border-box mb-4 product-info">
                                    <div class="product-detail-content d-block">
                                        <div class="pdc-left d-flex">
                                            <figure>
                                                <input type="checkbox" data-id="{{ $order->id }}"
                                                    class="print-checkbox">
                                                <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <img src="{{ url('uploads/products/' . $img) }}" /></a>
                                            </figure>
                                            <figcaption>
                                                <h4><a
                                                        href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                        {{ $order->product->name ?? 'N/A' }}</a></h4>
                                                <div class="product-cs">{!! $combinationData !!}</div>
                                                <p class="QTY">QTY: {{ $order->qty }}</p>
                                                <div class="price-tag"><span>₹{{ $price }}</span></div>
                                            </figcaption>

                                            <div>
                                                <div class="cancle_item_button mb-2">
                                                    <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <button type="button" class="btn btn-info buy_again">
                                                        Buy Again
                                                    </button>
                                                    </a>
                                                    <button type="button" class="btn btn-primary write_review_item" data-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#write_review_product_item">
                                                        Write Review
                                                    </button>
                                                </div>
                                                
                                                @if ($order->status == 'cancelled' && empty($isCancelRequested))
                                                    @php
                                                        $statusInfo = $order?->statusHistoriesItem?->firstWhere(
                                                            'order_status_id',
                                                            $order->order_status_id,
                                                        );
                                                    @endphp
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            Cancelled by Seller
                                                        </button>
                                                        @if (!empty($statusInfo->remark))
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $statusInfo->remark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if (
                                                    ($order->status == 'pending' || $order->status == 'accepted' || $order->status == 'processing') &&
                                                        empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                            data-id="{{ $order->id }}">
                                                            Cancel Order
                                                        </button>
                                                    </div>
                                                @endif
                                                @if (!empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isCancelRequested['status'] == 0)
                                                                Cancel Requested
                                                            @elseif($isCancelRequested['status'] == 1)
                                                                Cancelled
                                                            @elseif($isCancelRequested['status'] == 2)
                                                                Cancel Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isCancelRequested))
                                                            @php
                                                                $cancelRemark = "Your Remark: {$isCancelRequested['reason']}";
                                                                if (!empty($isCancelRequested['admin_remark'])) {
                                                                    $cancelRemark .= "<hr class='m-1'>Admin Remark: {$isCancelRequested['admin_remark']}";
                                                                    $cancelRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isCancelRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $cancelRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if (!empty($isRefundRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isRefundRequested['status'] == 0)
                                                                Return Requested
                                                            @elseif($isRefundRequested['status'] == 1)
                                                                Return Accepted
                                                            @elseif($isRefundRequested['status'] == 2)
                                                                Return Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isRefundRequested))
                                                            @php
                                                                $returnRemark = "Your Remark: {$isRefundRequested['refund_reason']}";
                                                                if (!empty($isRefundRequested['admin_remark'])) {
                                                                    $returnRemark .= "<hr class='m-1'>Admin Remark: {$isRefundRequested['admin_remark']}";
                                                                    $returnRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isRefundRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-html="true"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ $returnRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if ($order->status == 'delivered')
                                                    @if (empty($isRefundRequested))
                                                        <div class="cancle_item_button mb-2">
                                                            <button type="button"
                                                                class="btn btn-danger return-request-btn-data"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#returnRequestModal"
                                                                data-id="{{ $order->id }}">
                                                                Return Request
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <!-- <ul class="process-step-list">
                                            @foreach ($allStatuses as $index => $status)
                                                @php 
                                                    $slug = $status->slug;
                                                    $completedStatuses = collect($order->statusHistoriesItem)
                                                        ->pluck('orderStatus.slug')
                                                        ->toArray();

                                                    $delivered = in_array('delivered', $completedStatuses);
                                                    $cancelled = in_array('cancelled', $completedStatuses);
                                                    $isReturnFlow = in_array($slug, [
                                                        'return-requested',
                                                        'return-accepted',
                                                        'refund-pending',
                                                        'refunded',
                                                    ]);

                                                    if (
                                                        $isReturnFlow &&
                                                        (!$delivered || !in_array($slug, $completedStatuses))
                                                    ) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && !$cancelled) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && $delivered) {
                                                        continue;
                                                    }

                                                    if (
                                                        $cancelled &&
                                                        $slug !== 'cancelled' &&
                                                        !in_array($slug, $completedStatuses)
                                                    ) {
                                                        continue;
                                                    }

                                                    $isCompleted = in_array($slug, $completedStatuses);
                                                    $class = $isCompleted ? 'active' : '';
                                                    $textColorClass = '';
                                                    $extraClass = '';

                                                    if ($slug === 'cancelled' && $isCompleted) {
                                                        $extraClass = 'cancelled';
                                                        $textColorClass = 'text-danger';
                                                    }
                                                @endphp

                                                <li class="{{ $class }} {{ $extraClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>

                                                @if ($slug === 'cancelled' && $isCompleted)
                                                    @break
                                                @endif

                                                @if ($slug === 'delivered' && $isCompleted)
                                                    @php
                                                        $hasCompletedReturn = collect([
                                                            'return-requested',
                                                            'return-accepted',
                                                            'refund-pending',
                                                            'refunded',
                                                        ])
                                                            ->intersect($completedStatuses)
                                                            ->isNotEmpty();
                                                    @endphp
                                                    @if (!$hasCompletedReturn)
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>  -->
                                        
                                        <ul class="process-step-list">
                                            @php $textColorClass = 'active'; @endphp
                                            @foreach ($allStatuses as $index => $status)
                                                <li class="{{ $textColorClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>
                                                 @php 
                                                    $slug = $status->slug;
                                                    $order_status = $order->status;
                                                    if($slug==$order_status){
                                                        $textColorClass = '';
                                                    }
                                                @endphp
                                            @endforeach
                                        </ul>

                                    </div>
                                    @if ($order->status != 'delivered')
                                        @if (!empty($order->courier->tracking_url) && !empty($order->awb_number))
                                            <div class="mt-3">
                                                <hr>
                                                <div class="mt-3 d-flex justify-content-between">
                                                    <p>Traking
                                                        Link: <strong><a href="{{ $order->courier->tracking_url }}"
                                                                target="_blank">
                                                                {{ $order->courier->tracking_url }}</a></strong>
                                                    </p>

                                                    <p>Traking
                                                        Number: <strong>{{ $order->awb_number }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                            </li>
                        @endforeach
                    </ul>


                    @php
                        $billing = json_decode($orderDetails->billing_address);
                        $shipping = json_decode($orderDetails->shipping_address);
                    @endphp

                    <div class="total-bill-sec ordersummary col-md-5 pb-3 mt-3">
                        <h3>Order Summary</h3>
                        <ul class="total-list">
                            <li><span>Subtotal</span>
                                <p>₹{{ $orderDetails->sub_total }}</p>
                            </li>
                            <li><span>Shipping</span>
                                <p class="text-green">₹0.00</p>
                            </li>

                            <li><span>Coupon Discount</span>
                                <p class="text-green">₹ {{ $orderDetails->coupon_discount }} </p>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li><span><b>Grand Total</b></span>
                                <p><b>₹{{ $orderDetails->total }}</b></p>
                            </li>
                        </ul>
                    </div>

                    <hr>
                    <div class="address-box">
                        <div class="shipping-address">
                            <h6>SHIPPING ADDRESS</h6>
                            <h2>{{ $shipping->shipping_customer_name ?? '' }}</h2>
                            <p>{{ $shipping->shipping_address ?? '' }}</p>
                            <p>{{ $shipping->shipping_city ?? '' }}, {{ $shipping->shipping_state ?? '' }},
                                {{ $shipping->shipping_country ?? '' }} - {{ $shipping->shipping_pincode ?? '' }}</p>
                            <br>
                            <p>{{ $shipping->shipping_email ?? '' }}</p>
                            <p>{{ $shipping->shipping_phone ?? '' }}</p>
                        </div>
                        <div class="billing-address">
                            <h6>BILLING ADDRESS</h6>
                            <h2>{{ $billing->billing_customer_name ?? '' }}</h2>
                            <p>{{ $billing->billing_address ?? '' }}</p>
                            <p>{{ $billing->billing_city ?? '' }}, {{ $billing->billing_state ?? '' }},
                                {{ $billing->billing_country ?? '' }} - {{ $billing->billing_pincode ?? '' }}</p><br>
                            <p>{{ $billing->billing_email ?? '' }}</p>
                            <p>{{ $billing->billing_phone ?? '' }}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="payment-method-box">
                        <div class="pm-left">
                            <span>PAYMENT METHOD</span>
                            <p>{{ $paymentMode }}</p>
                        </div>
                        <div class="pm-right">
                            <span>SHIPPING METHOD</span>
                            <p>Free Shipping - Free Shipping</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- All Orders -->

        <!-- Cancelled Orders -->
        <div class="tab-pane fade show active" id="tab-2" role="tabpanel">
            <div class="order-tab-content" id="current-order-tab">
                <div class="order-details">
                    <a href="javascript:void" class="back-to-order" id="current_order_back">
                        <i class="fa-solid fa-chevron-left"></i> Back to order list
                    </a>
                    <div class="order-detail-head">
                        <h3>Order Details</h3>
                        <span>Placed On: {{ $orderDetails->created_at->format('M d, Y') }}</span>
                        <span>Order Number: {{ $orderDetails->order_number }}</span>
                        <a href="javascript:void(0);" class="btn btn-info btn-sm print-invoice-btn"
                            data-id="{{ $orderDetails->id }}" title="Generate Invoice"><i
                                class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                    </div>
                    <hr>
                    <div class="estimate-process">
                        <ul class="process-step-list" id="status_list_{{ $orderDetails->order_number }}"></ul>

                    </div>
                    <input type="checkbox" class="print-checkbox-select-all">
                    <ul class="order-product-list">
                        @php
                            $cancelRequest = orderCancellationRequest($orderDetails->id);
                            $refundRequest = orderRefundRequest($orderDetails->id);
                        @endphp
                        @foreach ($orderItemsCancelled as $order)
                            @php
                                $combination = json_decode($order->combination);
                                $variantId = \App\Models\VariantValue::where(
                                    'name',
                                    'like',
                                    '%' . reset($combination) . '%',
                                )->value('id');
                                $img =
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)
                                        ->where('variant_id', $variantId)
                                        ->value('graphic') ??
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)->value(
                                        'graphic',
                                    );
                                $combinationData = '';
                                foreach ($combination as $key => $data) {
                                    $key = ucfirst($key);
                                    $combinationData .= "<p class='c-color'>$key: $data</p>";
                                }
                                $price = $order->selling_price * $order->qty;
                                $isCancelRequested = !empty($cancelRequest[$order->id])
                                    ? (array) $cancelRequest[$order->id]
                                    : [];
                                $isRefundRequested = !empty($refundRequest[$order->id])
                                    ? (array) $refundRequest[$order->id]
                                    : [];
                                //prx($isCancelRequested);
                            @endphp

                            <li>
                                <div class="border-box mb-4 product-info">
                                    <div class="product-detail-content d-block">
                                        <div class="pdc-left d-flex">
                                            <figure>
                                                <input type="checkbox" data-id="{{ $order->id }}"
                                                    class="print-checkbox">
                                                <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <img src="{{ url('uploads/products/' . $img) }}" /></a>
                                            </figure>
                                            <figcaption>
                                                <h4><a
                                                        href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                        {{ $order->product->name ?? 'N/A' }}</a></h4>
                                                <div class="product-cs">{!! $combinationData !!}</div>
                                                <p class="QTY">QTY: {{ $order->qty }}</p>
                                                <div class="price-tag"><span>₹{{ $price }}</span></div>
                                            </figcaption>

                                            <div>
                                                <div class="cancle_item_button mb-2">
                                                    <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <button type="button" class="btn btn-info buy_again">
                                                        Buy Again
                                                    </button>
                                                    </a>
                                                    <button type="button" class="btn btn-primary write_review_item" data-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#write_review_product_item">
                                                        Write Review
                                                    </button>
                                                </div>
                                                
                                                @if ($order->status == 'cancelled' && empty($isCancelRequested))
                                                    @php
                                                        $statusInfo = $order?->statusHistoriesItem?->firstWhere(
                                                            'order_status_id',
                                                            $order->order_status_id,
                                                        );
                                                    @endphp
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            Cancelled by Seller
                                                        </button>
                                                        @if (!empty($statusInfo->remark))
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $statusInfo->remark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if (
                                                    ($order->status == 'pending' || $order->status == 'accepted' || $order->status == 'processing') &&
                                                        empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                            data-id="{{ $order->id }}">
                                                            Cancel Order
                                                        </button>
                                                    </div>
                                                @endif
                                                @if (!empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isCancelRequested['status'] == 0)
                                                                Cancel Requested
                                                            @elseif($isCancelRequested['status'] == 1)
                                                                Cancelled
                                                            @elseif($isCancelRequested['status'] == 2)
                                                                Cancel Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isCancelRequested))
                                                            @php
                                                                $cancelRemark = "Your Remark: {$isCancelRequested['reason']}";
                                                                if (!empty($isCancelRequested['admin_remark'])) {
                                                                    $cancelRemark .= "<hr class='m-1'>Admin Remark: {$isCancelRequested['admin_remark']}";
                                                                    $cancelRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isCancelRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $cancelRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if (!empty($isRefundRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isRefundRequested['status'] == 0)
                                                                Return Requested
                                                            @elseif($isRefundRequested['status'] == 1)
                                                                Return Accepted
                                                            @elseif($isRefundRequested['status'] == 2)
                                                                Return Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isRefundRequested))
                                                            @php
                                                                $returnRemark = "Your Remark: {$isRefundRequested['refund_reason']}";
                                                                if (!empty($isRefundRequested['admin_remark'])) {
                                                                    $returnRemark .= "<hr class='m-1'>Admin Remark: {$isRefundRequested['admin_remark']}";
                                                                    $returnRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isRefundRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-html="true"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ $returnRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if ($order->status == 'delivered')
                                                    @if (empty($isRefundRequested))
                                                        <div class="cancle_item_button mb-2">
                                                            <button type="button"
                                                                class="btn btn-danger return-request-btn-data"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#returnRequestModal"
                                                                data-id="{{ $order->id }}">
                                                                Return Request
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <!-- <ul class="process-step-list">
                                            @foreach ($allStatuses as $index => $status)
                                                @php 
                                                    $slug = $status->slug;
                                                    $completedStatuses = collect($order->statusHistoriesItem)
                                                        ->pluck('orderStatus.slug')
                                                        ->toArray();

                                                    $delivered = in_array('delivered', $completedStatuses);
                                                    $cancelled = in_array('cancelled', $completedStatuses);
                                                    $isReturnFlow = in_array($slug, [
                                                        'return-requested',
                                                        'return-accepted',
                                                        'refund-pending',
                                                        'refunded',
                                                    ]);

                                                    if (
                                                        $isReturnFlow &&
                                                        (!$delivered || !in_array($slug, $completedStatuses))
                                                    ) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && !$cancelled) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && $delivered) {
                                                        continue;
                                                    }

                                                    if (
                                                        $cancelled &&
                                                        $slug !== 'cancelled' &&
                                                        !in_array($slug, $completedStatuses)
                                                    ) {
                                                        continue;
                                                    }

                                                    $isCompleted = in_array($slug, $completedStatuses);
                                                    $class = $isCompleted ? 'active' : '';
                                                    $textColorClass = '';
                                                    $extraClass = '';

                                                    if ($slug === 'cancelled' && $isCompleted) {
                                                        $extraClass = 'cancelled';
                                                        $textColorClass = 'text-danger';
                                                    }
                                                @endphp

                                                <li class="{{ $class }} {{ $extraClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>

                                                @if ($slug === 'cancelled' && $isCompleted)
                                                    @break
                                                @endif

                                                @if ($slug === 'delivered' && $isCompleted)
                                                    @php
                                                        $hasCompletedReturn = collect([
                                                            'return-requested',
                                                            'return-accepted',
                                                            'refund-pending',
                                                            'refunded',
                                                        ])
                                                            ->intersect($completedStatuses)
                                                            ->isNotEmpty();
                                                    @endphp
                                                    @if (!$hasCompletedReturn)
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>  -->
                                        
                                        <ul class="process-step-list">
                                            @php $textColorClass = 'active'; @endphp
                                            @foreach ($allStatuses as $index => $status)
                                                <li class="{{ $textColorClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>
                                                 @php 
                                                    $slug = $status->slug;
                                                    $order_status = $order->status;
                                                    if($slug==$order_status){
                                                        $textColorClass = '';
                                                    }
                                                @endphp
                                            @endforeach
                                        </ul>

                                    </div>
                                    @if ($order->status != 'delivered')
                                        @if (!empty($order->courier->tracking_url) && !empty($order->awb_number))
                                            <div class="mt-3">
                                                <hr>
                                                <div class="mt-3 d-flex justify-content-between">
                                                    <p>Traking
                                                        Link: <strong><a href="{{ $order->courier->tracking_url }}"
                                                                target="_blank">
                                                                {{ $order->courier->tracking_url }}</a></strong>
                                                    </p>

                                                    <p>Traking
                                                        Number: <strong>{{ $order->awb_number }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                            </li>
                        @endforeach
                    </ul>


                    @php
                        $billing = json_decode($orderDetails->billing_address);
                        $shipping = json_decode($orderDetails->shipping_address);
                    @endphp

                    <div class="total-bill-sec ordersummary col-md-5 pb-3 mt-3">
                        <h3>Order Summary</h3>
                        <ul class="total-list">
                            <li><span>Subtotal</span>
                                <p>₹{{ $orderDetails->sub_total }}</p>
                            </li>
                            <li><span>Shipping</span>
                                <p class="text-green">₹0.00</p>
                            </li>

                            <li><span>Coupon Discount</span>
                                <p class="text-green">₹ {{ $orderDetails->coupon_discount }} </p>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li><span><b>Grand Total</b></span>
                                <p><b>₹{{ $orderDetails->total }}</b></p>
                            </li>
                        </ul>
                    </div>

                    <hr>
                    <div class="address-box">
                        <div class="shipping-address">
                            <h6>SHIPPING ADDRESS</h6>
                            <h2>{{ $shipping->shipping_customer_name ?? '' }}</h2>
                            <p>{{ $shipping->shipping_address ?? '' }}</p>
                            <p>{{ $shipping->shipping_city ?? '' }}, {{ $shipping->shipping_state ?? '' }},
                                {{ $shipping->shipping_country ?? '' }} - {{ $shipping->shipping_pincode ?? '' }}</p>
                            <br>
                            <p>{{ $shipping->shipping_email ?? '' }}</p>
                            <p>{{ $shipping->shipping_phone ?? '' }}</p>
                        </div>
                        <div class="billing-address">
                            <h6>BILLING ADDRESS</h6>
                            <h2>{{ $billing->billing_customer_name ?? '' }}</h2>
                            <p>{{ $billing->billing_address ?? '' }}</p>
                            <p>{{ $billing->billing_city ?? '' }}, {{ $billing->billing_state ?? '' }},
                                {{ $billing->billing_country ?? '' }} - {{ $billing->billing_pincode ?? '' }}</p><br>
                            <p>{{ $billing->billing_email ?? '' }}</p>
                            <p>{{ $billing->billing_phone ?? '' }}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="payment-method-box">
                        <div class="pm-left">
                            <span>PAYMENT METHOD</span>
                            <p>{{ $paymentMode }}</p>
                        </div>
                        <div class="pm-right">
                            <span>SHIPPING METHOD</span>
                            <p>Free Shipping - Free Shipping</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cancelled Orders -->

        <!-- Delivered Orders -->
        <div class="tab-pane fade show active" id="tab-3" role="tabpanel">
            <div class="order-tab-content" id="current-order-tab">
                <div class="order-details">
                    <a href="javascript:void" class="back-to-order" id="current_order_back">
                        <i class="fa-solid fa-chevron-left"></i> Back to order list
                    </a>
                    <div class="order-detail-head">
                        <h3>Order Details</h3>
                        <span>Placed On: {{ $orderDetails->created_at->format('M d, Y') }}</span>
                        <span>Order Number: {{ $orderDetails->order_number }}</span>
                        <a href="javascript:void(0);" class="btn btn-info btn-sm print-invoice-btn"
                            data-id="{{ $orderDetails->id }}" title="Generate Invoice"><i
                                class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                    </div>
                    <hr>
                    <div class="estimate-process">
                        <ul class="process-step-list" id="status_list_{{ $orderDetails->order_number }}"></ul>

                    </div>
                    <input type="checkbox" class="print-checkbox-select-all">
                    <ul class="order-product-list">
                        @php
                            $cancelRequest = orderCancellationRequest($orderDetails->id);
                            $refundRequest = orderRefundRequest($orderDetails->id);
                        @endphp
                        @foreach ($orderItemsDelivered as $order)
                            @php
                                $combination = json_decode($order->combination);
                                $variantId = \App\Models\VariantValue::where(
                                    'name',
                                    'like',
                                    '%' . reset($combination) . '%',
                                )->value('id');
                                $img =
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)
                                        ->where('variant_id', $variantId)
                                        ->value('graphic') ??
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)->value(
                                        'graphic',
                                    );
                                $combinationData = '';
                                foreach ($combination as $key => $data) {
                                    $key = ucfirst($key);
                                    $combinationData .= "<p class='c-color'>$key: $data</p>";
                                }
                                $price = $order->selling_price * $order->qty;
                                $isCancelRequested = !empty($cancelRequest[$order->id])
                                    ? (array) $cancelRequest[$order->id]
                                    : [];
                                $isRefundRequested = !empty($refundRequest[$order->id])
                                    ? (array) $refundRequest[$order->id]
                                    : [];
                                //prx($isCancelRequested);
                            @endphp

                            <li>
                                <div class="border-box mb-4 product-info">
                                    <div class="product-detail-content d-block">
                                        <div class="pdc-left d-flex">
                                            <figure>
                                                <input type="checkbox" data-id="{{ $order->id }}"
                                                    class="print-checkbox">
                                                <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <img src="{{ url('uploads/products/' . $img) }}" /></a>
                                            </figure>
                                            <figcaption>
                                                <h4><a
                                                        href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                        {{ $order->product->name ?? 'N/A' }}</a></h4>
                                                <div class="product-cs">{!! $combinationData !!}</div>
                                                <p class="QTY">QTY: {{ $order->qty }}</p>
                                                <div class="price-tag"><span>₹{{ $price }}</span></div>
                                            </figcaption>

                                            <div>
                                                <div class="cancle_item_button mb-2">
                                                    <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <button type="button" class="btn btn-info buy_again">
                                                        Buy Again
                                                    </button>
                                                    </a>
                                                    <button type="button" class="btn btn-primary write_review_item" data-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#write_review_product_item">
                                                        Write Review
                                                    </button>
                                                </div>
                                                
                                                @if ($order->status == 'cancelled' && empty($isCancelRequested))
                                                    @php
                                                        $statusInfo = $order?->statusHistoriesItem?->firstWhere(
                                                            'order_status_id',
                                                            $order->order_status_id,
                                                        );
                                                    @endphp
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            Cancelled by Seller
                                                        </button>
                                                        @if (!empty($statusInfo->remark))
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $statusInfo->remark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if (
                                                    ($order->status == 'pending' || $order->status == 'accepted' || $order->status == 'processing') &&
                                                        empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                            data-id="{{ $order->id }}">
                                                            Cancel Order
                                                        </button>
                                                    </div>
                                                @endif
                                                @if (!empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isCancelRequested['status'] == 0)
                                                                Cancel Requested
                                                            @elseif($isCancelRequested['status'] == 1)
                                                                Cancelled
                                                            @elseif($isCancelRequested['status'] == 2)
                                                                Cancel Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isCancelRequested))
                                                            @php
                                                                $cancelRemark = "Your Remark: {$isCancelRequested['reason']}";
                                                                if (!empty($isCancelRequested['admin_remark'])) {
                                                                    $cancelRemark .= "<hr class='m-1'>Admin Remark: {$isCancelRequested['admin_remark']}";
                                                                    $cancelRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isCancelRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $cancelRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if (!empty($isRefundRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isRefundRequested['status'] == 0)
                                                                Return Requested
                                                            @elseif($isRefundRequested['status'] == 1)
                                                                Return Accepted
                                                            @elseif($isRefundRequested['status'] == 2)
                                                                Return Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isRefundRequested))
                                                            @php
                                                                $returnRemark = "Your Remark: {$isRefundRequested['refund_reason']}";
                                                                if (!empty($isRefundRequested['admin_remark'])) {
                                                                    $returnRemark .= "<hr class='m-1'>Admin Remark: {$isRefundRequested['admin_remark']}";
                                                                    $returnRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isRefundRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-html="true"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ $returnRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if ($order->status == 'delivered')
                                                    @if (empty($isRefundRequested))
                                                        <div class="cancle_item_button mb-2">
                                                            <button type="button"
                                                                class="btn btn-danger return-request-btn-data"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#returnRequestModal"
                                                                data-id="{{ $order->id }}">
                                                                Return Request
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <!-- <ul class="process-step-list">
                                            @foreach ($allStatuses as $index => $status)
                                                @php 
                                                    $slug = $status->slug;
                                                    $completedStatuses = collect($order->statusHistoriesItem)
                                                        ->pluck('orderStatus.slug')
                                                        ->toArray();

                                                    $delivered = in_array('delivered', $completedStatuses);
                                                    $cancelled = in_array('cancelled', $completedStatuses);
                                                    $isReturnFlow = in_array($slug, [
                                                        'return-requested',
                                                        'return-accepted',
                                                        'refund-pending',
                                                        'refunded',
                                                    ]);

                                                    if (
                                                        $isReturnFlow &&
                                                        (!$delivered || !in_array($slug, $completedStatuses))
                                                    ) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && !$cancelled) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && $delivered) {
                                                        continue;
                                                    }

                                                    if (
                                                        $cancelled &&
                                                        $slug !== 'cancelled' &&
                                                        !in_array($slug, $completedStatuses)
                                                    ) {
                                                        continue;
                                                    }

                                                    $isCompleted = in_array($slug, $completedStatuses);
                                                    $class = $isCompleted ? 'active' : '';
                                                    $textColorClass = '';
                                                    $extraClass = '';

                                                    if ($slug === 'cancelled' && $isCompleted) {
                                                        $extraClass = 'cancelled';
                                                        $textColorClass = 'text-danger';
                                                    }
                                                @endphp

                                                <li class="{{ $class }} {{ $extraClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>

                                                @if ($slug === 'cancelled' && $isCompleted)
                                                    @break
                                                @endif

                                                @if ($slug === 'delivered' && $isCompleted)
                                                    @php
                                                        $hasCompletedReturn = collect([
                                                            'return-requested',
                                                            'return-accepted',
                                                            'refund-pending',
                                                            'refunded',
                                                        ])
                                                            ->intersect($completedStatuses)
                                                            ->isNotEmpty();
                                                    @endphp
                                                    @if (!$hasCompletedReturn)
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>  -->
                                        
                                        <ul class="process-step-list">
                                            @php $textColorClass = 'active'; @endphp
                                            @foreach ($allStatuses as $index => $status)
                                                <li class="{{ $textColorClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>
                                                 @php 
                                                    $slug = $status->slug;
                                                    $order_status = $order->status;
                                                    if($slug==$order_status){
                                                        $textColorClass = '';
                                                    }
                                                @endphp
                                            @endforeach
                                        </ul>

                                    </div>
                                    @if ($order->status != 'delivered')
                                        @if (!empty($order->courier->tracking_url) && !empty($order->awb_number))
                                            <div class="mt-3">
                                                <hr>
                                                <div class="mt-3 d-flex justify-content-between">
                                                    <p>Traking
                                                        Link: <strong><a href="{{ $order->courier->tracking_url }}"
                                                                target="_blank">
                                                                {{ $order->courier->tracking_url }}</a></strong>
                                                    </p>

                                                    <p>Traking
                                                        Number: <strong>{{ $order->awb_number }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                            </li>
                        @endforeach
                    </ul>


                    @php
                        $billing = json_decode($orderDetails->billing_address);
                        $shipping = json_decode($orderDetails->shipping_address);
                    @endphp

                    <div class="total-bill-sec ordersummary col-md-5 pb-3 mt-3">
                        <h3>Order Summary</h3>
                        <ul class="total-list">
                            <li><span>Subtotal</span>
                                <p>₹{{ $orderDetails->sub_total }}</p>
                            </li>
                            <li><span>Shipping</span>
                                <p class="text-green">₹0.00</p>
                            </li>

                            <li><span>Coupon Discount</span>
                                <p class="text-green">₹ {{ $orderDetails->coupon_discount }} </p>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li><span><b>Grand Total</b></span>
                                <p><b>₹{{ $orderDetails->total }}</b></p>
                            </li>
                        </ul>
                    </div>

                    <hr>
                    <div class="address-box">
                        <div class="shipping-address">
                            <h6>SHIPPING ADDRESS</h6>
                            <h2>{{ $shipping->shipping_customer_name ?? '' }}</h2>
                            <p>{{ $shipping->shipping_address ?? '' }}</p>
                            <p>{{ $shipping->shipping_city ?? '' }}, {{ $shipping->shipping_state ?? '' }},
                                {{ $shipping->shipping_country ?? '' }} - {{ $shipping->shipping_pincode ?? '' }}</p>
                            <br>
                            <p>{{ $shipping->shipping_email ?? '' }}</p>
                            <p>{{ $shipping->shipping_phone ?? '' }}</p>
                        </div>
                        <div class="billing-address">
                            <h6>BILLING ADDRESS</h6>
                            <h2>{{ $billing->billing_customer_name ?? '' }}</h2>
                            <p>{{ $billing->billing_address ?? '' }}</p>
                            <p>{{ $billing->billing_city ?? '' }}, {{ $billing->billing_state ?? '' }},
                                {{ $billing->billing_country ?? '' }} - {{ $billing->billing_pincode ?? '' }}</p><br>
                            <p>{{ $billing->billing_email ?? '' }}</p>
                            <p>{{ $billing->billing_phone ?? '' }}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="payment-method-box">
                        <div class="pm-left">
                            <span>PAYMENT METHOD</span>
                            <p>{{ $paymentMode }}</p>
                        </div>
                        <div class="pm-right">
                            <span>SHIPPING METHOD</span>
                            <p>Free Shipping - Free Shipping</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delivered Orders -->

        <!-- Refunded Orders Items -->
        <div class="tab-pane fade show active" id="tab-4" role="tabpanel">
            <div class="order-tab-content" id="current-order-tab">
                <div class="order-details">
                    <a href="javascript:void" class="back-to-order" id="current_order_back">
                        <i class="fa-solid fa-chevron-left"></i> Back to order list
                    </a>
                    <div class="order-detail-head">
                        <h3>Order Details</h3>
                        <span>Placed On: {{ $orderDetails->created_at->format('M d, Y') }}</span>
                        <span>Order Number: {{ $orderDetails->order_number }}</span>
                        <a href="javascript:void(0);" class="btn btn-info btn-sm print-invoice-btn"
                            data-id="{{ $orderDetails->id }}" title="Generate Invoice"><i
                                class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                    </div>
                    <hr>
                    <div class="estimate-process">
                        <ul class="process-step-list" id="status_list_{{ $orderDetails->order_number }}"></ul>

                    </div>
                    <input type="checkbox" class="print-checkbox-select-all">
                    <ul class="order-product-list">
                        @php
                            $cancelRequest = orderCancellationRequest($orderDetails->id);
                            $refundRequest = orderRefundRequest($orderDetails->id);
                        @endphp
                        @foreach ($orderItemsRefunded as $order)
                            @php
                                $combination = json_decode($order->combination);
                                $variantId = \App\Models\VariantValue::where(
                                    'name',
                                    'like',
                                    '%' . reset($combination) . '%',
                                )->value('id');
                                $img =
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)
                                        ->where('variant_id', $variantId)
                                        ->value('graphic') ??
                                    \App\Models\ProductGraphics::where('product_id', $order->product_id)->value(
                                        'graphic',
                                    );
                                $combinationData = '';
                                foreach ($combination as $key => $data) {
                                    $key = ucfirst($key);
                                    $combinationData .= "<p class='c-color'>$key: $data</p>";
                                }
                                $price = $order->selling_price * $order->qty;
                                $isCancelRequested = !empty($cancelRequest[$order->id])
                                    ? (array) $cancelRequest[$order->id]
                                    : [];
                                $isRefundRequested = !empty($refundRequest[$order->id])
                                    ? (array) $refundRequest[$order->id]
                                    : [];
                                //prx($isCancelRequested);
                            @endphp

                            <li>
                                <div class="border-box mb-4 product-info">
                                    <div class="product-detail-content d-block">
                                        <div class="pdc-left d-flex">
                                            <figure>
                                                <input type="checkbox" data-id="{{ $order->id }}"
                                                    class="print-checkbox">
                                                <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <img src="{{ url('uploads/products/' . $img) }}" /></a>
                                            </figure>
                                            <figcaption>
                                                <h4><a
                                                        href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                        {{ $order->product->name ?? 'N/A' }}</a></h4>
                                                <div class="product-cs">{!! $combinationData !!}</div>
                                                <p class="QTY">QTY: {{ $order->qty }}</p>
                                                <div class="price-tag"><span>₹{{ $price }}</span></div>
                                            </figcaption>

                                            <div>
                                                <div class="cancle_item_button mb-2">
                                                    <a
                                                    href="{{ route('front-product-detail', ['product' => 'product','title' =>productSlug($order->product->name).'.html', 'sku' => productSlug($order->product->sku)]) }}">
                                                    <button type="button" class="btn btn-info buy_again">
                                                        Buy Again
                                                    </button>
                                                    </a>
                                                    <button type="button" class="btn btn-primary write_review_item" data-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#write_review_product_item">
                                                        Write Review
                                                    </button>
                                                </div>
                                                
                                                @if ($order->status == 'cancelled' && empty($isCancelRequested))
                                                    @php
                                                        $statusInfo = $order?->statusHistoriesItem?->firstWhere(
                                                            'order_status_id',
                                                            $order->order_status_id,
                                                        );
                                                    @endphp
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            Cancelled by Seller
                                                        </button>
                                                        @if (!empty($statusInfo->remark))
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $statusInfo->remark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if (
                                                    ($order->status == 'pending' || $order->status == 'accepted' || $order->status == 'processing') &&
                                                        empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                            data-id="{{ $order->id }}">
                                                            Cancel Order
                                                        </button>
                                                    </div>
                                                @endif
                                                @if (!empty($isCancelRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isCancelRequested['status'] == 0)
                                                                Cancel Requested
                                                            @elseif($isCancelRequested['status'] == 1)
                                                                Cancelled
                                                            @elseif($isCancelRequested['status'] == 2)
                                                                Cancel Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isCancelRequested))
                                                            @php
                                                                $cancelRemark = "Your Remark: {$isCancelRequested['reason']}";
                                                                if (!empty($isCancelRequested['admin_remark'])) {
                                                                    $cancelRemark .= "<hr class='m-1'>Admin Remark: {$isCancelRequested['admin_remark']}";
                                                                    $cancelRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isCancelRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-html="true"
                                                                title="Admin Remark: {{ $cancelRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if (!empty($isRefundRequested))
                                                    <div class="cancle_item_button mb-2">
                                                        <button type="button" class="btn btn-danger cancel-btn-data"
                                                            disabled>
                                                            @if ($isRefundRequested['status'] == 0)
                                                                Return Requested
                                                            @elseif($isRefundRequested['status'] == 1)
                                                                Return Accepted
                                                            @elseif($isRefundRequested['status'] == 2)
                                                                Return Rejected
                                                            @endif
                                                        </button>
                                                        @if (!empty($isRefundRequested))
                                                            @php
                                                                $returnRemark = "Your Remark: {$isRefundRequested['refund_reason']}";
                                                                if (!empty($isRefundRequested['admin_remark'])) {
                                                                    $returnRemark .= "<hr class='m-1'>Admin Remark: {$isRefundRequested['admin_remark']}";
                                                                    $returnRemark .=
                                                                        "<hr class='m-1'>Updated on: " .
                                                                        date(
                                                                            'd M, Y h:i a',
                                                                            strtotime($isRefundRequested['updated_at']),
                                                                        );
                                                                }
                                                            @endphp
                                                            <i class="fa fa-info-circle" data-bs-html="true"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ $returnRemark }}"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if ($order->status == 'delivered')
                                                    @if (empty($isRefundRequested))
                                                        <div class="cancle_item_button mb-2">
                                                            <button type="button"
                                                                class="btn btn-danger return-request-btn-data"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#returnRequestModal"
                                                                data-id="{{ $order->id }}">
                                                                Return Request
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-3 d-flex justify-content-end">
                                        <!-- <ul class="process-step-list">
                                            @foreach ($allStatuses as $index => $status)
                                                @php 
                                                    $slug = $status->slug;
                                                    $completedStatuses = collect($order->statusHistoriesItem)
                                                        ->pluck('orderStatus.slug')
                                                        ->toArray();

                                                    $delivered = in_array('delivered', $completedStatuses);
                                                    $cancelled = in_array('cancelled', $completedStatuses);
                                                    $isReturnFlow = in_array($slug, [
                                                        'return-requested',
                                                        'return-accepted',
                                                        'refund-pending',
                                                        'refunded',
                                                    ]);

                                                    if (
                                                        $isReturnFlow &&
                                                        (!$delivered || !in_array($slug, $completedStatuses))
                                                    ) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && !$cancelled) {
                                                        continue;
                                                    }

                                                    if ($slug === 'cancelled' && $delivered) {
                                                        continue;
                                                    }

                                                    if (
                                                        $cancelled &&
                                                        $slug !== 'cancelled' &&
                                                        !in_array($slug, $completedStatuses)
                                                    ) {
                                                        continue;
                                                    }

                                                    $isCompleted = in_array($slug, $completedStatuses);
                                                    $class = $isCompleted ? 'active' : '';
                                                    $textColorClass = '';
                                                    $extraClass = '';

                                                    if ($slug === 'cancelled' && $isCompleted) {
                                                        $extraClass = 'cancelled';
                                                        $textColorClass = 'text-danger';
                                                    }
                                                @endphp

                                                <li class="{{ $class }} {{ $extraClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>

                                                @if ($slug === 'cancelled' && $isCompleted)
                                                    @break
                                                @endif

                                                @if ($slug === 'delivered' && $isCompleted)
                                                    @php
                                                        $hasCompletedReturn = collect([
                                                            'return-requested',
                                                            'return-accepted',
                                                            'refund-pending',
                                                            'refunded',
                                                        ])
                                                            ->intersect($completedStatuses)
                                                            ->isNotEmpty();
                                                    @endphp
                                                    @if (!$hasCompletedReturn)
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>  -->
                                        
                                        <ul class="process-step-list">
                                            @php $textColorClass = 'active'; @endphp
                                            @foreach ($allStatuses as $index => $status)
                                                <li class="{{ $textColorClass }}">
                                                    <span><i class="{{ $status->icon }}"></i></span>
                                                    <p class="{{ $textColorClass }}">{{ $status->name }}</p>
                                                </li>
                                                 @php 
                                                    $slug = $status->slug;
                                                    $order_status = $order->status;
                                                    if($slug==$order_status){
                                                        $textColorClass = '';
                                                    }
                                                @endphp
                                            @endforeach
                                        </ul>

                                    </div>
                                    @if ($order->status != 'delivered')
                                        @if (!empty($order->courier->tracking_url) && !empty($order->awb_number))
                                            <div class="mt-3">
                                                <hr>
                                                <div class="mt-3 d-flex justify-content-between">
                                                    <p>Traking
                                                        Link: <strong><a href="{{ $order->courier->tracking_url }}"
                                                                target="_blank">
                                                                {{ $order->courier->tracking_url }}</a></strong>
                                                    </p>

                                                    <p>Traking
                                                        Number: <strong>{{ $order->awb_number }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                            </li>
                        @endforeach
                    </ul>


                    @php
                        $billing = json_decode($orderDetails->billing_address);
                        $shipping = json_decode($orderDetails->shipping_address);
                    @endphp

                    <div class="total-bill-sec ordersummary col-md-5 pb-3 mt-3">
                        <h3>Order Summary</h3>
                        <ul class="total-list">
                            <li><span>Subtotal</span>
                                <p>₹{{ $orderDetails->sub_total }}</p>
                            </li>
                            <li><span>Shipping</span>
                                <p class="text-green">₹0.00</p>
                            </li>

                            <li><span>Coupon Discount</span>
                                <p class="text-green">₹ {{ $orderDetails->coupon_discount }} </p>
                            </li>
                            <li>
                                <hr>
                            </li>
                            <li><span><b>Grand Total</b></span>
                                <p><b>₹{{ $orderDetails->total }}</b></p>
                            </li>
                        </ul>
                    </div>

                    <hr>
                    <div class="address-box">
                        <div class="shipping-address">
                            <h6>SHIPPING ADDRESS</h6>
                            <h2>{{ $shipping->shipping_customer_name ?? '' }}</h2>
                            <p>{{ $shipping->shipping_address ?? '' }}</p>
                            <p>{{ $shipping->shipping_city ?? '' }}, {{ $shipping->shipping_state ?? '' }},
                                {{ $shipping->shipping_country ?? '' }} - {{ $shipping->shipping_pincode ?? '' }}</p>
                            <br>
                            <p>{{ $shipping->shipping_email ?? '' }}</p>
                            <p>{{ $shipping->shipping_phone ?? '' }}</p>
                        </div>
                        <div class="billing-address">
                            <h6>BILLING ADDRESS</h6>
                            <h2>{{ $billing->billing_customer_name ?? '' }}</h2>
                            <p>{{ $billing->billing_address ?? '' }}</p>
                            <p>{{ $billing->billing_city ?? '' }}, {{ $billing->billing_state ?? '' }},
                                {{ $billing->billing_country ?? '' }} - {{ $billing->billing_pincode ?? '' }}</p><br>
                            <p>{{ $billing->billing_email ?? '' }}</p>
                            <p>{{ $billing->billing_phone ?? '' }}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="payment-method-box">
                        <div class="pm-left">
                            <span>PAYMENT METHOD</span>
                            <p>{{ $paymentMode }}</p>
                        </div>
                        <div class="pm-right">
                            <span>SHIPPING METHOD</span>
                            <p>Free Shipping - Free Shipping</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Refunded Orders Items -->

        <!-- Cancelled Model Ppup -->
        <div class="modal fade" id="cancelOrderModalLabel" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelOrderModalLabel">Cancel Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="cancel_order_form" method="POST" class="validationForm" autocomplete="off">

                            <div class="form-group has-value mb-3">
                                <label>Cancel order with reason <span class="error required">*</span></label>
                                <select class="form-control" id="cancel_reason_select" name="cancel_reason" required>
                                    <option value="" selected disabled>Select Reason</option>
                                    <option value="Ordered by mistake">Ordered by mistake</option>
                                    <option value="Found cheaper elsewhere">Found cheaper elsewhere</option>
                                    <option value="Item won’t arrive on time">Item won’t arrive on time</option>
                                    <option value="Need change in shipping address">Need change in shipping address
                                    </option>
                                    <option value="Wrong item ordered">Wrong item ordered</option>
                                    <option value="Change in mind">Change in mind</option>
                                    <option value="Want to reorder with modifications">Want to reorder with
                                        modifications</option>
                                    <option value="Already received product from another source">Already received
                                        product from another source</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group mb-3" id="other_reason_box" style="display: none;">
                                <label>Please specify your reason <span class="error required">*</span></label>
                                <input type="text" class="form-control" required id="other_reason_input"
                                    name="other_reason" placeholder="Enter your reason">
                            </div>

                            <div class="form-group mb-3">
                                <label>Remark<span class="error required">*</span></label>
                                <textarea class="form-control" required name="reason_details"></textarea>
                            </div>

                            <div class="form-button">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

         <!-- Return Model Ppup -->
        <div class="modal fade" id="returnRequestModal" tabindex="-1" aria-labelledby="returnRequestModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="returnRequestModalLabel">Refund / Return Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="refund_form" method="POST" autocomplete="off">
                            @csrf
                            <input type="hidden" name="order_number" value="{{ $orderDetails->order_number }}">
                            <input type="hidden" name="order_item_id" id="refund_order_item_id">

                            <!-- Refund Type Selection -->
                            <div class="form-group mb-3">
                                <label>Choose Refund Method <span class="error required">*</span></label><br>
                                <button type="button" class="btn btn-outline-primary refund-type-btn active"
                                    data-type="wallet">Refund to Wallet</button>
                                <button type="button" class="btn btn-outline-success refund-type-btn"
                                    data-type="account">Refund to Bank Account</button>
                                <input type="hidden" name="refund_type" id="refund_type" required>
                            </div>

                            <!-- Refund Reason -->
                            <div class="form-group mb-3">
                                <label>Reason for Refund <span class="error required">*</span></label>
                                <select required class="form-control" name="refund_reason" id="refund_reason">
                                    <option value="">-- Select Reason --</option>
                                    <option value="Wrong item received">Wrong item received</option>
                                    <option value="Wrong size / fit issue">Wrong size / fit issue</option>
                                    <option value="Wrong color / pattern received">Wrong color / pattern received
                                    </option>
                                    <option value="Product defective / damaged">Product defective / damaged</option>
                                    <option value="Item not as described">Item not as described</option>
                                    <option value="Image shown didn’t match the actual product">Image shown didn’t
                                        match the actual product</option>
                                    <option value="Quality Issue">Quality Issue</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Other reason box -->
                            <div class="form-group mb-3" id="refund_other_reason_box" style="display:none;">
                                <label>Please specify your reason <span class="error required">*</span></label>
                                <input type="text" class="form-control" name="other_reason"
                                    id="refund_other_reason_input" placeholder="Enter your reason">
                            </div>

                            <!-- Additional Details -->
                            <div class="form-group mb-3">
                                <label>Additional Details (optional)</label>
                                <textarea class="form-control" name="refund_details" rows="3"></textarea>
                            </div>

                            <!-- Bank Details (shown only if "Refund to Bank" selected) -->
                            <div id="bank_fields" class="row" style="display:none;">
                                <div class="form-group mb-3 col-md-6">
                                    <label>Account Number <span class="error required">*</span></label>
                                    <input type="text" name="account_number" class="form-control">
                                </div>

                                <div class="form-group mb-3  col-md-6">
                                    <label>Confirm Account Number <span class="error required">*</span></label>
                                    <input type="text" name="confirm_account_number" class="form-control">
                                </div>

                                <div class="form-group mb-3 col-md-4">
                                    <label>IFSC Code <span class="error required">*</span></label>
                                    <input type="text" name="ifsc_code" class="form-control">
                                </div>

                                <div class="form-group mb-3 col-md-4">
                                    <label>Account Type <span class="error required">*</span></label>
                                    <select class="form-control" name="account_type" style="height: 48px;">
                                        <option value="Saving">Saving</option>
                                        <option value="Current">Current</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-md-4">
                                    <label>Bank Name <span class="error required">*</span></label>
                                    <input type="text" name="bank_name" class="form-control">
                                </div>
                            </div>

                            <div class="form-button">
                                <button type="submit" class="btn btn-primary">Submit Refund Request</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>


</div>



<!-- Write Review Popup -->
<div class="modal" id="write_review_product_item">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Write Review</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo env('WEBSITE_URL'); ?>add-review" method="POST" enctype="multipart/form-data">
                    @csrf                                           
                    <input type="hidden" class="write_review_item_id" name="product_id" id="product_id" value="0">

                    <ul class="rating-review" id="starRating">
                            <li data-star="1"><i class="fa-regular fa-star fa-solid"></i></li>
                            <li data-star="2"><i class="fa-regular fa-star"></i></li>
                            <li data-star="3"><i class="fa-regular fa-star"></i></li>
                            <li data-star="4"><i class="fa-regular fa-star"></i></li>
                            <li data-star="5"><i class="fa-regular fa-star"></i></li>
                    </ul>
                    <input type="hidden" name="rating" id="rating" value="1">
                    
                    <div class="review-box">
                        <div class="form-group">
                            <label>Review Title</label>
                            <input type="text" name="title" class="form-control " placeholder="Give your review a title" value="" required>
                                                                            </div>
                        <div class="form-group">
                            <label>Review (5000)</label>
                            <textarea class="form-control " name="review" placeholder="Write your comments here" value="" required></textarea>
                                                                            </div>
                        <div class="upload-btn-wrapper">
                            <button class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 64 64" style="enable-background: new 0 0 512 512;" xml:space="preserve" class="">
                                    <g>
                                        <path d="M56 47.6V56c0 1.1-.4 2.1-1.2 2.8S53.1 60 52 60H12c-.5 0-1-.1-1.5-.3s-.9-.5-1.3-.9-.7-.8-.9-1.3-.3-1-.3-1.5v-8.4c0-.6.5-1.1 1.1-1.1h1.8c.6 0 1.1.5 1.1 1.1V56h40v-8.4c0-.6.5-1.1 1.1-1.1h1.8c.6 0 1.1.5 1.1 1.1z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                        <path d="m52.5 26.1-1.3 1.3c-.4.4-1.1.4-1.5 0l-2.9-2.9c-.1 0-.1-.1-.2-.2L34 11.7v36.5c0 .6-.5 1.1-1.1 1.1h-1.8c-.6 0-1.1-.5-1.1-1.1V11.7L17.4 24.3c0 .1-.1.1-.1.2l-2.9 2.9c-.4.4-1.1.4-1.5 0l-1.3-1.3c-.4-.4-.4-1.1 0-1.5l.4-.6 2.4-2.4 1.2-1.2 3-3 3.9-3.9 4.1-4.1L30 6c1.2-1.2 2.6-1.4 4 0l2.8 2.8 4.1 4.1L45 17l3.2 3.2 1.4 1.4L52 24l.5.5c.5.5.5 1.2 0 1.6z" fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                    </g>
                                </svg>
                            </button>
                            <input type="file" name="image[]" id="image" multiple="" accept="image/*" class="form-control">
                            <div id="preview-area" style="margin-top:10px; display:flex; gap:10px; flex-wrap:wrap;">
                            </div>
                        </div>
                        <p class="bottom-text">
                            By submitting your review, you agree to our <a href="https://vasvi.in/page/terms-service">terms</a> and <a href="https://vasvi.in/page/privacy-policy">privacy policy</a>
                        </p>
                        <div class="btn-group">
                            <button class="border-fill me-2" type="submit">Submit Review</button>
                            <button class="border-btn" type="reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        
        
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('#starRating li').forEach(star => {
        star.addEventListener('click', function() {
            let rating = this.getAttribute('data-star');
            document.getElementById('rating').value = rating;

            document.querySelectorAll('#starRating li i').forEach((icon, index) => {
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
                if (index < rating) {
                    icon.classList.add('fa-solid');
                }
            });
        });
    });
</script>
<!-- Write Review Popup -->

<script>
    $('#cancel_reason_select').on('change', function() {
        if ($(this).val() === 'Other') {
            $('#other_reason_box').slideDown();
        } else {
            $('#other_reason_box').slideUp();
            $('#other_reason_input').val('');
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Validate forms
        $("#cancel_order_form").validate();
        $("#refund_form").validate();

        // Show/hide other reason box
        $('#cancel_reason_select').on('change', function() {
            if ($(this).val() === 'Other') {
                $('#other_reason_box').show();
            } else {
                $('#other_reason_box').hide();
                $('#other_reason_input').val('');
            }
        });

        // Button click → set order id in modal
        $(document).on('click', '.cancel-btn-data', function() {
            let orderItemId = $(this).data('id');
            $("#cancelOrderModal").data('order-id', orderItemId);
        });

        // Form submit
        $('#cancel_order_form').on('submit', function(e) {
            e.preventDefault();

            if (!$(this).valid()) {
                return;
            }

            let orderItemId = $("#cancelOrderModal").data('order-id');

            let formData = {
                cancel_reason: $('#cancel_reason_select').val(),
                other_reason: $('#other_reason_input').val(),
                reason_details: $('textarea[name="reason_details"]').val(),
                _token: '{{ csrf_token() }}',
                order_number: $("#ordernumber").val(),
                order_item_id: orderItemId
            };

            $.ajax({
                type: 'POST',
                url: '{{ route('front-cancel.order.submit') }}',
                data: formData,
                success: function(response) {
                    $('#cancelOrderModal').modal('hide'); // modal close
                    showFlashMessage("Order Cancelled Successfully");
                    location.reload(); // reload after success
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message ??
                        'Something went wrong'));
                }
            });
        });
    });



    // $('#refund_form').on('submit', function(e) {
    //     e.preventDefault();
    //     if (!$("#refund_form").valid()) {
    //         return;
    //     }
    //     $.ajax({
    //         url: '{{ route('front-refund.submit') }}',
    //         method: 'POST',
    //         data: $(this).serialize(),
    //         success: function(response) {
    //             location.reloiad();
    //         },
    //         error: function(xhr) {
    //             let errors = xhr.responseJSON.errors;
    //             let firstError = Object.values(errors)[0][0];

    //         }
    //     });
    // });
    // document.getElementById("cancel_reason_select").addEventListener("change", function() {
    //     let otherBox = document.getElementById("other_reason_box");
    //     if (this.value === "Other") {
    //         otherBox.style.display = "block";
    //     } else {
    //         otherBox.style.display = "none";
    //     }
    // });



    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
        $("#refund_form").validate();

        // Toggle Other Reason field
        $('#refund_reason').on('change', function() {
            if ($(this).val() === 'Other') {
                $('#refund_other_reason_box').show();
            } else {
                $('#refund_other_reason_box').hide();
                $('#refund_other_reason_input').val('');
            }
        });

        // Refund method selection
        $('#refund_type').val('wallet');

        $(document).on('click', '.refund-type-btn', function() {
            let type = $(this).data('type');
            $('#refund_type').val(type);

            // Highlight selected button
            $('.refund-type-btn').removeClass('active');
            $(this).addClass('active');

            // Show/hide bank fields
            if (type === 'account') {
                $('#bank_fields').show();
                $('#bank_fields input, #bank_fields select').attr('required', true);
            } else {
                $('#bank_fields').hide();
                $('#bank_fields input, #bank_fields select').removeAttr('required');
            }
        });

        // Set order item id when button clicked
        $(document).on('click', '.return-request-btn-data', function() {
            let orderItemId = $(this).data('id');
            $("#refund_order_item_id").val(orderItemId);
        });

        // Submit refund form
        $('#refund_form').on('submit', function(e) {
            e.preventDefault();

            if (!$(this).valid()) {
                return;
            }

            // Check account number match if refund to bank
            if ($('#refund_type').val() === 'account') {
                let acc = $('input[name="account_number"]').val();
                let confirmAcc = $('input[name="confirm_account_number"]').val();
                if (acc !== confirmAcc) {
                    alert("Account Number and Confirm Account Number do not match!");
                    return;
                }
            }

            let formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('front-refund.submit') }}',
                data: formData,
                success: function(response) {
                    $('#returnRequestModal').modal('hide');
                    showFlashMessage("Refund Request Submitted Successfully");
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message ??
                        'Something went wrong'));
                }
            });
        });

        // Set order item id when button clicked
        $(document).on('click', '.write_review_item', function() {
            let orderItemId = $(this).data('id');
            $(".write_review_item_id").val(orderItemId);
        });


    });

   
</script>
