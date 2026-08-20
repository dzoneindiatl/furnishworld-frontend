<?php 

namespace App\Service;  

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailTemplate; 

Class MailService 
{

    public function welcomeUser($userData,$mailData){
        $email = $userData->email; 
        $subject =$mailData->subject; 
        $body = str_replace(
            '{USER_NAME}',
            $userData->name,
            $mailData->body
        );
        $this->sendMail($email,$subject,$body); 
    }
    public function orderReturn(){
        $this->sendMail(); 
    }
    public function orderCancelled($userData, $orderData){

        $email = $userData->email;
        $template = EmailTemplate::where('name','Order Cancelled')->first(); 
        if(!$template){
            return response()->json([
                'status'=>false,
                'message'=>"order Cancel template not found" 
            ]); 
        } 
        $subject = $template->subject; 
        $body = $template->body; 
        $customerName = $userData->name ?? '';
        $orderDetails=""; 
        $refundDetails = ""; 
        foreach ($orderData as $item) {

            $orderDetails .= '
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="width:100%; border-collapse:collapse; margin-bottom:15px;">

                    <tr>
                        <td style="padding:8px; border-bottom:1px solid #ddd;">
                            <strong>Product:</strong>
                        </td>

                        <td style="padding:8px; border-bottom:1px solid #ddd;">
                            ' . $item->product->name . '
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:8px; border-bottom:1px solid #ddd;">
                            <strong>Quantity:</strong>
                        </td>

                        <td style="padding:8px; border-bottom:1px solid #ddd;">
                            ' . $item->qty . '
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:8px; border-bottom:1px solid #ddd;">
                            <strong>Price:</strong>
                        </td>

                        <td style="padding:8px; border-bottom:1px solid #ddd;">
                            ' . $item->currency_code . $item->total . '
                        </td>
                    </tr>

                </table>
            ';
                if ($item->order->payment_method != 'cod' && $item->order->payment_status == 'paid') {

                    $refundAmount = $item->total;

                    $refundDetails = '
                        <div style="
                            background-color:#f8f9fa;
                            border:1px solid #dddddd;
                            padding:15px;
                            margin:20px 0;
                            border-radius:6px;
                        ">

                            <p style="margin:5px 0;">
                                <strong>Refund Amount:</strong>
                                ' . $item->currency_code . $refundAmount . '
                            </p>

                            <p style="margin:5px 0;">
                                The refundable amount has been credited to your wallet.
                            </p>

                        </div>
                    ';
                }
        }   
        
        $body = str_replace(
            [
                '{CUSTOMER_NAME}',
                '{ORDER_ID}',
                '{ORDER_DETAILS}',
                '{REFUND_DETAILS}'
            ],
            [
                $customerName,
                $orderData->first()->order_id,
                $orderDetails,
                $refundDetails
            ],
            $body
        );
        info("-----subject----body----userData-------",[$subject,$body,$userData]);     
        $this->sendMail($email,$subject,$body); 
    }
    
    public function orderAccepted($order,$productDetail){

        \Log::info("cart Item =----",[$productDetail]); 
        \Log::info("Order Detail--------",[$order]); 
        $orderDetails = '<table width="100%" border="1" cellspacing="0" cellpadding="8">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>';

                    foreach ($productDetail as $item) {

                        $orderDetails .= '
                            <tr>
                                <td>'.$item['name'].'</td>
                                <td>'.$item['quantity'].'</td>
                                <td>₹'.$item['sellingPrice'].'</td>
                            </tr>';
                    }

                    $orderDetails .= '
                        </tbody>
                    </table>';
        $data = EmailTemplate::where('name','Order Accepted')->first(); 
        $userData = Auth::user();
        $email = Auth::guard('customer')->user()->email;
        $name = Auth::guard('customer')->user()->name; 
        $subject = $data->subject; 
        $body = $data->body; 
        $body = strtr($body, [
                '{ORDER_STATUS}'  => 'Order Accepted',
                '{CUSTOMER_NAME}' => $name,
                '{ORDER_ID}'      => $order->order_number,
                '{ORDER_DETAILS}' => $orderDetails,
            ]);
        $this->sendMail($email,$subject,$body); 
    }
    public function sendMail($email,$subject,$body){
        Mail::to($email)->send(new SendMail($subject,$body)); 
    }

  


}