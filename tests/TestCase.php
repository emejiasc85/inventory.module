<?php

namespace Tests;

use EmejiasInventory\Entities\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Styde\Dawn\SupportsBrowserKit;

abstract class TestCase extends BaseTestCase
{
    use SupportsBrowserKit;
    use CreatesApplication;

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
