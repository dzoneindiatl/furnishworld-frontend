<div class="sidebar-section col-md-3 col-sm-12 col-12">
    <div class="myaccout-box-item">
        <div class="myaccout-box-wrap">
            <div class="user-intro myaccout-box-body">
                <div class="user-icon"> <img src="{{ 'tjap-images/profile-pic.svg' }}" alt=""> </div>
                <div class="user-info">
                    <small>Hello,</small>
                    <p><?php echo Auth::user()?->name; ?></p>
                </div>
            </div>
            <?php
            $avlWallet = Auth::user()?->wallet_avl_balance;
            ?>
            <div class="myaccout-box-body">
                <h4 class="wallet-txt-left"><strong>Wallet Balance Rs <?php if ($avlWallet > 0) {
                    echo $avlWallet;
                } else {
                    echo '0.00';
                } ?></strong></h4>
            </div>
        </div>
    </div>

    <div class="myaccout-box-item">
        <div class="myaccout-box-wrap">
            <div class="myaccout-box-body p-0">
                <ul class="sidebar-account-menu">
                    <li class="active"><a href="{{ env('WEBSITE_URL') . 'dashboard' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-dashboard.svg' }}"
                                    alt="" /></span>Overview</a> </li>
                    <li><a href="{{ env('WEBSITE_URL') . 'mypurchase' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-box.svg' }}"
                                    alt="" /></span>My
                            Purchase</a></li>
                    <li><a href="{{ env('WEBSITE_URL') . 'accountsetting' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-setting.svg' }}"
                                    alt="" /></span>Account Setting</a></li>
                    <li><a href="{{ env('WEBSITE_URL') . 'walletpayment' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-points.svg' }}"
                                    alt="" /></span>My Wallet & Payment Details</a></li>
                    <li><a href="{{ env('WEBSITE_URL') . 'wishlist' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-heart.svg' }}"
                                    alt="" /></span>My Wishlist</a></li>
                    <li><a href="{{ env('WEBSITE_URL') . 'contactwithus' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-chat.svg' }}"
                                    alt="" /></span>Contact Us</a></li>
                    <li><a href="{{ env('WEBSITE_URL') . 'suggestion' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-help.svg' }}"
                                    alt="" /></span>Help Us improve</a></li>
                    <li><a href="{{ env('WEBSITE_URL') . 'rateing-review' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-review.svg' }}"
                                    alt="" /></span>Rate & Reviews</a></li>
                    <li><a href="{{ env('WEBSITE_URL') . 'invite-friends' }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-invite-friend.svg' }}"
                                    alt="" /></span>Invite a friend</a></li>
                    <li><a class="logout" href="{{ route('front-user.logout') }}"><span><img
                                    src="{{ env('WEBSITE_URL') . 'tjap-images/icon-logout.svg' }}"
                                    alt="" /></span>Log out</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.sidebar-account-menu li').on('click', function() {

            // Remove active from all li
            $('.sidebar-account-menu li').removeClass('active');

            // Add active to clicked li
            $(this).addClass('active');

        });

    });
</script>
