<?php

namespace IMW\LaravelMeta\Tests;

use Symfony\Component\Console\Exception\RuntimeException;

class CommandTest extends TestCase
{
    /** @test */
    public function make_meta_command_success(): void
    {
        $this->artisan('make:meta Book')
            ->assertExitCode(0);
    }

    /** @test */
    public function make_meta_command_with_duplicated_name_should_fail(): void
    {
        $this->artisan('make:meta Book')
            ->assertExitCode(0);

        $this->artisan('make:meta Book')
            ->expectsOutput('Meta already exists!');
    }

    /** @test */
    public function make_meta_command_without_name_should_fail_with_message(): void
    {
        $this->expectException(RuntimeException::class);

        $this->artisan('make:meta');
    }
}
