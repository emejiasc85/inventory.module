<?php

namespace tests;

use EmejiasInventory\Entities\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';

    /**
    * @var EmejiasInventory\Entities\User
    */

    protected $defaultUser;

    public function defaultUser(array $attributes = [])
    {
        if ($this->defaultUser) {
            return $this->defaultUser;
        }
        return $this->defaultUser = factory(User::class)->create($attributes);
    }
}
