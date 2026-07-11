<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\TransactionModel;

class Payment extends BaseController
{

    protected $orderModel;
    protected $transactionModel;


    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->transactionModel = new TransactionModel();


        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');

        \Midtrans\Config::$clientKey = env('MIDTRANS_CLIENT_KEY');

        \Midtrans\Config::$isProduction = false;

        \Midtrans\Config::$isSanitized = true;

        \Midtrans\Config::$is3ds = true;
    }


    public function checkout()
    {

        $userId = session()->get('user_id');


        $order = [
            'user_id' => $userId,
            'total_price' => 25000,
            'status' => 'pending'
        ];


        $orderId = $this->orderModel->insert($order);



        $params = [

            'transaction_details' => [

                'order_id' => $orderId,

                'gross_amount' => 25000,

            ],


            'customer_details' => [

                'first_name' => session()->get('username'),

                'email' => session()->get('email'),

            ]

        ];



        $snapToken = \Midtrans\Snap::getSnapToken($params);



        $this->transactionModel->insert([

            'order_id' => $orderId,

            'snap_token' => $snapToken,

            'transaction_status' => 'pending'

        ]);



        return view('payment/checkout', [

            'snapToken' => $snapToken

        ]);

    }



    public function callback()
    {

        $json = file_get_contents('php://input');

        $result = json_decode($json);



        $transaction = $result->transaction_status;


        $orderId = $result->order_id;



        if($transaction == 'settlement'){

            $this->orderModel
            ->update($orderId,[
                'status'=>'paid'
            ]);

        }


        return $this->response->setJSON([

            'status'=>'success'

        ]);

    }



    public function success()
    {

        session()->setFlashdata(
            'success',
            'Pembayaran berhasil!'
        );


        return redirect()->to('/');

    }



}