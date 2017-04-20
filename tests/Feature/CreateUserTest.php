<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\Role;
use Tests\FeatureTestCase;

class CreateUserTest extends FeatureTestCase
{
    function test_a_user_can_create_users()
    {
        //having
        $role = factory(Role::class)->create(['id' => 1, 'name' => 'Administrador']);
        $fields = [
            'name'                  => 'Enrique Mejias',
            'email'                 => 'emejias@gmail.com',
            'password'              => 'secret',
            'password_confirmation' => 'secret',
            'role_id'               => 1
        ];

        $this->actingAs($this->defaultUser());

        //when
        $this->visit(route('users.create'))
            ->form($fields);
        $this->press('Guardar');

        //then
        $this->seeCredentials([
            'name'     => 'Enrique Mejias',
            'email'    => 'emejias@gmail.com',
            'password' => 'secret',
            //'role_id'   => 1
        ]);
    }

    public function test_validate_form()
    {
        $this->actingAs($this->defaultUser());

        //when
        $this->visit(route('users.create'))
          ->press('Guardar');

        //then
        $this->seeErrors([
            'name'     => 'El campo nombre es obligatorio',
            'email'    => 'El campo correo electrónico es obligatorio',
            'password' => 'El campo contraseña es obligatorio',
            'role_id'  => 'El campo rol de usuario es obligatorio',
        ]);

    }

    public function test_validate_email()
    {
        //having
        $oldUser = factory(User::class)->create(['email' => 'juan@tripan.com']);
        $this->actingAs($this->defaultUser());

        //when
        $this->visit(route('users.create'))
            ->type('enrique', 'name')
            ->type('juan@tripan.com', 'email')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->press('Guardar');

        //then
        $this->seeErrors([
            'email' => 'correo electrónico ya ha sido registrado.'
        ]);

    }
}
