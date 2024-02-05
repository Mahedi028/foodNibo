<?php

namespace App\Http\Controllers;

use DB;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SslCommercePaymentRequest;
use App\Interfaces\MenuCartInterface;
use App\Interfaces\OrderInterface;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{
    use ResponseTrait;

    protected $order, $cart;

    public function __construct(
        OrderInterface $orderInterface,
    MenuCartInterface $menuCartInterface
    )
    {
        $this->cart=$menuCartInterface;
        $this->order=$orderInterface;
    }

    public function SSLCommercePayment(SslCommercePaymentRequest $request)
{


   /* PHP */
$post_data = array();
// $post_data['store_id'] = config('sslcommerz.apiCredentials.store_id');
// $post_data['store_passwd'] = config('sslcommerz.apiCredentials.store_password');
$post_data['store_id']=config('sslcommerz.apiCredentials.store_id');
$post_data['store_passwd']= config('sslcommerz.apiCredentials.store_password');
$post_data['total_amount']=$request->input('total_amount');
$post_data['currency']= "BDT";
$post_data['tran_id']=uniqid();
// $post_data['product_category']='watches';
$post_data['success_url']="http://127.0.0.1:8000/success";
$post_data['fail_url']="http://127.0.0.1:8000/fail";
$post_data['cancel_url']="http://127.0.0.1:8000/cancel";
// $post_data['emi_option']=1;
// $post_data['ipn_url']="http://127.0.0.1:8000/ipn";
$post_data['cus_name']=$request->input('name');
$post_data['cus_email']=$request->input('email');
$post_data['cus_add1']="Dhaka";
$post_data['cus_city']="Dhaka";
$post_data['cus_state']="Dhaka";
$post_data['cus_postcode']="1000";
$post_data['cus_country']="Bangladesh";
$post_data['cus_phone']=$request->input('phone');
$post_data['cus_fax']="01711111111";
$post_data['ship_name']="Customer Name";
$post_data['ship_add1']="Dhaka";
$post_data['ship_add2']="Dhaka";
$post_data['ship_city']="Dhaka";
$post_data['ship_state']= "Dhaka";
$post_data['ship_postcode']=$request->input('postal_code');
$post_data['ship_country']="Bangladesh";
$post_data['shipping_method']="YES";
// $post_data['num_of_item']=1;
// $post_data['weight_of_items']=2.00;
// $post_data['logistic_pickup_id']=uniqid();
$post_data['product_name']="Computer";
$post_data['product_category']="Electronic";
$post_data['product_profile']="general";
// $post_data['ship_name']="test";

// $post_data["multi_card_name']="mastercard,visacard,amexcard",
$post_data['value_a']="ref001_A";
$post_data['value_b']="ref002_B";
$post_data['value_c']="ref003_C";
$post_data['value_d']="ref004_D";

# REQUEST SEND TO SSLCOMMERZ
// $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";

$apiDomain=config('sslcommerz.apiDomain');
$make_payment_api_url =$apiDomain.config('sslcommerz.apiUrl.make_payment');


$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $make_payment_api_url );
curl_setopt($handle, CURLOPT_TIMEOUT, 30);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($handle, CURLOPT_POST, 1 );
curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


$content = curl_exec($handle );

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle))) {
	curl_close( $handle);
	$sslcommerzResponse = $content;
} else {
	curl_close( $handle);
	echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
	exit;
}

# PARSE THE JSON RESPONSE
$sslcz = json_decode($sslcommerzResponse, true );


