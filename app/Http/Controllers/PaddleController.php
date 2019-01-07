<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaddleController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function sendRequest($url, $params)
	{
		$data['vendor_id'] = env('PADDLE_VENDOR_ID', '');
		$data['vendor_auth_code'] = env('PADDLE_VENDOR_AUTH_CODE', '');

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array_merge($data, $params)));
		$response = curl_exec($ch);

		$data = json_decode($response);
		if($data->success) {
			echo "Success! Checkout URL:".$data->response->url;
		} else {
			echo "Your request failed with error: ".$data->error->message;
		}
	}

	public function getPaymentLink($id)
	{
		$data['passthrough'] = Crypt::encryptString($id);
		$data['webhook_url'] = 'http://mysite.com/callback';
		$data['return_url'] = env('PADDLE_RETURN_URL', '');
		$data['title'] = env('PADDLE_TITLE', '');
		$data['prices'] = [
			'USD:'.env('PADDLE_RESUME_PRICE', ''),
		];

		$this->sendRequest('https://vendors.paddle.com/api/2.0/product/generate_pay_link', $data);
	}

	public function getPayedResume(Request $request)
	{
		if($request->passthrough) {
			echo Crypt::decryptString($request->passthrough);
		}
		else print_r($request->all());
	}
}
