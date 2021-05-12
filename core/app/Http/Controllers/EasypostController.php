<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class EasypostController extends Controller
{
    public function fromaddress(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $fromAddress = \EasyPost\Address::create(array(
          'verify'  => array("delivery"),
          'company' => $request->input('company'),
          'street1' => $request->input('street1'),
          'street2' => $request->input('street2'),
          'city' => $request->input('city'),
          'state' => $request->input('state'),
          'zip' => $request->input('zip'),
          'phone' => $request->input('phone'),
        ));
        
        if($fromAddress->verifications['delivery']['success'] == true)
        {
            $success = [
                'status' => $fromAddress->verifications['delivery']['success'],
                'latitude' => $fromAddress->verifications['delivery']['details']['latitude'],
                'longitude' => $fromAddress->verifications['delivery']['details']['longitude'],
                'time_zone' => $fromAddress->verifications['delivery']['details']['time_zone'],
            ];
        }else{
            $success = [
                'status' => $fromAddress->verifications['delivery']['success'],
                'code' => $fromAddress->verifications['delivery']['errors'][0]['code'],
                'field' => $fromAddress->verifications['delivery']['errors'][0]['field'],
                'message' => $fromAddress->verifications['delivery']['errors'][0]['message'],
                'suggestion' => $fromAddress->verifications['delivery']['errors'][0]['suggestion']
            ];
        }
                
        //$data[] = $fromAddress->_values;
        //dd($fromAddress);
        //return view('easypost.fromaddress',array('title'=>'From Address'));
        if($fromAddress){
            #send response
            return response()->json([
                'message'=>'From Address added Successfully.',
                'code'=>200,
                'data'=>[
                    'id' => $fromAddress->id, 
                    'object' => $fromAddress->object, 
                    'created_at' => $fromAddress->created_at, 
                    'updated_at' => $fromAddress->updated_at, 
                    'name' => $fromAddress->name, 
                    'company' => $fromAddress->company, 
                    'street1' => $fromAddress->street1, 
                    'street2' => $fromAddress->street2, 
                    'city' => $fromAddress->city, 
                    'state' => $fromAddress->state, 
                    'zip' => $fromAddress->zip, 
                    'country' => $fromAddress->country, 
                    'phone' => $fromAddress->phone, 
                    'email' => $fromAddress->email, 
                    'mode' => $fromAddress->mode, 
                    'carrier_facility' => $fromAddress->carrier_facility,
                    'residential' => $fromAddress->residential, 
                    'federal_tax_id' => $fromAddress->federal_tax_id,
                    'state_tax_id' => $fromAddress->state_tax_id,
                    'verifications' => [
                        'delivery' => $success,
                    ]
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function toaddress(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $toAddress = \EasyPost\Address::create(array(
          'verify'  => array("delivery"),
          'name' => $request->input('name'),
          'company' => $request->input('company'),
          'street1' => $request->input('street1'),
          'street2' => $request->input('street2'),
          'city' => $request->input('city'),
          'state' => $request->input('state'),
          'zip' => $request->input('zip'),
          'phone' => $request->input('phone'),
        ));
        
        if($toAddress->verifications['delivery']['success'] == true)
        {
            $success = [
                'status' => $toAddress->verifications['delivery']['success'],
                'latitude' => $toAddress->verifications['delivery']['details']['latitude'],
                'longitude' => $toAddress->verifications['delivery']['details']['longitude'],
                'time_zone' => $toAddress->verifications['delivery']['details']['time_zone'],
            ];
        }else{
            $success = [
                'status' => $toAddress->verifications['delivery']['success'],
                'code' => $toAddress->verifications['delivery']['errors'][0]['code'],
                'field' => $toAddress->verifications['delivery']['errors'][0]['field'],
                'message' => $toAddress->verifications['delivery']['errors'][0]['message'],
                'suggestion' => $toAddress->verifications['delivery']['errors'][0]['suggestion']
            ];
        }
        
        if($toAddress){
            #send response
            return response()->json([
                'message'=>'To Address added Successfully.',
                'code'=>200,
                'data'=>[
                    'id' => $toAddress->id, 
                    'object' => $toAddress->object, 
                    'created_at' => $toAddress->created_at, 
                    'updated_at' => $toAddress->updated_at, 
                    'name' => $toAddress->name, 
                    'company' => $toAddress->company, 
                    'street1' => $toAddress->street1, 
                    'street2' => $toAddress->street2, 
                    'city' => $toAddress->city, 
                    'state' => $toAddress->state, 
                    'zip' => $toAddress->zip, 
                    'country' => $toAddress->country, 
                    'phone' => $toAddress->phone, 
                    'email' => $toAddress->email, 
                    'mode' => $toAddress->mode, 
                    'carrier_facility' => $toAddress->carrier_facility,
                    'residential' => $toAddress->residential, 
                    'federal_tax_id' => $toAddress->federal_tax_id,
                    'state_tax_id' => $toAddress->state_tax_id,
                    'verifications' => [
                        'delivery' => $success,
                    ]
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function parcel(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $parcel = \EasyPost\Parcel::create(array(
          "length" => $request->input('length'),
          "width" => $request->input('width'),
          "height" => $request->input('height'),
          "weight" => $request->input('weight'),
        ));
        
        if($parcel){
            #send response
            return response()->json([
                'message'=>'Parcel added Successfully.',
                'code'=>200,
                'data'=>[
                    'id' => $parcel->id, 
                    'object' => $parcel->object, 
                    'created_at' => $parcel->created_at, 
                    'updated_at' => $parcel->updated_at, 
                    'length' => $parcel->length, 
                    'width' => $parcel->width, 
                    'height' => $parcel->height, 
                    'predefined_package' => $parcel->predefined_package, 
                    'weight' => $parcel->weight, 
                    'city' => $parcel->city
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function predefinedparcel(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $parcel = \EasyPost\Parcel::create(array(
          "predefined_package" => $request->input('predefined_package'),
          "weight" => $request->input('weight'),
        ));
        
        if($parcel){
            #send response
            return response()->json([
                'message'=>'Predefined Package Parcel added Successfully.',
                'code'=>200,
                'data'=>[
                    'id' => $parcel->id, 
                    'object' => $parcel->object, 
                    'created_at' => $parcel->created_at, 
                    'updated_at' => $parcel->updated_at, 
                    'length' => $parcel->length, 
                    'width' => $parcel->width, 
                    'height' => $parcel->height, 
                    'predefined_package' => $parcel->predefined_package, 
                    'weight' => $parcel->weight, 
                    'city' => $parcel->city
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function getaddress(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $add_id = $request->input('id');
        
        //dd($add_id);
        
        $retrieved_address = \EasyPost\Address::retrieve($add_id);
        
        //dd($retrieved_address);
        
        if($retrieved_address){
            #send response
            return response()->json([
                'message'=>'Address found Successfully.',
                'code'=>200,
                'data'=>[
                    'id' => $retrieved_address->id, 
                    'object' => $retrieved_address->object, 
                    'created_at' => $retrieved_address->created_at, 
                    'updated_at' => $retrieved_address->updated_at, 
                    'name' => $retrieved_address->name, 
                    'company' => $retrieved_address->company, 
                    'street1' => $retrieved_address->street1, 
                    'street2' => $retrieved_address->street2, 
                    'city' => $retrieved_address->city, 
                    'state' => $retrieved_address->state, 
                    'zip' => $retrieved_address->zip, 
                    'country' => $retrieved_address->country, 
                    'phone' => $retrieved_address->phone, 
                    'email' => $retrieved_address->email, 
                    'mode' => $retrieved_address->mode, 
                    'carrier_facility' => $retrieved_address->carrier_facility,
                    'residential' => $retrieved_address->residential, 
                    'federal_tax_id' => $retrieved_address->federal_tax_id,
                    'state_tax_id' => $retrieved_address->state_tax_id,
                    'verifications' => $retrieved_address->verifications,
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function getparcel(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);

        $parcel_id = $request->input('id');
        
        //dd($add_id);
        
        $parcel = \EasyPost\Parcel::retrieve($parcel_id);
        
        //dd($parcel);
        
        if($parcel){
            #send response
            return response()->json([
                'message'=>'Parcel found Successfully.',
                'code'=>200,
                'data'=>[
                    'id' => $parcel->id, 
                    'object' => $parcel->object, 
                    'created_at' => $parcel->created_at, 
                    'updated_at' => $parcel->updated_at, 
                    'length' => $parcel->length, 
                    'width' => $parcel->width, 
                    'height' => $parcel->height, 
                    'predefined_package' => $parcel->predefined_package, 
                    'weight' => $parcel->weight, 
                    'city' => $parcel->city
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function shipment(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $from_add_id = $request->input('from_add_id');
        $to_add_id = $request->input('to_add_id');
        $parcel_id = $request->input('parcel_id');
        
        $fromAddress = \EasyPost\Address::retrieve($from_add_id);
        $toAddress = \EasyPost\Address::retrieve($to_add_id);
        $parcel = \EasyPost\Parcel::retrieve($parcel_id);
        
        $shipment = \EasyPost\Shipment::create(array(
          "to_address" => $toAddress,
          "from_address" => $fromAddress,
          "parcel" => $parcel
        ));
        
        foreach ($shipment->rates as $rate) {
          $all_rates[] = array ( 
            'id' => $rate->id,
            'object' => $rate->object,
            'created_at' => $rate->created_at,
            'updated_at' => $rate->updated_at,
            'mode' => $rate->mode,
            'service' => $rate->service,
            'carrier' => $rate->carrier,
            'rate' => $rate->rate,
            'currency' => $rate->currency,
            'retail_rate' => $rate->retail_rate,
            'retail_currency' => $rate->retail_currency,
            'list_rate' => $rate->list_rate,
            'list_currency' => $rate->list_currency,
            'delivery_days' => $rate->delivery_days,
            'delivery_date' => $rate->delivery_date,
            'delivery_date_guaranteed' => $rate->delivery_date_guaranteed,
            'est_delivery_days' => $rate->est_delivery_days,
            'shipment_id' => $rate->shipment_id,
            'carrier_account_id' => $rate->carrier_account_id,
          );
        }
        
        foreach ($shipment->fees as $fee) {
          $all_fees[] = array ( 
            'object' => $fee->object, 
            'type' => $fee->type, 
            'amount' => $fee->amount, 
            'charged' => $fee->charged, 
            'refunded' => $fee->refunded
          );
        }
        
        foreach ($shipment->messages as $message) {
          $all_messages[] = array ( 
            'carrier' => $message->carrier,
            'carrier_account_id' => $message->carrier_account_id,
            'type' => $message->type,
            'message' => $message->message,
          );
        }
        
        //dd($shipment);
        
        if($shipment){
            #send response
            return response()->json([
                'message'=>'Shipment Details.',
                'code'=>200,
                'data'=>[
                    'id' => $shipment->id, 
                    'created_at' => $shipment->created_at, 
                    'is_return' => $shipment->is_return, 
                    'messages' => $all_messages,
                    'mode' => $shipment->mode, 
                    'options' => [
                        'currency' => $shipment->options['currency'],
                        'payment' => $shipment->options['payment']['type'],
                        'date_advance' => $shipment->options['date_advance'],
                    ],
                    'reference' => $shipment->reference, 
                    'status' => $shipment->status, 
                    'tracking_code' => $shipment->tracking_code, 
                    'updated_at' => $shipment->updated_at, 
                    'batch_id' => $shipment->batch_id, 
                    'batch_status' => $shipment->batch_status, 
                    'batch_message' => $shipment->batch_message, 
                    'customs_info' => $shipment->customs_info, 
                    'from_address' => [
                        'id' => $shipment->from_address['id'],
                        'object' => $shipment->from_address['object'], 
                        'created_at' => $shipment->from_address['created_at'], 
                        'updated_at' => $shipment->from_address['updated_at'], 
                        'name' => $shipment->from_address['name'], 
                        'company' => $shipment->from_address['company'], 
                        'street1' => $shipment->from_address['street1'], 
                        'street2' => $shipment->from_address['street2'], 
                        'city' => $shipment->from_address['city'], 
                        'state' => $shipment->from_address['state'], 
                        'zip' => $shipment->from_address['zip'], 
                        'country' => $shipment->from_address['country'], 
                        'phone' => $shipment->from_address['phone'], 
                        'email' => $shipment->from_address['email'], 
                        'mode' => $shipment->from_address['mode'], 
                        'carrier_facility' => $shipment->from_address['carrier_facility'],
                        'residential' => $shipment->from_address['residential'], 
                        'federal_tax_id' => $shipment->from_address['federal_tax_id'],
                        'state_tax_id' => $shipment->from_address['state_tax_id'],
                        'verifications' => $shipment->from_address['verifications'],
                    ],
                    'insurance' => $shipment->insurance, 
                    'order_id' => $shipment->order_id, 
                    'parcel' => [
                        'id' => $shipment->parcel['id'],
                        'object' => $shipment->parcel['object'], 
                        'created_at' => $shipment->parcel['created_at'], 
                        'updated_at' => $shipment->parcel['updated_at'], 
                        'length' => $shipment->parcel['length'], 
                        'width' => $shipment->parcel['width'], 
                        'height' => $shipment->parcel['height'], 
                        'predefined_package' => $shipment->parcel['predefined_package'], 
                        'weight' => $shipment->parcel['weight'], 
                        'city' => $shipment->parcel['city']
                    ],
                    'postage_label' => $shipment->postage_label, 
                    'rates'=>  $all_rates,
                    'refund_status' => $shipment->refund_status, 
                    'scan_form' => $shipment->scan_form, 
                    'selected_rate' => $shipment->selected_rate, 
                    'tracker' => $shipment->tracker,
                    'to_address' => [
                        'id' => $shipment->to_address['id'],
                        'object' => $shipment->to_address['object'], 
                        'created_at' => $shipment->to_address['created_at'], 
                        'updated_at' => $shipment->to_address['updated_at'], 
                        'name' => $shipment->to_address['name'], 
                        'company' => $shipment->to_address['company'], 
                        'street1' => $shipment->to_address['street1'], 
                        'street2' => $shipment->to_address['street2'], 
                        'city' => $shipment->to_address['city'], 
                        'state' => $shipment->to_address['state'], 
                        'zip' => $shipment->to_address['zip'], 
                        'country' => $shipment->to_address['country'], 
                        'phone' => $shipment->to_address['phone'], 
                        'email' => $shipment->to_address['email'], 
                        'mode' => $shipment->to_address['mode'], 
                        'carrier_facility' => $shipment->to_address['carrier_facility'],
                        'residential' => $shipment->to_address['residential'], 
                        'federal_tax_id' => $shipment->to_address['federal_tax_id'],
                        'state_tax_id' => $shipment->to_address['state_tax_id'],
                        'verifications' => $shipment->to_address['verifications'],
                    ],
                    'usps_zone' => $shipment->usps_zone,
                    'return_address' => [
                        'id' => $shipment->return_address['id'],
                        'object' => $shipment->return_address['object'], 
                        'created_at' => $shipment->return_address['created_at'], 
                        'updated_at' => $shipment->return_address['updated_at'], 
                        'name' => $shipment->return_address['name'], 
                        'company' => $shipment->return_address['company'], 
                        'street1' => $shipment->return_address['street1'], 
                        'street2' => $shipment->return_address['street2'], 
                        'city' => $shipment->return_address['city'], 
                        'state' => $shipment->return_address['state'], 
                        'zip' => $shipment->return_address['zip'], 
                        'country' => $shipment->return_address['country'], 
                        'phone' => $shipment->return_address['phone'], 
                        'email' => $shipment->return_address['email'], 
                        'mode' => $shipment->return_address['mode'], 
                        'carrier_facility' => $shipment->return_address['carrier_facility'],
                        'residential' => $shipment->return_address['residential'], 
                        'federal_tax_id' => $shipment->return_address['federal_tax_id'],
                        'state_tax_id' => $shipment->return_address['state_tax_id'],
                        'verifications' => $shipment->return_address['verifications'],
                    ],
                    'buyer_address' => [
                        'id' => $shipment->buyer_address['id'],
                        'object' => $shipment->buyer_address['object'], 
                        'created_at' => $shipment->buyer_address['created_at'], 
                        'updated_at' => $shipment->buyer_address['updated_at'], 
                        'name' => $shipment->buyer_address['name'], 
                        'company' => $shipment->buyer_address['company'], 
                        'street1' => $shipment->buyer_address['street1'], 
                        'street2' => $shipment->buyer_address['street2'], 
                        'city' => $shipment->buyer_address['city'], 
                        'state' => $shipment->buyer_address['state'], 
                        'zip' => $shipment->buyer_address['zip'], 
                        'country' => $shipment->buyer_address['country'], 
                        'phone' => $shipment->buyer_address['phone'], 
                        'email' => $shipment->buyer_address['email'], 
                        'mode' => $shipment->buyer_address['mode'], 
                        'carrier_facility' => $shipment->buyer_address['carrier_facility'],
                        'residential' => $shipment->buyer_address['residential'], 
                        'federal_tax_id' => $shipment->buyer_address['federal_tax_id'],
                        'state_tax_id' => $shipment->buyer_address['state_tax_id'],
                        'verifications' => $shipment->buyer_address['verifications'],
                    ],
                    'forms' => $shipment->forms,
                    'fees' => $shipment->fees,
                    'object' => $shipment->object,
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function buyshipment(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $shipment_id = $request->input('shipment_id');
        
        //dd($add_id);
        
        $shipment = \EasyPost\Shipment::retrieve($shipment_id);
        $shipment->buy(array(
          'rate'      => $shipment->lowest_rate()
        ));
        
        foreach ($shipment->rates as $rate) {
          $all_rates[] = array ( 
            'id' => $rate->id,
            'object' => $rate->object,
            'created_at' => $rate->created_at,
            'updated_at' => $rate->updated_at,
            'mode' => $rate->mode,
            'service' => $rate->service,
            'carrier' => $rate->carrier,
            'rate' => $rate->rate,
            'currency' => $rate->currency,
            'retail_rate' => $rate->retail_rate,
            'retail_currency' => $rate->retail_currency,
            'list_rate' => $rate->list_rate,
            'list_currency' => $rate->list_currency,
            'delivery_days' => $rate->delivery_days,
            'delivery_date' => $rate->delivery_date,
            'delivery_date_guaranteed' => $rate->delivery_date_guaranteed,
            'est_delivery_days' => $rate->est_delivery_days,
            'shipment_id' => $rate->shipment_id,
            'carrier_account_id' => $rate->carrier_account_id,
          );
        }
        
        foreach ($shipment->fees as $fee) {
          $all_fees[] = array ( 
            'object' => $fee->object, 
            'type' => $fee->type, 
            'amount' => $fee->amount, 
            'charged' => $fee->charged, 
            'refunded' => $fee->refunded
          );
        }
        
        foreach ($shipment->messages as $message) {
          $all_messages[] = array ( 
            'carrier' => $message->carrier,
            'carrier_account_id' => $message->carrier_account_id,
            'type' => $message->type,
            'message' => $message->message,
          );
        }
        
        //print_r($all_fees);
        
        //dd($shipment);
        
        if($shipment){
            #send response
            return response()->json([
                'message'=>'Postage created Successfully.',
                'code'=>200,
                'data'=>[
                    'id' => $shipment->id, 
                    'created_at' => $shipment->created_at, 
                    'is_return' => $shipment->is_return, 
                    'messages' => $all_messages,
                    'mode' => $shipment->mode, 
                    'options' => [
                        'currency' => $shipment->options['currency'],
                        'payment' => $shipment->options['payment']['type'],
                        'date_advance' => $shipment->options['date_advance'],
                    ],
                    'reference' => $shipment->reference, 
                    'status' => $shipment->status, 
                    'tracking_code' => $shipment->tracking_code, 
                    'updated_at' => $shipment->updated_at, 
                    'batch_id' => $shipment->batch_id, 
                    'batch_status' => $shipment->batch_status, 
                    'batch_message' => $shipment->batch_message, 
                    'customs_info' => $shipment->customs_info, 
                    'from_address' => [
                        'id' => $shipment->from_address['id'],
                        'object' => $shipment->from_address['object'], 
                        'created_at' => $shipment->from_address['created_at'], 
                        'updated_at' => $shipment->from_address['updated_at'], 
                        'name' => $shipment->from_address['name'], 
                        'company' => $shipment->from_address['company'], 
                        'street1' => $shipment->from_address['street1'], 
                        'street2' => $shipment->from_address['street2'], 
                        'city' => $shipment->from_address['city'], 
                        'state' => $shipment->from_address['state'], 
                        'zip' => $shipment->from_address['zip'], 
                        'country' => $shipment->from_address['country'], 
                        'phone' => $shipment->from_address['phone'], 
                        'email' => $shipment->from_address['email'], 
                        'mode' => $shipment->from_address['mode'], 
                        'carrier_facility' => $shipment->from_address['carrier_facility'],
                        'residential' => $shipment->from_address['residential'], 
                        'federal_tax_id' => $shipment->from_address['federal_tax_id'],
                        'state_tax_id' => $shipment->from_address['state_tax_id'],
                        'verifications' => $shipment->from_address['verifications'],
                    ],
                    'insurance' => $shipment->insurance, 
                    'order_id' => $shipment->order_id, 
                    'parcel' => [
                        'id' => $shipment->parcel['id'],
                        'object' => $shipment->parcel['object'], 
                        'created_at' => $shipment->parcel['created_at'], 
                        'updated_at' => $shipment->parcel['updated_at'], 
                        'length' => $shipment->parcel['length'], 
                        'width' => $shipment->parcel['width'], 
                        'height' => $shipment->parcel['height'], 
                        'predefined_package' => $shipment->parcel['predefined_package'], 
                        'weight' => $shipment->parcel['weight'], 
                        'city' => $shipment->parcel['city']
                    ],
                    'postage_label' => [
                        'id' => $shipment->postage_label['id'],
                        'object' => $shipment->postage_label['object'], 
                        'created_at' => $shipment->postage_label['created_at'], 
                        'updated_at' => $shipment->postage_label['updated_at'], 
                        'date_advance' => $shipment->postage_label['date_advance'], 
                        'integrated_form' => $shipment->postage_label['integrated_form'], 
                        'label_date' => $shipment->postage_label['label_date'], 
                        'label_resolution' => $shipment->postage_label['label_resolution'], 
                        'label_size' => $shipment->postage_label['label_size'], 
                        'label_type' => $shipment->postage_label['label_type'],
                        'label_file_type' => $shipment->postage_label['label_file_type'],
                        'label_url' => $shipment->postage_label['label_url'],
                        'label_pdf_url' => $shipment->postage_label['label_pdf_url'],
                        'label_zpl_url' => $shipment->postage_label['label_zpl_url'],
                        'label_epl2_url' => $shipment->postage_label['label_epl2_url'],
                        'label_file' => $shipment->postage_label['label_file'],
                    ],
                    'rates'=>  $all_rates,
                    'refund_status' => $shipment->refund_status, 
                    'scan_form' => $shipment->scan_form, 
                    'selected_rate' => [
                        'id' => $shipment->selected_rate['id'],
                        'object' => $shipment->selected_rate['object'], 
                        'created_at' => $shipment->selected_rate['created_at'], 
                        'updated_at' => $shipment->selected_rate['updated_at'], 
                        'mode' => $shipment->selected_rate['mode'], 
                        'service' => $shipment->selected_rate['service'], 
                        'carrier' => $shipment->selected_rate['carrier'], 
                        'rate' => $shipment->selected_rate['rate'], 
                        'currency' => $shipment->selected_rate['currency'], 
                        'retail_rate' => $shipment->selected_rate['retail_rate'],
                        'retail_currency' => $shipment->selected_rate['retail_currency'],
                        'list_rate' => $shipment->selected_rate['list_rate'],
                        'list_currency' => $shipment->selected_rate['list_currency'],
                        'delivery_days' => $shipment->selected_rate['delivery_days'],
                        'delivery_date' => $shipment->selected_rate['delivery_date'],
                        'delivery_date_guaranteed' => $shipment->selected_rate['delivery_date_guaranteed'],
                        'est_delivery_days' => $shipment->selected_rate['est_delivery_days'],
                        'shipment_id' => $shipment->selected_rate['shipment_id'],
                        'carrier_account_id' => $shipment->selected_rate['carrier_account_id']
                    ],
                    'tracker' => [
                        'id' => $shipment->tracker['id'],
                        'object' => $shipment->tracker['object'], 
                        'mode' => $shipment->tracker['mode'], 
                        'tracking_code' => $shipment->tracker['tracking_code'], 
                        'status' => $shipment->tracker['status'], 
                        'status_detail' => $shipment->tracker['status_detail'], 
                        'created_at' => $shipment->tracker['created_at'], 
                        'updated_at' => $shipment->tracker['updated_at'], 
                        'signed_by' => $shipment->tracker['signed_by'], 
                        'weight' => $shipment->tracker['weight'],
                        'est_delivery_date' => $shipment->tracker['est_delivery_date'],
                        'shipment_id' => $shipment->tracker['shipment_id'],
                        'carrier' => $shipment->tracker['carrier'],
                        'tracking_details' => $shipment->tracker['tracking_details'],
                        'fees' => $shipment->tracker['fees'],
                        'carrier_detail' => $shipment->tracker['carrier_detail'],
                        'public_url' => $shipment->tracker['public_url']
                    ],
                    'to_address' => [
                        'id' => $shipment->to_address['id'],
                        'object' => $shipment->to_address['object'], 
                        'created_at' => $shipment->to_address['created_at'], 
                        'updated_at' => $shipment->to_address['updated_at'], 
                        'name' => $shipment->to_address['name'], 
                        'company' => $shipment->to_address['company'], 
                        'street1' => $shipment->to_address['street1'], 
                        'street2' => $shipment->to_address['street2'], 
                        'city' => $shipment->to_address['city'], 
                        'state' => $shipment->to_address['state'], 
                        'zip' => $shipment->to_address['zip'], 
                        'country' => $shipment->to_address['country'], 
                        'phone' => $shipment->to_address['phone'], 
                        'email' => $shipment->to_address['email'], 
                        'mode' => $shipment->to_address['mode'], 
                        'carrier_facility' => $shipment->to_address['carrier_facility'],
                        'residential' => $shipment->to_address['residential'], 
                        'federal_tax_id' => $shipment->to_address['federal_tax_id'],
                        'state_tax_id' => $shipment->to_address['state_tax_id'],
                        'verifications' => $shipment->to_address['verifications'],
                    ],
                    'usps_zone' => $shipment->usps_zone,
                    'return_address' => [
                        'id' => $shipment->return_address['id'],
                        'object' => $shipment->return_address['object'], 
                        'created_at' => $shipment->return_address['created_at'], 
                        'updated_at' => $shipment->return_address['updated_at'], 
                        'name' => $shipment->return_address['name'], 
                        'company' => $shipment->return_address['company'], 
                        'street1' => $shipment->return_address['street1'], 
                        'street2' => $shipment->return_address['street2'], 
                        'city' => $shipment->return_address['city'], 
                        'state' => $shipment->return_address['state'], 
                        'zip' => $shipment->return_address['zip'], 
                        'country' => $shipment->return_address['country'], 
                        'phone' => $shipment->return_address['phone'], 
                        'email' => $shipment->return_address['email'], 
                        'mode' => $shipment->return_address['mode'], 
                        'carrier_facility' => $shipment->return_address['carrier_facility'],
                        'residential' => $shipment->return_address['residential'], 
                        'federal_tax_id' => $shipment->return_address['federal_tax_id'],
                        'state_tax_id' => $shipment->return_address['state_tax_id'],
                        'verifications' => $shipment->return_address['verifications'],
                    ],
                    'buyer_address' => [
                        'id' => $shipment->buyer_address['id'],
                        'object' => $shipment->buyer_address['object'], 
                        'created_at' => $shipment->buyer_address['created_at'], 
                        'updated_at' => $shipment->buyer_address['updated_at'], 
                        'name' => $shipment->buyer_address['name'], 
                        'company' => $shipment->buyer_address['company'], 
                        'street1' => $shipment->buyer_address['street1'], 
                        'street2' => $shipment->buyer_address['street2'], 
                        'city' => $shipment->buyer_address['city'], 
                        'state' => $shipment->buyer_address['state'], 
                        'zip' => $shipment->buyer_address['zip'], 
                        'country' => $shipment->buyer_address['country'], 
                        'phone' => $shipment->buyer_address['phone'], 
                        'email' => $shipment->buyer_address['email'], 
                        'mode' => $shipment->buyer_address['mode'], 
                        'carrier_facility' => $shipment->buyer_address['carrier_facility'],
                        'residential' => $shipment->buyer_address['residential'], 
                        'federal_tax_id' => $shipment->buyer_address['federal_tax_id'],
                        'state_tax_id' => $shipment->buyer_address['state_tax_id'],
                        'verifications' => $shipment->buyer_address['verifications'],
                    ],
                    'forms' => $shipment->forms,
                    'fees' => $all_fees,
                    'object' => $shipment->object,
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function listshipment(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $page_size = $request->input('page_size');
        $start_datetime = date(DATE_ATOM, strtotime($request->input('start_datetime')));
        
        //dd($start_datetime);
        
        $shipments = \EasyPost\Shipment::all(array(
          "page_size" => $page_size,
          "start_datetime" => $start_datetime
        ));
        
        //dd($shipments);
        
        foreach ($shipments->shipments as $shipment) {
            foreach ($shipment->rates as $rate) {
              $all_rates[] = array ( 
                'id' => $rate->id,
                'object' => $rate->object,
                'created_at' => $rate->created_at,
                'updated_at' => $rate->updated_at,
                'mode' => $rate->mode,
                'service' => $rate->service,
                'carrier' => $rate->carrier,
                'rate' => $rate->rate,
                'currency' => $rate->currency,
                'retail_rate' => $rate->retail_rate,
                'retail_currency' => $rate->retail_currency,
                'list_rate' => $rate->list_rate,
                'list_currency' => $rate->list_currency,
                'delivery_days' => $rate->delivery_days,
                'delivery_date' => $rate->delivery_date,
                'delivery_date_guaranteed' => $rate->delivery_date_guaranteed,
                'est_delivery_days' => $rate->est_delivery_days,
                'shipment_id' => $rate->shipment_id,
                'carrier_account_id' => $rate->carrier_account_id,
              );
            }
        }
        
        foreach ($shipments->shipments as $shipment) {
            foreach ($shipment->fees as $fee) {
              $all_fees[] = array ( 
                'object' => $fee->object, 
                'type' => $fee->type, 
                'amount' => $fee->amount, 
                'charged' => $fee->charged, 
                'refunded' => $fee->refunded
              );
            }
        }
        
        foreach ($shipments->shipments as $shipment) {
            foreach ($shipment->messages as $message) {
              $all_messages[] = array ( 
                'carrier' => $message->carrier,
                'carrier_account_id' => $message->carrier_account_id,
                'type' => $message->type,
                'message' => $message->message,
              );
            }
        }
        
        foreach ($shipments->shipments as $shipment) {
          $all_shipment[] = array ( 
            'id' => $shipment->id, 
            'created_at' => $shipment->created_at, 
            'is_return' => $shipment->is_return, 
            'messages' => $all_messages,
            'mode' => $shipment->mode, 
            'options' => [
                'currency' => $shipment->options['currency'],
                'payment' => $shipment->options['payment']['type'],
                'date_advance' => $shipment->options['date_advance'],
            ],
            'reference' => $shipment->reference, 
            'status' => $shipment->status, 
            'tracking_code' => $shipment->tracking_code, 
            'updated_at' => $shipment->updated_at, 
            'batch_id' => $shipment->batch_id, 
            'batch_status' => $shipment->batch_status, 
            'batch_message' => $shipment->batch_message, 
            'customs_info' => $shipment->customs_info, 
            'from_address' => [
                'id' => $shipment->from_address['id'],
                'object' => $shipment->from_address['object'], 
                'created_at' => $shipment->from_address['created_at'], 
                'updated_at' => $shipment->from_address['updated_at'], 
                'name' => $shipment->from_address['name'], 
                'company' => $shipment->from_address['company'], 
                'street1' => $shipment->from_address['street1'], 
                'street2' => $shipment->from_address['street2'], 
                'city' => $shipment->from_address['city'], 
                'state' => $shipment->from_address['state'], 
                'zip' => $shipment->from_address['zip'], 
                'country' => $shipment->from_address['country'], 
                'phone' => $shipment->from_address['phone'], 
                'email' => $shipment->from_address['email'], 
                'mode' => $shipment->from_address['mode'], 
                'carrier_facility' => $shipment->from_address['carrier_facility'],
                'residential' => $shipment->from_address['residential'], 
                'federal_tax_id' => $shipment->from_address['federal_tax_id'],
                'state_tax_id' => $shipment->from_address['state_tax_id'],
                'verifications' => $shipment->from_address['verifications'],
            ],
            'insurance' => $shipment->insurance, 
            'order_id' => $shipment->order_id, 
            'parcel' => [
                'id' => $shipment->parcel['id'],
                'object' => $shipment->parcel['object'], 
                'created_at' => $shipment->parcel['created_at'], 
                'updated_at' => $shipment->parcel['updated_at'], 
                'length' => $shipment->parcel['length'], 
                'width' => $shipment->parcel['width'], 
                'height' => $shipment->parcel['height'], 
                'predefined_package' => $shipment->parcel['predefined_package'], 
                'weight' => $shipment->parcel['weight'], 
                'city' => $shipment->parcel['city']
            ],
            'postage_label' => [
                'id' => $shipment->postage_label['id'],
                'object' => $shipment->postage_label['object'], 
                'created_at' => $shipment->postage_label['created_at'], 
                'updated_at' => $shipment->postage_label['updated_at'], 
                'date_advance' => $shipment->postage_label['date_advance'], 
                'integrated_form' => $shipment->postage_label['integrated_form'], 
                'label_date' => $shipment->postage_label['label_date'], 
                'label_resolution' => $shipment->postage_label['label_resolution'], 
                'label_size' => $shipment->postage_label['label_size'], 
                'label_type' => $shipment->postage_label['label_type'],
                'label_file_type' => $shipment->postage_label['label_file_type'],
                'label_url' => $shipment->postage_label['label_url'],
                'label_pdf_url' => $shipment->postage_label['label_pdf_url'],
                'label_zpl_url' => $shipment->postage_label['label_zpl_url'],
                'label_epl2_url' => $shipment->postage_label['label_epl2_url'],
                'label_file' => $shipment->postage_label['label_file'],
            ],
            'rates'=>  $all_rates,
            'refund_status' => $shipment->refund_status, 
            'scan_form' => $shipment->scan_form, 
            'selected_rate' => [
                'id' => $shipment->selected_rate['id'],
                'object' => $shipment->selected_rate['object'], 
                'created_at' => $shipment->selected_rate['created_at'], 
                'updated_at' => $shipment->selected_rate['updated_at'], 
                'mode' => $shipment->selected_rate['mode'], 
                'service' => $shipment->selected_rate['service'], 
                'carrier' => $shipment->selected_rate['carrier'], 
                'rate' => $shipment->selected_rate['rate'], 
                'currency' => $shipment->selected_rate['currency'], 
                'retail_rate' => $shipment->selected_rate['retail_rate'],
                'retail_currency' => $shipment->selected_rate['retail_currency'],
                'list_rate' => $shipment->selected_rate['list_rate'],
                'list_currency' => $shipment->selected_rate['list_currency'],
                'delivery_days' => $shipment->selected_rate['delivery_days'],
                'delivery_date' => $shipment->selected_rate['delivery_date'],
                'delivery_date_guaranteed' => $shipment->selected_rate['delivery_date_guaranteed'],
                'est_delivery_days' => $shipment->selected_rate['est_delivery_days'],
                'shipment_id' => $shipment->selected_rate['shipment_id'],
                'carrier_account_id' => $shipment->selected_rate['carrier_account_id']
            ],
            'tracker' => [
                'id' => $shipment->tracker['id'],
                'object' => $shipment->tracker['object'], 
                'mode' => $shipment->tracker['mode'], 
                'tracking_code' => $shipment->tracker['tracking_code'], 
                'status' => $shipment->tracker['status'], 
                'status_detail' => $shipment->tracker['status_detail'], 
                'created_at' => $shipment->tracker['created_at'], 
                'updated_at' => $shipment->tracker['updated_at'], 
                'signed_by' => $shipment->tracker['signed_by'], 
                'weight' => $shipment->tracker['weight'],
                'est_delivery_date' => $shipment->tracker['est_delivery_date'],
                'shipment_id' => $shipment->tracker['shipment_id'],
                'carrier' => $shipment->tracker['carrier'],
                'tracking_details' => $shipment->tracker['tracking_details'],
                'fees' => $shipment->tracker['fees'],
                'carrier_detail' => $shipment->tracker['carrier_detail'],
                'public_url' => $shipment->tracker['public_url']
            ],
            'to_address' => [
                'id' => $shipment->to_address['id'],
                'object' => $shipment->to_address['object'], 
                'created_at' => $shipment->to_address['created_at'], 
                'updated_at' => $shipment->to_address['updated_at'], 
                'name' => $shipment->to_address['name'], 
                'company' => $shipment->to_address['company'], 
                'street1' => $shipment->to_address['street1'], 
                'street2' => $shipment->to_address['street2'], 
                'city' => $shipment->to_address['city'], 
                'state' => $shipment->to_address['state'], 
                'zip' => $shipment->to_address['zip'], 
                'country' => $shipment->to_address['country'], 
                'phone' => $shipment->to_address['phone'], 
                'email' => $shipment->to_address['email'], 
                'mode' => $shipment->to_address['mode'], 
                'carrier_facility' => $shipment->to_address['carrier_facility'],
                'residential' => $shipment->to_address['residential'], 
                'federal_tax_id' => $shipment->to_address['federal_tax_id'],
                'state_tax_id' => $shipment->to_address['state_tax_id'],
                'verifications' => $shipment->to_address['verifications'],
            ],
            'usps_zone' => $shipment->usps_zone,
            'return_address' => [
                'id' => $shipment->return_address['id'],
                'object' => $shipment->return_address['object'], 
                'created_at' => $shipment->return_address['created_at'], 
                'updated_at' => $shipment->return_address['updated_at'], 
                'name' => $shipment->return_address['name'], 
                'company' => $shipment->return_address['company'], 
                'street1' => $shipment->return_address['street1'], 
                'street2' => $shipment->return_address['street2'], 
                'city' => $shipment->return_address['city'], 
                'state' => $shipment->return_address['state'], 
                'zip' => $shipment->return_address['zip'], 
                'country' => $shipment->return_address['country'], 
                'phone' => $shipment->return_address['phone'], 
                'email' => $shipment->return_address['email'], 
                'mode' => $shipment->return_address['mode'], 
                'carrier_facility' => $shipment->return_address['carrier_facility'],
                'residential' => $shipment->return_address['residential'], 
                'federal_tax_id' => $shipment->return_address['federal_tax_id'],
                'state_tax_id' => $shipment->return_address['state_tax_id'],
                'verifications' => $shipment->return_address['verifications'],
            ],
            'buyer_address' => [
                'id' => $shipment->buyer_address['id'],
                'object' => $shipment->buyer_address['object'], 
                'created_at' => $shipment->buyer_address['created_at'], 
                'updated_at' => $shipment->buyer_address['updated_at'], 
                'name' => $shipment->buyer_address['name'], 
                'company' => $shipment->buyer_address['company'], 
                'street1' => $shipment->buyer_address['street1'], 
                'street2' => $shipment->buyer_address['street2'], 
                'city' => $shipment->buyer_address['city'], 
                'state' => $shipment->buyer_address['state'], 
                'zip' => $shipment->buyer_address['zip'], 
                'country' => $shipment->buyer_address['country'], 
                'phone' => $shipment->buyer_address['phone'], 
                'email' => $shipment->buyer_address['email'], 
                'mode' => $shipment->buyer_address['mode'], 
                'carrier_facility' => $shipment->buyer_address['carrier_facility'],
                'residential' => $shipment->buyer_address['residential'], 
                'federal_tax_id' => $shipment->buyer_address['federal_tax_id'],
                'state_tax_id' => $shipment->buyer_address['state_tax_id'],
                'verifications' => $shipment->buyer_address['verifications'],
            ],
            'forms' => $shipment->forms,
            'fees' => $all_fees,
            'object' => $shipment->object,
          );
        }
        
        //print_r($all_fees);
        
        //dd($shipments);
        
        if($shipments){
            #send response
            return response()->json([
                'message'=>'All Shipments.',
                'code'=>200,
                'data'=>$all_shipment,
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function getshipment(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $shipment_id = $request->input('shipment_id');
        
        $shipment = \EasyPost\Shipment::retrieve($shipment_id);
        
        //dd($shipment);
        
        foreach ($shipment->rates as $rate) {
          $all_rates[] = array ( 
            'id' => $rate->id,
            'object' => $rate->object,
            'created_at' => $rate->created_at,
            'updated_at' => $rate->updated_at,
            'mode' => $rate->mode,
            'service' => $rate->service,
            'carrier' => $rate->carrier,
            'rate' => $rate->rate,
            'currency' => $rate->currency,
            'retail_rate' => $rate->retail_rate,
            'retail_currency' => $rate->retail_currency,
            'list_rate' => $rate->list_rate,
            'list_currency' => $rate->list_currency,
            'delivery_days' => $rate->delivery_days,
            'delivery_date' => $rate->delivery_date,
            'delivery_date_guaranteed' => $rate->delivery_date_guaranteed,
            'est_delivery_days' => $rate->est_delivery_days,
            'shipment_id' => $rate->shipment_id,
            'carrier_account_id' => $rate->carrier_account_id,
          );
        }
        
        foreach ($shipment->fees as $fee) {
          $all_fees[] = array ( 
            'object' => $fee->object, 
            'type' => $fee->type, 
            'amount' => $fee->amount, 
            'charged' => $fee->charged, 
            'refunded' => $fee->refunded
          );
        }
        
        foreach ($shipment->messages as $message) {
          $all_messages[] = array ( 
            'carrier' => $message->carrier,
            'carrier_account_id' => $message->carrier_account_id,
            'type' => $message->type,
            'message' => $message->message,
          );
        }
        
        //dd($shipment);
        
        if($shipment){
            #send response
            return response()->json([
                'message'=>'Shipment Details.',
                'code'=>200,
                'data'=>[
                    'id' => $shipment->id, 
                    'created_at' => $shipment->created_at, 
                    'is_return' => $shipment->is_return, 
                    'messages' => $all_messages,
                    'mode' => $shipment->mode, 
                    'options' => [
                        'currency' => $shipment->options['currency'],
                        'payment' => $shipment->options['payment']['type'],
                        'date_advance' => $shipment->options['date_advance'],
                    ],
                    'reference' => $shipment->reference, 
                    'status' => $shipment->status, 
                    'tracking_code' => $shipment->tracking_code, 
                    'updated_at' => $shipment->updated_at, 
                    'batch_id' => $shipment->batch_id, 
                    'batch_status' => $shipment->batch_status, 
                    'batch_message' => $shipment->batch_message, 
                    'customs_info' => $shipment->customs_info, 
                    'from_address' => [
                        'id' => $shipment->from_address['id'],
                        'object' => $shipment->from_address['object'], 
                        'created_at' => $shipment->from_address['created_at'], 
                        'updated_at' => $shipment->from_address['updated_at'], 
                        'name' => $shipment->from_address['name'], 
                        'company' => $shipment->from_address['company'], 
                        'street1' => $shipment->from_address['street1'], 
                        'street2' => $shipment->from_address['street2'], 
                        'city' => $shipment->from_address['city'], 
                        'state' => $shipment->from_address['state'], 
                        'zip' => $shipment->from_address['zip'], 
                        'country' => $shipment->from_address['country'], 
                        'phone' => $shipment->from_address['phone'], 
                        'email' => $shipment->from_address['email'], 
                        'mode' => $shipment->from_address['mode'], 
                        'carrier_facility' => $shipment->from_address['carrier_facility'],
                        'residential' => $shipment->from_address['residential'], 
                        'federal_tax_id' => $shipment->from_address['federal_tax_id'],
                        'state_tax_id' => $shipment->from_address['state_tax_id'],
                        'verifications' => $shipment->from_address['verifications'],
                    ],
                    'insurance' => $shipment->insurance, 
                    'order_id' => $shipment->order_id, 
                    'parcel' => [
                        'id' => $shipment->parcel['id'],
                        'object' => $shipment->parcel['object'], 
                        'created_at' => $shipment->parcel['created_at'], 
                        'updated_at' => $shipment->parcel['updated_at'], 
                        'length' => $shipment->parcel['length'], 
                        'width' => $shipment->parcel['width'], 
                        'height' => $shipment->parcel['height'], 
                        'predefined_package' => $shipment->parcel['predefined_package'], 
                        'weight' => $shipment->parcel['weight'], 
                        'city' => $shipment->parcel['city']
                    ],
                    'postage_label' => [
                        'id' => $shipment->postage_label['id'],
                        'object' => $shipment->postage_label['object'], 
                        'created_at' => $shipment->postage_label['created_at'], 
                        'updated_at' => $shipment->postage_label['updated_at'], 
                        'date_advance' => $shipment->postage_label['date_advance'], 
                        'integrated_form' => $shipment->postage_label['integrated_form'], 
                        'label_date' => $shipment->postage_label['label_date'], 
                        'label_resolution' => $shipment->postage_label['label_resolution'], 
                        'label_size' => $shipment->postage_label['label_size'], 
                        'label_type' => $shipment->postage_label['label_type'],
                        'label_file_type' => $shipment->postage_label['label_file_type'],
                        'label_url' => $shipment->postage_label['label_url'],
                        'label_pdf_url' => $shipment->postage_label['label_pdf_url'],
                        'label_zpl_url' => $shipment->postage_label['label_zpl_url'],
                        'label_epl2_url' => $shipment->postage_label['label_epl2_url'],
                        'label_file' => $shipment->postage_label['label_file'],
                    ], 
                    'rates'=>  $all_rates,
                    'refund_status' => $shipment->refund_status, 
                    'scan_form' => $shipment->scan_form, 
                    'selected_rate' => [
                        'id' => $shipment->selected_rate['id'],
                        'object' => $shipment->selected_rate['object'], 
                        'created_at' => $shipment->selected_rate['created_at'], 
                        'updated_at' => $shipment->selected_rate['updated_at'], 
                        'mode' => $shipment->selected_rate['mode'], 
                        'service' => $shipment->selected_rate['service'], 
                        'carrier' => $shipment->selected_rate['carrier'], 
                        'rate' => $shipment->selected_rate['rate'], 
                        'currency' => $shipment->selected_rate['currency'], 
                        'retail_rate' => $shipment->selected_rate['retail_rate'],
                        'retail_currency' => $shipment->selected_rate['retail_currency'],
                        'list_rate' => $shipment->selected_rate['list_rate'],
                        'list_currency' => $shipment->selected_rate['list_currency'],
                        'delivery_days' => $shipment->selected_rate['delivery_days'],
                        'delivery_date' => $shipment->selected_rate['delivery_date'],
                        'delivery_date_guaranteed' => $shipment->selected_rate['delivery_date_guaranteed'],
                        'est_delivery_days' => $shipment->selected_rate['est_delivery_days'],
                        'shipment_id' => $shipment->selected_rate['shipment_id'],
                        'carrier_account_id' => $shipment->selected_rate['carrier_account_id']
                    ],
                    'tracker' => [
                        'id' => $shipment->tracker['id'],
                        'object' => $shipment->tracker['object'], 
                        'mode' => $shipment->tracker['mode'], 
                        'tracking_code' => $shipment->tracker['tracking_code'], 
                        'status' => $shipment->tracker['status'], 
                        'status_detail' => $shipment->tracker['status_detail'], 
                        'created_at' => $shipment->tracker['created_at'], 
                        'updated_at' => $shipment->tracker['updated_at'], 
                        'signed_by' => $shipment->tracker['signed_by'], 
                        'weight' => $shipment->tracker['weight'],
                        'est_delivery_date' => $shipment->tracker['est_delivery_date'],
                        'shipment_id' => $shipment->tracker['shipment_id'],
                        'carrier' => $shipment->tracker['carrier'],
                        'tracking_details' => $shipment->tracker['tracking_details'],
                        'fees' => $shipment->tracker['fees'],
                        'carrier_detail' => $shipment->tracker['carrier_detail'],
                        'public_url' => $shipment->tracker['public_url']
                    ],
                    'to_address' => [
                        'id' => $shipment->to_address['id'],
                        'object' => $shipment->to_address['object'], 
                        'created_at' => $shipment->to_address['created_at'], 
                        'updated_at' => $shipment->to_address['updated_at'], 
                        'name' => $shipment->to_address['name'], 
                        'company' => $shipment->to_address['company'], 
                        'street1' => $shipment->to_address['street1'], 
                        'street2' => $shipment->to_address['street2'], 
                        'city' => $shipment->to_address['city'], 
                        'state' => $shipment->to_address['state'], 
                        'zip' => $shipment->to_address['zip'], 
                        'country' => $shipment->to_address['country'], 
                        'phone' => $shipment->to_address['phone'], 
                        'email' => $shipment->to_address['email'], 
                        'mode' => $shipment->to_address['mode'], 
                        'carrier_facility' => $shipment->to_address['carrier_facility'],
                        'residential' => $shipment->to_address['residential'], 
                        'federal_tax_id' => $shipment->to_address['federal_tax_id'],
                        'state_tax_id' => $shipment->to_address['state_tax_id'],
                        'verifications' => $shipment->to_address['verifications'],
                    ],
                    'usps_zone' => $shipment->usps_zone,
                    'return_address' => [
                        'id' => $shipment->return_address['id'],
                        'object' => $shipment->return_address['object'], 
                        'created_at' => $shipment->return_address['created_at'], 
                        'updated_at' => $shipment->return_address['updated_at'], 
                        'name' => $shipment->return_address['name'], 
                        'company' => $shipment->return_address['company'], 
                        'street1' => $shipment->return_address['street1'], 
                        'street2' => $shipment->return_address['street2'], 
                        'city' => $shipment->return_address['city'], 
                        'state' => $shipment->return_address['state'], 
                        'zip' => $shipment->return_address['zip'], 
                        'country' => $shipment->return_address['country'], 
                        'phone' => $shipment->return_address['phone'], 
                        'email' => $shipment->return_address['email'], 
                        'mode' => $shipment->return_address['mode'], 
                        'carrier_facility' => $shipment->return_address['carrier_facility'],
                        'residential' => $shipment->return_address['residential'], 
                        'federal_tax_id' => $shipment->return_address['federal_tax_id'],
                        'state_tax_id' => $shipment->return_address['state_tax_id'],
                        'verifications' => $shipment->return_address['verifications'],
                    ],
                    'buyer_address' => [
                        'id' => $shipment->buyer_address['id'],
                        'object' => $shipment->buyer_address['object'], 
                        'created_at' => $shipment->buyer_address['created_at'], 
                        'updated_at' => $shipment->buyer_address['updated_at'], 
                        'name' => $shipment->buyer_address['name'], 
                        'company' => $shipment->buyer_address['company'], 
                        'street1' => $shipment->buyer_address['street1'], 
                        'street2' => $shipment->buyer_address['street2'], 
                        'city' => $shipment->buyer_address['city'], 
                        'state' => $shipment->buyer_address['state'], 
                        'zip' => $shipment->buyer_address['zip'], 
                        'country' => $shipment->buyer_address['country'], 
                        'phone' => $shipment->buyer_address['phone'], 
                        'email' => $shipment->buyer_address['email'], 
                        'mode' => $shipment->buyer_address['mode'], 
                        'carrier_facility' => $shipment->buyer_address['carrier_facility'],
                        'residential' => $shipment->buyer_address['residential'], 
                        'federal_tax_id' => $shipment->buyer_address['federal_tax_id'],
                        'state_tax_id' => $shipment->buyer_address['state_tax_id'],
                        'verifications' => $shipment->buyer_address['verifications'],
                    ],
                    'forms' => $shipment->forms,
                    'fees' => $all_fees,
                    'object' => $shipment->object,
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function insurance(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $shipment_id = $request->input('shipment_id');
        
        $shipment = \EasyPost\Shipment::retrieve($shipment_id);
        $shipment->insure(array(
            'amount' => $request->input('amount')
        ));
        
        //dd($shipment);
        
        foreach ($shipment->rates as $rate) {
          $all_rates[] = array ( 
            'id' => $rate->id,
            'object' => $rate->object,
            'created_at' => $rate->created_at,
            'updated_at' => $rate->updated_at,
            'mode' => $rate->mode,
            'service' => $rate->service,
            'carrier' => $rate->carrier,
            'rate' => $rate->rate,
            'currency' => $rate->currency,
            'retail_rate' => $rate->retail_rate,
            'retail_currency' => $rate->retail_currency,
            'list_rate' => $rate->list_rate,
            'list_currency' => $rate->list_currency,
            'delivery_days' => $rate->delivery_days,
            'delivery_date' => $rate->delivery_date,
            'delivery_date_guaranteed' => $rate->delivery_date_guaranteed,
            'est_delivery_days' => $rate->est_delivery_days,
            'shipment_id' => $rate->shipment_id,
            'carrier_account_id' => $rate->carrier_account_id,
          );
        }
        
        foreach ($shipment->fees as $fee) {
          $all_fees[] = array ( 
            'object' => $fee->object, 
            'type' => $fee->type, 
            'amount' => $fee->amount, 
            'charged' => $fee->charged, 
            'refunded' => $fee->refunded
          );
        }
        
        foreach ($shipment->messages as $message) {
          $all_messages[] = array ( 
            'carrier' => $message->carrier,
            'carrier_account_id' => $message->carrier_account_id,
            'type' => $message->type,
            'message' => $message->message,
          );
        }
        
        //dd($shipment);
        
        if($shipment){
            #send response
            return response()->json([
                'message'=>'Shipment Details.',
                'code'=>200,
                'data'=>[
                    'id' => $shipment->id, 
                    'created_at' => $shipment->created_at, 
                    'is_return' => $shipment->is_return, 
                    'messages' => $all_messages,
                    'mode' => $shipment->mode, 
                    'options' => [
                        'currency' => $shipment->options['currency'],
                        'payment' => $shipment->options['payment']['type'],
                        'date_advance' => $shipment->options['date_advance'],
                    ],
                    'reference' => $shipment->reference, 
                    'status' => $shipment->status, 
                    'tracking_code' => $shipment->tracking_code, 
                    'updated_at' => $shipment->updated_at, 
                    'batch_id' => $shipment->batch_id, 
                    'batch_status' => $shipment->batch_status, 
                    'batch_message' => $shipment->batch_message, 
                    'customs_info' => $shipment->customs_info, 
                    'from_address' => [
                        'id' => $shipment->from_address['id'],
                        'object' => $shipment->from_address['object'], 
                        'created_at' => $shipment->from_address['created_at'], 
                        'updated_at' => $shipment->from_address['updated_at'], 
                        'name' => $shipment->from_address['name'], 
                        'company' => $shipment->from_address['company'], 
                        'street1' => $shipment->from_address['street1'], 
                        'street2' => $shipment->from_address['street2'], 
                        'city' => $shipment->from_address['city'], 
                        'state' => $shipment->from_address['state'], 
                        'zip' => $shipment->from_address['zip'], 
                        'country' => $shipment->from_address['country'], 
                        'phone' => $shipment->from_address['phone'], 
                        'email' => $shipment->from_address['email'], 
                        'mode' => $shipment->from_address['mode'], 
                        'carrier_facility' => $shipment->from_address['carrier_facility'],
                        'residential' => $shipment->from_address['residential'], 
                        'federal_tax_id' => $shipment->from_address['federal_tax_id'],
                        'state_tax_id' => $shipment->from_address['state_tax_id'],
                        'verifications' => $shipment->from_address['verifications'],
                    ],
                    'insurance' => $shipment->insurance, 
                    'order_id' => $shipment->order_id, 
                    'parcel' => [
                        'id' => $shipment->parcel['id'],
                        'object' => $shipment->parcel['object'], 
                        'created_at' => $shipment->parcel['created_at'], 
                        'updated_at' => $shipment->parcel['updated_at'], 
                        'length' => $shipment->parcel['length'], 
                        'width' => $shipment->parcel['width'], 
                        'height' => $shipment->parcel['height'], 
                        'predefined_package' => $shipment->parcel['predefined_package'], 
                        'weight' => $shipment->parcel['weight'], 
                        'city' => $shipment->parcel['city']
                    ],
                    'postage_label' => $shipment->postage_label, 
                    'rates'=>  $all_rates,
                    'refund_status' => $shipment->refund_status, 
                    'scan_form' => $shipment->scan_form, 
                    'selected_rate' => $shipment->selected_rate, 
                    'tracker' => $shipment->tracker,
                    'to_address' => [
                        'id' => $shipment->to_address['id'],
                        'object' => $shipment->to_address['object'], 
                        'created_at' => $shipment->to_address['created_at'], 
                        'updated_at' => $shipment->to_address['updated_at'], 
                        'name' => $shipment->to_address['name'], 
                        'company' => $shipment->to_address['company'], 
                        'street1' => $shipment->to_address['street1'], 
                        'street2' => $shipment->to_address['street2'], 
                        'city' => $shipment->to_address['city'], 
                        'state' => $shipment->to_address['state'], 
                        'zip' => $shipment->to_address['zip'], 
                        'country' => $shipment->to_address['country'], 
                        'phone' => $shipment->to_address['phone'], 
                        'email' => $shipment->to_address['email'], 
                        'mode' => $shipment->to_address['mode'], 
                        'carrier_facility' => $shipment->to_address['carrier_facility'],
                        'residential' => $shipment->to_address['residential'], 
                        'federal_tax_id' => $shipment->to_address['federal_tax_id'],
                        'state_tax_id' => $shipment->to_address['state_tax_id'],
                        'verifications' => $shipment->to_address['verifications'],
                    ],
                    'usps_zone' => $shipment->usps_zone,
                    'return_address' => [
                        'id' => $shipment->return_address['id'],
                        'object' => $shipment->return_address['object'], 
                        'created_at' => $shipment->return_address['created_at'], 
                        'updated_at' => $shipment->return_address['updated_at'], 
                        'name' => $shipment->return_address['name'], 
                        'company' => $shipment->return_address['company'], 
                        'street1' => $shipment->return_address['street1'], 
                        'street2' => $shipment->return_address['street2'], 
                        'city' => $shipment->return_address['city'], 
                        'state' => $shipment->return_address['state'], 
                        'zip' => $shipment->return_address['zip'], 
                        'country' => $shipment->return_address['country'], 
                        'phone' => $shipment->return_address['phone'], 
                        'email' => $shipment->return_address['email'], 
                        'mode' => $shipment->return_address['mode'], 
                        'carrier_facility' => $shipment->return_address['carrier_facility'],
                        'residential' => $shipment->return_address['residential'], 
                        'federal_tax_id' => $shipment->return_address['federal_tax_id'],
                        'state_tax_id' => $shipment->return_address['state_tax_id'],
                        'verifications' => $shipment->return_address['verifications'],
                    ],
                    'buyer_address' => [
                        'id' => $shipment->buyer_address['id'],
                        'object' => $shipment->buyer_address['object'], 
                        'created_at' => $shipment->buyer_address['created_at'], 
                        'updated_at' => $shipment->buyer_address['updated_at'], 
                        'name' => $shipment->buyer_address['name'], 
                        'company' => $shipment->buyer_address['company'], 
                        'street1' => $shipment->buyer_address['street1'], 
                        'street2' => $shipment->buyer_address['street2'], 
                        'city' => $shipment->buyer_address['city'], 
                        'state' => $shipment->buyer_address['state'], 
                        'zip' => $shipment->buyer_address['zip'], 
                        'country' => $shipment->buyer_address['country'], 
                        'phone' => $shipment->buyer_address['phone'], 
                        'email' => $shipment->buyer_address['email'], 
                        'mode' => $shipment->buyer_address['mode'], 
                        'carrier_facility' => $shipment->buyer_address['carrier_facility'],
                        'residential' => $shipment->buyer_address['residential'], 
                        'federal_tax_id' => $shipment->buyer_address['federal_tax_id'],
                        'state_tax_id' => $shipment->buyer_address['state_tax_id'],
                        'verifications' => $shipment->buyer_address['verifications'],
                    ],
                    'forms' => $shipment->forms,
                    'fees' => $all_fees,
                    'object' => $shipment->object,
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
        
    }
    
    public function tracking(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $tracking_code = $request->input('tracking_code');
        $carrier = $request->input('carrier');
        
        $tracker = \EasyPost\Tracker::create(array(
            'tracking_code' => $tracking_code,
            'carrier' => $carrier
        ));
        
        //dd($tracker);
        
        foreach ($tracker->tracking_details as $details) {
          $all_tracking_details[] = array ( 
            'object' => $details->object,
            'message' => $details->message,
            'description' => $details->description,
            'status' => $details->status,
            'status_detail' => $details->status_detail,
            'datetime' => $details->datetime,
            'source' => $details->source,
            'carrier_code' => $details->carrier_code,
          );
        }
        
        // dd($all_tracking_details);
        
        
        
        //dd($all_carrier_detail);
        
        foreach ($tracker->fees as $fee) {
          $all_fees[] = array ( 
            'object' => $fee->object, 
            'type' => $fee->type, 
            'amount' => $fee->amount, 
            'charged' => $fee->charged, 
            'refunded' => $fee->refunded
          );
        }
        
        if($tracker){
            #send response
            return response()->json([
                'message'=>'Tracking Details.',
                'code'=>200,
                'data'=>[
                    'id' => $tracker->id, 
                    'object' => $tracker->object, 
                    'mode' => $tracker->mode,
                    'tracking_code' => $tracker->tracking_code, 
                    'status' => $tracker->status, 
                    'status_detail' => $tracker->status_detail, 
                    'created_at' => $tracker->created_at, 
                    'updated_at' => $tracker->updated_at, 
                    'signed_by' => $tracker->signed_by, 
                    'weight' => $tracker->weight, 
                    'est_delivery_date' => $tracker->est_delivery_date, 
                    'shipment_id' => $tracker->shipment_id, 
                    'carrier' => $tracker->carrier, 
                    'tracking_details' => $all_tracking_details,
                    'carrier_detail' => [
                        'object' => $tracker->carrier_detail['object'],
                        'service' => $tracker->carrier_detail['service'],
                        'container_type' =>$tracker->carrier_detail['>container_type'],
                        'est_delivery_date_local' => $tracker->carrier_detail['est_delivery_date_local'],
                        'est_delivery_time_local' => $tracker->carrier_detail['est_delivery_time_local'],
                        'origin_location' => $tracker->carrier_detail['origin_location'],
                        'origin_tracking_location' => [
                            'object' => $tracker->carrier_detail['origin_tracking_location']['object'],
                            'city' => $tracker->carrier_detail['origin_tracking_location']['city'],
                            'state' => $tracker->carrier_detail['origin_tracking_location']['state'],
                            'country' => $tracker->carrier_detail['origin_tracking_location']['country'],
                            'zip' => $tracker->carrier_detail['origin_tracking_location']['zip']
                        ],
                        'destination_location' => $tracker->carrier_detail['destination_location'],
                        'destination_tracking_location' => $tracker->carrier_detail['destination_tracking_location'],
                        'guaranteed_delivery_date' => $tracker->carrier_detail['guaranteed_delivery_date'],
                        'alternate_identifier' => $tracker->carrier_detail['alternate_identifier'],
                        'initial_delivery_attempt' => $tracker->carrier_detail['initial_delivery_attempt'],
                    ],
                    'finalized' => $tracker->finalized, 
                    'is_return' => $tracker->is_return, 
                    'public_url' => $tracker->public_url, 
                    'fees' => $all_fees,
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
    public function carriertype(Request $request)
    {
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        // \EasyPost\EasyPost::setApiKey("EZAK4389aea5296f4f149758fee56d5c6256yrwo6IY5Mh096aW6ynLiMg");
        \EasyPost\EasyPost::setApiKey("EZAK4389aea5296f4f149758fee56d5c6256yrwo6IY5Mh096aW6ynLiMg");
        $carrier_types = \EasyPost\CarrierAccount::types();
        
        //dd($carrier_types);
        
        foreach ($carrier_types as $carrier) {
          $all_carriers[] = array ( 
            'object' => $carrier->object, 
            'type' => $carrier->type, 
            'readable' => $carrier->readable, 
            'logo' => $carrier->logo,
            'access_key_id' => $carrier->fields['credentials']['access_key_id'],
            'secret_key' => $carrier->fields['credentials']['secret_key'],
            'merchant_id' => $carrier->fields['credentials']['merchant_id'],
          );
        }
        
        if($carrier_types){
            #send response
            return response()->json([
                'message'=>'Carriers List.',
                'code'=>200,
                'data'=>[
                    'carrier_types' => $all_carriers
                ],
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'message'=>"Something went wrong!",
                'status'=>'error'
            ]);
        }
    }
    
}
