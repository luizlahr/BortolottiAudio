<?php

declare(strict_types = 1);

namespace Tests;

use Faker\Factory as Faker;
use Faker\Generator as FakerGenerator;
use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    use TestHelpers;
    use EntityFaker;

    protected FakerGenerator $faker;

    public function setup(): void
    {
        parent::setup();
        $this->fakerBR = Faker::create('pt_BR');
        $this->faker = Faker::create('en_US');
    }
}
