<?php

namespace IMW\LaravelMeta\Tests;

use IMW\LaravelMeta\Tests\TestCase;

class CommandTest extends TestCase
{
    /** @test */
    public function make_meta_commande_success(): void
    {
		$this->artisan('make:meta Book')
			->assertExitCode(0);
	}

    /** @test */
    // public function make_meta_commande_with_duplicated_name_should_fail(): void
    // {
	// 	$this->artisan('make:meta Book')
	// 		->assertExitCode(1);
	// }

}
