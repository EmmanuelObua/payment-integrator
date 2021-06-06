<?php

namespace BlackJew\Payments\Providers;

use BlackJew\Payments\Interfaces\Collections;
use BlackJew\Payments\Interfaces\Transfers;
use BlackJew\Payments\Support\RequestHandler;

class FlutterWave extends RequestHandler implements Collections, Transfers 
{

	const TRANSFER_ENDPOINT 	= 'transfers';
	const COLLECTION_ENDPOINT 	= 'payments';
	const TRANSCTION_ENDPOINT 	= 'transactions';

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

	public function formatRequest( array $params = [] )
	{

		$headers = $this->headers();

		return [
			'headers' 	=> $headers,
			'json' 		=> $params
		]; 

	}

	public function sendRequest( $request_type, $url, $request = null)
	{

		try{

			/*Send request to the API Resource*/

			$response = $this->client->request( $request_type, $url, $request );

			if($response->getStatusCode() != 200){

				$resp 							= (object)[];

				$resp->statusCode 				= $response->getStatusCode();
				$resp->statusDescription 		= 'Operation failed';
				$resp->body 					= $response->getBody()->getContents();

				return $resp;

			}

			$resp 						= (object)[];

			$resp->statusCode 			= 200;
			$resp->statusDescription 	= 'Operation Successfull';
			$resp->body 				= json_decode($response->body);

			return $resp;

		} catch (\Exception $e){

			/*Return operation Exception*/
			$resp 						= (object)[];

			$resp->statusCode 			= 100;
			$resp->statusDescription 	= $e->getMessage();
			$resp->body 				= 'Sorry, an error occured, please try again ...';

			return $resp;


		}

	}

	public function verifyTransaction($transactionId)
	{

		$request = $this->formatRequest();

		return $this->sendRequest(
			'GET', 
			self::TRANSCTION_ENDPOINT.'/'.$transactionId.'/verify', 
			$request
		);

	}

	public function collect(array $request) 
	{

		$formatedRequest = $this->formatRequest($request);

		$response = $this->sendRequest( 'POST', self::COLLECTION_ENDPOINT, $formatedRequest);

		if ($response->status === 'success') 
			$return['link'] = $response->data->link;
		$return['link'] = NULL;

		return (object)$return;

	}

	public function transfer(array $request) 
	{

		$formatedRequest = $this->formatRequest($request);

		$response = $this->sendRequest( 'POST', self::TRANSFER_ENDPOINT, $formatedRequest);

	}

}

