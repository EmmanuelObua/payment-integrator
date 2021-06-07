<?php

namespace BlackJew\Payments\Tests\Providers;

use BlackJew\Payments\Providers\FlutterWave;
use BlackJew\Payments\Support\RequestHandler;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class FlutterWaveTest extends TestCase
{

	public function testItGetsFlutterWaveProviderIfTheClassIsInstantiated()
	{

		$getway = new FlutterWave('FLUTTERWAVE', 'FLWSECK-31c9a21e012ec72061328ae9be5a2ea4-X');

		$provider = $getway->getProvider('FLUTTERWAVE');

		Assert::assertEquals('FLUTTERWAVE', $provider);

	}

	public function testHeadersReturnsAnArray()
	{

		$getway = new FlutterWave('FLUTTERWAVE', 'FLWSECK-31c9a21e012ec72061328ae9be5a2ea4-X');

		$headers = $getway->headers();

		Assert::assertIsArray($headers);

	}

	public function testHeadersReturnsTheCorrectFormat()
	{

		$getway = new FlutterWave('FLUTTERWAVE', 'FLWSECK-31c9a21e012ec72061328ae9be5a2ea4-X');

		$headers = $getway->headers();

		Assert::assertArrayHasKey('Content-Type', $headers);
		Assert::assertArrayHasKey('Accept', $headers);
		Assert::assertArrayHasKey('Authorization', $headers);

	}

	public function testFormatRequestReturnsAnArray()
	{

		$getway = new FlutterWave('FLUTTERWAVE', 'FLWSECK-31c9a21e012ec72061328ae9be5a2ea4-X');

		$request = $getway->formatRequest();

		Assert::assertIsArray($request);

	}

	public function testFormatRequestReturnsTheCorrectFormat()
	{

		$getway = new FlutterWave('FLUTTERWAVE', 'FLWSECK-31c9a21e012ec72061328ae9be5a2ea4-X');

		$request = $getway->formatRequest();

		Assert::assertArrayHasKey('headers', $request);
		Assert::assertArrayHasKey('json', $request);

	}

	public function testCheckIfCollectMethodIsCalledAndItReturnsALink()
	{

		$request = [
			"tx_ref" 			=> "hooli-tx-1920bbtytty",
			"amount" 			=> "100",
			"currency" 			=> "UGX",
			"redirect_url" 		=> "https://webhook.site/9d0b00ba-9a69-44fa-a43d-a82c33c36fdc",
			"payment_options" 	=> "mobilemoneyuganda",
			"meta" => [
				"consumer_id" 	=> 23,
				"consumer_mac" 	=> "92a3-912ba-1192a"
			],
			"customer" => [
				"email" 		=> "user@gmail.com",
				"phonenumber" 	=> "080****4528",
				"name" 			=> "Yemi Desola"
			],
			"customizations" => [
				"title" 			=> "Your company's Payments",
				"description" 	=> "Middleout isn't free. Pay the price",
				"logo" 			=> "https://assets.piedpiper.com/logo.png"
			]
		];

		$getway = new FlutterWave('FLUTTERWAVE', 'FLWSECK-31c9a21e012ec72061328ae9be5a2ea4-X');

		$response = $getway->collect($request);

		$object = (object)['link' => NULL];

		// var_dump($object);
		// ob_flush();

		Assert::assertObjectHasAttribute('link', $response);

	}

	public function testItReturnsFlutterWave()
	{

		$getway = new FlutterWave('FLUTTERWAVE', 'FLWSECK-31c9a21e012ec72061328ae9be5a2ea4-X');

		Assert::assertInstanceOf(RequestHandler::class, $getway);

	}
	
}