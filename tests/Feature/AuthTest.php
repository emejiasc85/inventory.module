<?php

namespace Tests\Feature;
use Tests\FeatureTestCase;

class AuthTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_login()
    {
        //having
        $user = $this->defaultUser([
        	'name' => 'Enrique Mejias',
        	'email'	=> 'emejiasc85@gmail.com'
        ]);


        //when
        $this->visit('/login')
        	->type('email',$user->email)
        	->type('password', 'secret')
        	->press('Login');



    }
}
