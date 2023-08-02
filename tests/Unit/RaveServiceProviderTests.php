<?php

namespace Tests\Unit;

use Tests\TestCase;
use BlackJew\Rave\Rave;

class RaveServiceProviderTests extends TestCase
{
    /**
     * Tests if service provider Binds alias "laravelrave" to \BlackJew\Rave\Rave
     *
     * @test
     */
    public function isBound()
    {
        $this->assertTrue($this->app->bound('laravelrave'));
    }
    /**
     * Test if service provider returns \Rave as alias for \BlackJew\Rave\Rave
     *
     * @test
     */
    public function hasAliased()
    {
        $this->assertTrue($this->app->isAlias("BlackJew\Rave\Rave"));
        $this->assertEquals('laravelrave', $this->app->getAlias("BlackJew\Rave\Rave"));
    }
}
