<?php
namespace App\Services\Payment;

class TapPayment {

    protected $AUTHORIZATION =  '';
    protected $APP_URL = 'http://127.0.0.1:8000';
    protected $PostCallback = null;
    protected $GetCallback = null;
    protected $amount = 0;
    protected $coupon = 0;
    protected $description = 'Simple Payment';
    protected $first_name = 'Customer Name';
    protected $email = 'customer@example.com';
    protected $phone = '966502564';
    protected $country_code = '966';
    protected $tax = 0;
    protected $currency = 'SAR';
    protected $save_card = false;
    protected $threeDSecure = true;
    protected $transaction_id = null;

    public function charge( $PostCallback, $GetCallback, $amount, $coupon, $description,  $first_name, $email, $phone, $tax, $transaction_id ) {

        $this->PostCallback = $PostCallback;
        $this->GetCallback = $GetCallback;
        $this->amount = $amount;
        $this->coupon = $coupon;
        $this->description = $description;
        $this->first_name = $first_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->tax = $tax;
        $this->transaction_id = $transaction_id;

        $curl = curl_init();

        $data = [
            'amount' =>  $this->amount - $this->coupon,
            'currency' =>  $this->currency,
            'threeDSecure' =>  $this->threeDSecure,
            'save_card' =>  $this->save_card,
            'description' => $this->description,
            'statement_descriptor' => 'Sample',
            'metadata' => [
                'udf1' => 'test 1',
                'udf2' => 'test 2'
            ],
            'reference' => [
                'transaction' =>$this->transaction_id,
                'order' => $this->transaction_id
            ],
            'receipt' => [
                'email' => false,
                'sms' => true
            ],
            'customer' => [
                'first_name' => $this->first_name,
                'middle_name' => 'test',
                'last_name' => 'test',
                'email' => $this->email,
                'phone' => [
                    'country_code' =>  $this->country_code,
                    'number' => $this->phone
                ]
            ],
            'merchant' => [
                'id' => ''
            ],
            'source' => [
                'id' => 'src_card'
            ],
            'post' =>    [
                'url' =>  $this->PostCallback
            ],
            'redirect' => [
                'url' => $this->GetCallback
            ]
        ];

        curl_setopt_array( $curl, array(
            CURLOPT_URL => 'https://api.tap.company/v2/charges',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>  json_encode( $data ),
            CURLOPT_HTTPHEADER => array(
                'authorization: Bearer ' . $this->AUTHORIZATION,
                'content-type: application/json'
            ),
        ) );

        $response = curl_exec( $curl );
        $err = curl_error( $curl );

        curl_close( $curl );

        if ( $err ) {
            echo 'cURL Error #:' . $err;
        } else {

            $data = json_decode( $response );
            //  return $data;
            if ( $data ) {
                return redirect( $data->transaction->url );
            }

            return $data;

        }

    }

    public function checkout( $id ) {
        $curl = curl_init();



        curl_setopt_array( $curl, array(
            CURLOPT_URL => 'https://api.tap.company/v2/charges/'. $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{ "threeDSecure": true}',
            CURLOPT_HTTPHEADER => array(
                'authorization: Bearer ' . $this->AUTHORIZATION
            ),
        ) );

        $response = curl_exec( $curl );
        $err = curl_error( $curl );

        curl_close( $curl );

        if ( $err ) {
            echo 'cURL Error #:' . $err;
        } else {
            return  json_decode( $response );
        }

    }
}
