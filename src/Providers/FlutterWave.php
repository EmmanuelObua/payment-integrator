<?php

namespace BlackJew\Payments\Providers;

use BlackJew\Payments\Interfaces\Collections;
use BlackJew\Payments\Interfaces\Transfers;

use GuzzleHttp\Client;

class FlutterWave extends BaseProvider implements Collections, Transfers 
{

	const TRANSFER_ENDPOINT 	= 'transfers';
	const COLLECTION_ENDPOINT 	= 'payments';
	const TRANSCTION_ENDPOINT 	= 'transactions';

	public function getProvider()
	{
		return $this->provider;
	}

	public function loadClient($base_url = 'https://api.flutterwave.com/v3/')
	{

		$this->client = new Client([ 'verify' => false, 'base_uri' => $base_url ]);

		return $this;

	}

	public function setToken($token)
	{

		$this->token = $token;

		return $this;

	}

	public function setProvider($provider = 'FLUTTERWAVE')
	{

		$this->provider = $provider;

		return $this;

	}

	public function headers()
	{

		$headers = [
			'Content-Type'	=> 'application/json',
			'Accept'		=> 'application/json',
		];

		/*Get the token instantiated from the RequestHandler Class*/

		$headers['Authorization'] = 'Bearer ' . $this->token;

		return $headers;

	}

	public function formatRequest( array $request = [] )
	{

		$headers = $this->headers();

		return [
			'headers' 	=> $headers,
			'json' 		=> $request
		]; 

	}

	public function sendRequest( $request_type, $url, $request = null)
	{

		$resp = (object)[];

		try{

			/*Send request to the API Resource*/

			$response = $this->client->request( $request_type, $url, $request );

			if($response->getStatusCode() != 200){

				$resp->statusCode 			= $response->getStatusCode();
				$resp->statusDescription 	= 'Operation failed';
				$resp->body 				= $response->getBody()->getContents();

				return $resp;

			}

			$resp->statusCode 			= 200;
			$resp->statusDescription 	= 'Operation Successfull';
			$resp->body 				= json_decode($response->getBody()->getContents());

			return $resp;

		} catch (\Exception $e){

			/*Return operation Exception*/

			$resp->statusCode 			= 100;
			$resp->statusDescription 	= $e->getMessage();
			$resp->body 				= 'Sorry, an error occured, please try again ...';

			return $resp;


		}

	}

	/**/

	public function verifyTransaction($transactionId)
	{

		$request = $this->formatRequest();

		return $this->sendRequest(
			'GET', 
			self::TRANSCTION_ENDPOINT.'/'.$transactionId.'/verify', 
			$request
		);

	}

	/**
	 * collect
	 * Returns the checkout link.
	 */

	public function collect(array $request) 
	{

		$formatedRequest = $this->formatRequest($request);

		$response = $this->sendRequest( 'POST', self::COLLECTION_ENDPOINT, $formatedRequest );

		if ($response->body->status == 'success') {

			$return['link'] 	= $response->body->data->link;
			$return['status'] 	= true;

		} else {

			$return['link'] 	= NULL;
			$return['status'] 	= false;

		}

		return (object)$return;

	}

	/**
	 * transfer
	 * Returns ...
	 */

	public function transfer(array $request) 
	{

		$formatedRequest = $this->formatRequest($request);

		$response = $this->sendRequest( 'POST', self::TRANSFER_ENDPOINT, $formatedRequest);

	}

}

