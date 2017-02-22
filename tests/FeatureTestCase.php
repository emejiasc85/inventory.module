<?php
namespace Tests;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeatureTesTCase extends BrowserKitTest
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

	public function form(array $fields)
	{
		foreach ($fields as $name => $type) {
			$this->type($type, $name);
		}
	}
}