<?php

namespace IMW\LaravelMeta\Tests;

class CommandTest extends TestCase
{
    /** @test */
    public function make_meta_command_success(): void
    {
        $this->artisan('make:meta Book')
            ->assertExitCode(0);
    }

    /** @test */
    // public function make_meta_command_with_duplicated_name_should_fail(): void
    // {
    // 	$this->artisan('make:meta Book')
    // 		->assertExitCode(1);
    // }
}
