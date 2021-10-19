<?php

namespace App\Http\Controllers;

use App\Traits\SubscriptionDiscountTrait;
use Illuminate\Http\Request;
use Modules\Cart\Contracts\CartService;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaymentController extends Controller
{

    use SubscriptionDiscountTrait;
    private $cartServices;
    public function __construct(CartService $cartService)
    {
        $this->cartServices = $cartService;
    }

    public function verification(Request $request)
    {
        return response()->json([ //returns success to ajax
            'success' => 'Your Account is succesfully credited.',
        ], 200);
        dd($request);
        //hit the khalit server
        $args = http_build_query(array(
            'token' => $request->input('trans_token'),
            'amount' => $request->input('amount'),
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_2ff879c83221405bad79b372e79b049f'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        // dd($response); //see the response from khalti server
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $res = json_decode($response, true); //decode the response
        if (isset($res['idx'])) //check whether there is idx and also the amount in response with your database(I havenot done that)
        {
            //perform your database operation here,,,
            return response()->json([ //returns success to ajax
                'success' => 'Your Account is succesfully credited.',
            ], 200);

        } else {

            return response()->json([ //returns failure to ajax
                'error' => 'Something went Wrong.',
            ], 404);
        }

    }

    //for paypal payment

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {

        $data = [];
        $user = auth('web')->user();
        $carts = $this->cartServices->getCartByUser(auth('web')->user());
        $total_amount = $carts['total'];
        $data['items'] = $this->processItems($carts['content']);

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $total_amount;

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);

        // dd($provider, $response);
        return redirect($response['paypal_link']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully. You can create success page here.');
        }

        dd('Something is wrong.');
    }
}
