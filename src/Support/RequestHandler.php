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
        $this->client 	= $provider === 'FLUTTERWAVE' ? 
        				new Client([
        					'verify' 	=> false, 
        					'base_uri' 	=> 'https://api.flutterwave.com/v3/'
        				]) : '';
    }

    abstract function headers();

    abstract function formatRequest( array $params = [] );

    abstract function sendRequest( $request_type/*POST / GET*/, $url, $request = null);

}