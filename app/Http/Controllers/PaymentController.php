<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Mpesa;
use App\MpesaCallback;
USE App\MpesaCallbackMetadata;
use App\Gigs;
use App\Bid;
use App\User;

use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
//     public function pay(Request $request){
//         $Amount = $request->input('amount');
//         $phoneNumber = $request->input('phonenumber');
   
//         // $CallBackURL = 'https://integrate-payment.herokuapp.com/callback';
//         $CallBackURL = 'https://127.0.0.1:8000/callback';
    
    
    
//     $mpesa= new \Safaricom\Mpesa\Mpesa();
    
//     $stkPushSimulation=$mpesa->STKPushSimulation(174379, 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919', 'CustomerPayBillOnline', $Amount, $phoneNumber, 174379, $phoneNumber, $CallBackURL, 'lozadasuppies', 'lozada', 'Payment');
//     if($stkPushSimulation) {
//         echo $mpesa->getDataFromCallback();

//     }else {
//         return "This doesn't work";
//     }
// }

public function pay(Request $request){

    $user =  Auth::user();
    $id = $user->id;
     $gig = Gigs::where('user_id', $id)->first();
     $bid = Bid::where('g_id', $gig->gig_id)->first();


    $client = new Client(); //GuzzleHttp\Client

    $response1 = $client->request('GET', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', [
        'auth' => [
            '2PF8ouVATAq3Zzw6qqAznm4Ogx7slPci', 
            'zci1GtQ9wM3k2kKG'
        ]
    ]);

    /*echo $response->getStatusCode(); # 200
    echo $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'*/
    //echo $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'
    $token = json_decode($response1->getBody()->getContents());

    //echo $token->access_token;

    $headers = [
        'Authorization' => 'Bearer ' . $token->access_token,        
        'Accept'        => 'application/json',
    ];

    /*$Shortcode = '174379';

    echo Carbon::now()->format('YmdHis');*/
    $response2 = $client->request('POST', 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
        'headers' => $headers,
        'json' => 
            [
                "BusinessShortCode" => "174379",
                "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTgwODE0MDg1NjIw",
                "Timestamp" => "20180814085620",
                "TransactionType" => "CustomerPayBillOnline",
                "Amount"	=> $request->input('amount'),
                "PartyA"	=> $request->input('phonenumber'),
                "PartyB"	=> "174379",
                "PhoneNumber" => $request->input('phonenumber'),
                "CallBackURL" => "http://api.planetarena.co.ke/api/mpesa-callback",
                "AccountReference" => User::where('id', $bid->user_id)->pluck('name')->first(),
                "TransactionDesc"	=> "Gigs"
            ]
        
    ]);


    //echo $response2->getBody()->getContents();

    $mpesaData = json_decode($response2->getBody()->getContents());

    $mpesa = new Mpesa;
    $mpesa->MerchantRequestID = $mpesaData->MerchantRequestID;
    $mpesa->CheckoutRequestID = $mpesaData->CheckoutRequestID;
    $mpesa->ResponseCode = $mpesaData->ResponseCode;
    $mpesa->ResponseDescription = $mpesaData->ResponseDescription;
    $mpesa->CustomerMessage = $mpesaData->CustomerMessage;
    $mpesa->user_id = $id;
    $mpesa->amount = $request->input('amount');

    try {
        $mpesa->save();
    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }

    //return response()->json($mpesa);
    return redirect()->to('/completed');
                    // ->with('flash_message', 'Payment processing...')
                    // ->with('flash_type', 'alert-success');
}

// public function callback(Request $request){

//     $mpesaCallback = new MpesaCallback;
//     $mpesaCallback->MerchantRequestID = $request['Body']['stkCallback']['MerchantRequestID'];
//     $mpesaCallback->CheckoutRequestID = $request['Body']['stkCallback']['CheckoutRequestID'];
//     $mpesaCallback->ResultCode = $request['Body']['stkCallback']['ResultCode'];
//     $mpesaCallback->ResultDesc = $request['Body']['stkCallback']['ResultDesc'];


//     try {
//         $mpesaCallback->save();
//     } catch (\Illuminate\Database\QueryException $e) {
//         return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
//     }

//     $mpesaCallbackMetadata = new MpesaCallbackMetadata;
//     $mpesaCallbackMetadata->MerchantRequestID = $request['Body']['stkCallback']['MerchantRequestID'];
//     $mpesaCallbackMetadata->CheckoutRequestID = $request['Body']['stkCallback']['CheckoutRequestID'];
//     $mpesaCallbackMetadata->Amount = $request['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
//     $mpesaCallbackMetadata->MpesaReceiptNumber = $request['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
//     $mpesaCallbackMetadata->TransactionDate = $request['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
//     $mpesaCallbackMetadata->PhoneNumber = $request['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];


//     try {
//         $mpesaCallbackMetadata->save();
//     } catch (\Illuminate\Database\QueryException $e) {
//         return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
//     }

// }

// public function confirmPayment(Request $request){
//     $user =  Auth::user();
//     $id = $user->id;
//     $mpesa = Mpesa::where('user_id', $request->$id)->first();
//     $mpesaCallbackMetadata = MpesaCallbackMetadata::whereMerchantrequestid($mpesa->MerchantRequestID)->first();

//     if(isset($mpesaCallbackMetadata)){
//         return response()->json(['status' => 'success', 'message' => $mpesaCallbackMetadata]);
//     }else{
//         return response()->json(['status' => 'error', 'message' => 'Record not found']);
//     }

// }


}
