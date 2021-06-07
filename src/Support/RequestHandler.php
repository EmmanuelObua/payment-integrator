<?php

namespace BlackJew\Payments\Support;

use GuzzleHttp\Client;

abstract class RequestHandler 
{

	protected $token;
	protected $provider;
	protected $client;

	public function __construct($provider, $token)
	{
		$this->provider = $provider;
		$this->token 	= $token;
		$this->client 	= $this->getClient($provider);
	}

	private function getClient($provider)
	{

		if ($provider === 'FLUTTERWAVE') {

			return new Client([
				'verify' 	=> false,
				'base_uri' 	=> 'https://api.flutterwave.com/v3/'
			]);

		} else {
			return '';
		}

	}

	abstract function getProvider();

	abstract function headers();

	abstract function formatRequest( array $params = [] );

	abstract function sendRequest( $request_type/*POST / GET*/, $url, $request = null);

}