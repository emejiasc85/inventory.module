<?php

namespace tests\Feature;

use Tests\FeatureTestCase;

class EditUsersTest extends FeatureTestCase
{

    function test_a_user_can_edit_users()
    {
    	//having
    	$user = $this->defaultUser(['name' => 'Enrique', 'email' => 'emejias@gmail.com']);
    	$this->actingAs($user);

    	//when
    	$this->visit($user->editUrl)
    	->type('Alfredo', 'name')
    	->type('amejias@gmail.com', 'email')
    	->press('Editar');

    	//then
    	$this->seeCredentials([
    		'name' => 'Alfredo',
    		'email' => 'amejias@gmail.com',
    		'password' => 'secret',
    	]);
    }

    function test_a_user_can_edit_user_password()
    {
        //having
        $user = $this->defaultUser(['name' => 'Enrique', 'email' => 'emejias@gmail.com']);
        $this->actingAs($user);

        //when
        $this->visit($user->editPasswordUrl)
        ->type('Secreto', 'password')
        ->type('Secreto', 'password_confirmation')
        ->press('Editar');

        //then
        $this->seeCredentials([
            'name' => 'Enrique',
            'email' => 'emejias@gmail.com',
            'password' => 'Secreto',
        ]);
    }


    public function test_auth_user_can_update_his_password()
    {
        //having
        $user = $this->defaultUser(['name' => 'Enrique', 'email' => 'emejias@gmail.com', 'password' => 'secret']);
        $this->actingAs($user);
        //when
        $this->visit('/')
        ->click('Cambiar Contraseña')
        ->seePageIs($user->editAuthPassword)
        ->type('secret', 'current_password')
        ->type('moreSecret', 'password')
        ->type('moreSecret', 'password_confirmation')
        ->press('Guardar');

        //then
        $this->seeCredentials([
            'name'  => 'Enrique',
            'email' => 'emejias@gmail.com',
            'password' => 'moreSecret'
        ]);
    }


}
