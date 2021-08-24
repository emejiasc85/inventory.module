<?php

namespace tests\Feature\Audit;

use EmejiasInventory\Entities\Commerce;
use EmejiasInventory\Entities\User;
use Tests\FeatureTestCase;

class CreateAuditsTest extends FeatureTestCase {

    /**
     * My test implementation
     */
    public function testAUserCanCreateAAudit() {
        //having
        $user = $this->defaultUser(['name' => 'Sonia Baldizon']);
        $provider = factory(User::class)->create(['name' => 'Lab. Prominente']);
        $comerce = factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);
        $this->actingAs($user);

        $fields = [
            'user_id' => $user->id,
            'commerce_id' => $comerce->id,
        ];
        //having
        // $this->visit('/audit');
        $this->visit(route('audit.index'));
        $this->click('Agregar Auditoria');
        $this->visit(route('audit.create'));
        // $this->seePageIs('/audit/create');
        // ->form($fields);
        $this->select($user->id, 'user_id');
        $this->press('Siguiente');

        //then
        $this->seeInDatabase('audits', $fields);
    }
}