if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
	// echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";

       $data=[];
            $data['user_id']=$request->input('user_id');
            $data['name']=$request->input('name');
            $data['email']=$request->input('email');
            $data['phone']=$request->input('phone');
            $data['address']=$request->input('address');
            $data['postal_code']=$request->input('postal_code');
            $data['division_id']=$request->input('division_id');
            $data['district_id']=$request->input('district_id');
            $data['state_id']=$request->input('state_id');
            $data['total_amount']=$request->input('total_amount');
            $data['discount_amount']=20;

            $data['payment_type']='ssl-commerce';
            $data['payment_method']='ssl-commerce';
            $data['payment_status']=$sslcz['status'];
            $data['status']=$sslcz['status'];
            $data['transaction_id']=$post_data['tran_id'];
            $data['currency']=$post_data['currency'];
            $data['amount']=$post_data['total_amount'];
            $data['order_number']=uniqid();
            $data['invoice_no']='FOD'.mt_rand(10000000,99999999);
            $data['order_date']=Carbon::now()->format('d F Y');
            $data['order_month']=Carbon::now()->format('d F Y');
            $data['order_year']=Carbon::now()->format('d F Y');
            $data['confirmed_date']=null;
            $data['shipped_date']=null;
            $data['delivered_date']=null;
            $data['cancel_date']=null;
            $data['return_date']=null;
            $data['return_reason']=null;
            $data['payment_details']=null;
            $data['operational_status']='pending';
            $data['processed_by']=null;

            try{
                $orderItems=[];
                $order_id=$this->order->postOrder($data);
                $menu_carts=$this->cart->getCartListByEmail($data['email']);
                foreach($menu_carts as $menu_cart){
                    $orderItems['order_id']=$order_id;
                    $orderItems['menu_id']=$menu_cart->menu_id;
                    $orderItems['quantity']=$menu_cart->quantity;
                    $orderItems['price']=$menu_cart->total_price;
                    $this->order->postAllItem($orderItems);
                }

                //remove all from cartItems
                $this->cart->removeAllFromCart($data['email']);

                //send order mail
                $invoice=$this->order->findOrderbyId($order_id);


                $mailData=[
                    'invoice_no'=>$invoice[0]['invoice_no'],
                    'amount'=>$data['total_amount'],
                    'name'=>$invoice[0]['name'],
                    'email'=>$invoice[0]['email']
                ];
                Mail::to($request->email)->send(new OrderMail($mailData));
                return $this->responseSuccess($sslcz['GatewayPageURL'],'successfully',200);
            }catch(\Exception $e){
                return $this->responseError($e->getMessage(),'Order Error',401);
            }

    // return $this->responseSuccess($sslcz['GatewayPageURL'],'successfully',200);
	# header("Location: ". $sslcz['GatewayPageURL']);
	exit;
} else {
	echo "JSON Data parsing error!";
}


}//end of method


    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();

        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id'=>1,
                'division_id'=>1,
                'district_id'=>1,
                'state_id'=>1,
                'postal_code'=>"2233",
                'total_amount'=>"1200",
                'payment_status'=>"pending",
                'payment_type'=>"ssl-commerce",
                'order_number'=>uniqid(),
                'invoice_no'=>"FOD".uniqid(),
                'order_date'=>Carbon::now()->format('d F Y'),
                'order_month'=>Carbon::now()->format('d F Y'),
                'order_year'=>Carbon::now()->format('d F Y'),
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'operational_status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['store_id'] = "foodo641163398d354";
        $post_data['store_passwd'] = "foodo641163398d354@ssl";
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "testfoodold87";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                  'user_id'=>1,
                'division_id'=>1,
                'district_id'=>1,
                'state_id'=>1,
                'postal_code'=>"2233",
                'total_amount'=>"1200",
                'payment_status'=>"pending",
                'payment_type'=>"ssl-commerce",
                'order_number'=>uniqid(),
                'invoice_no'=>"FOD".uniqid(),
                'order_date'=>Carbon::now()->format('d F Y'),
                'order_month'=>Carbon::now()->format('d F Y'),
                'order_year'=>Carbon::now()->format('d F Y'),
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'operational_status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return $this->responseSuccess($order_details->status,'successfully',200);
            echo "Transaction is successfully Completed";

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
