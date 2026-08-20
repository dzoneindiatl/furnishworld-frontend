<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Cart;

Class FooterComposer 
{
    public function compose(View $view): void 
    {
        $data = footerCategoryContent();
        $firstCategory = $data['firstCategory'];
        $secondCategory = $data['secondCategory'];
        $thirdCategory = $data['thirdCategory']; // Not used in the current code
        $fourthCategory = $data['fourthCategory'];
        $fifthCategory = $data['fifthCategory'];
        $ActiveCoupon = $data['ActiveCoupon'];

        $view->with([
            'firstCategory'=>$firstCategory,
            'secondCategory'=>$secondCategory,
            'thirdCategory'=>$thirdCategory,
            'fourthCategory'=>$fourthCategory,
            'fifthCategory'=>$fifthCategory,
            'ActiveCoupon'=>$ActiveCoupon,
        ]);
        
    }
}