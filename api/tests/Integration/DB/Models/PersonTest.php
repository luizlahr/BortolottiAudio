<?php

declare(strict_types = 1);

namespace Tests\Integration\DB\Models;

use Borto\Domain\Person\Entities\PersonEntity;
use Borto\Infrastructure\DB\Models\Person;
use Tests\TestCase;

/** @group PersonModel */
class PersonTest extends TestCase
{
    public function testItCanGenerateEntity()
    {
        $person = factory(Person::class)->create();
        $this->assertInstanceOf(PersonEntity::class, $person->toEntity());
    }
}
