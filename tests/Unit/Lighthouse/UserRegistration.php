<?php

namespace Tests\Unit\Lighthouse;

use Illuminate\Foundation\Testing\TestCase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Nuwave\Lighthouse\Testing\RefreshesSchemaCache;
use Tests\CreatesApplication;

class UserRegistration extends TestCase
{
    use CreatesApplication;
    use MakesGraphQLRequests;
    use RefreshesSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootRefreshesSchemaCache();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_registration()
    {
        $this->graphQL(/** @lang GraphQL */'
            mutation {
              register(
                  username: "stretstreet",
                  name: "Nariman",
                  email: "stretstreet@yandex.ru",
                  password: "qwerty"
              ) {
                id
                name
                email
              }
            }
        ')
        ->assertJson([
            'data' => [
                'register' => [
                    [
                        'id' => '1',
                        'name' => 'Nariman',
                        'email' => 'stretstreet@yandex.ru',
                    ],
                ],
            ],
        ]);
    }
}
