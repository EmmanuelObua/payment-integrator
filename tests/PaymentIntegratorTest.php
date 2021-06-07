<?php

namespace BlackJew\Payments\Tests;

use BlackJew\Payments\Providers\FlutterWave;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class PaymentIntegratorTest extends TestCase
{

	public function testItGetsFlutterWaveProviderIfTheClassIsInstantiated()
	{

		$getway = new FlutterWave('FLUTTERWAVE', 'HDGSHHDGJSJDSDJJDJJSJDJSKKD');

		$provider = $getway->getProvider('FLUTTERWAVE');

		Assert::assertEquals('FLUTTERWAVE', $provider);

	}

	// public function testItReturnsFlutterWave()
	// {
	// 	$numberToWords = new NumberToWords();
	// 	$numberToWordsTransformer = $numberToWords->getNumberTransformer('en');

	// 	Assert::assertInstanceOf(NumberTransformer::class, $numberToWordsTransformer);
	// }
	
}