<?php
namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeatureTesTCase extends TestCase
{
	use DatabaseTransactions;

	public function seeErrors(array $fields)
	{
		foreach ($fields as $name => $errors) {
			foreach ((array) $errors as $message) {
				$this->seeInElement("#field_{$name} .help-block", $message);
			}
		}
	}
}