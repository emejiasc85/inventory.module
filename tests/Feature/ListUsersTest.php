<?php

namespace Tests\Feature;

use EmejiasInventory\Entities\User;
use Tests\FeatureTestCase;

class ListUsersTest extends FeatureTestCase
{
    function test_user_can_see_users_list()
    {
        //having
        $user = $this->defaultUser();
        $this->actingAs($user);

        //when
        $this->visit(route('users.index'))
            //->seeInElement('h1', 'Usuarios')
            ->seeInElement('td', $user->name)
            ->seeInElement('td', $user->email);
    }

    function test_a_user_can_paginate_users_list()
    {
        //having
        $firtsUser = factory(User::class)->create(['name' => 'Enrique', 'email' => 'emejias@gmail.com']);
        $users = factory(User::class)->times(15)->create();
        $lastUser = factory(User::class)->create(['name' => 'alfredo', 'email' => 'amejias@gmail.com']);

        $this->actingAs($firtsUser);

        //when
        $this->visit(route('users.index'))
            //->seeInElement('h1','Usuarios')
            ->seeInElement('td', $lastUser->name)
            ->dontSeeInElement('td', $firtsUser->name)
            ->click(2)
            ->seeInElement('td', $firtsUser->name)
            ->dontSeeInElement('td', $lastUser->name);
    }

    function test_a_user_can_search_a_user()
    {
        //having
        $firtsUser = factory(User::class)->create(['name' => 'Enrique', 'email' => 'emejias@gmail.com']);
        $users = factory(User::class)->times(15)->create();
        $lastUser = factory(User::class)->create(['name' => 'alfredo', 'email' => 'amejias@gmail.com']);
        $this->actingAs($firtsUser);

        //when
        $this->visit(route('users.index'))
            //->seeInElement('h1','Usuarios')
            ->type('enr', 'name')
            ->press('Buscar');
        //then
        $this->seeInElement('td', $firtsUser->name)
            ->seeInElement('td', $firtsUser->email);
    }
}
