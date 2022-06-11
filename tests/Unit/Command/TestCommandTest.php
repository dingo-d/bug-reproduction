<?php

namespace MadeByDenis\Patchwork\Tests\Unit\Command;

use Brain\Monkey;
use Brain\Monkey\Functions;
use MadeByDenis\Patchwork\Scenario\Command\TestCommand as TestConsoleCommand;
use Zenstruck\Console\Test\TestCommand;

beforeEach(function () {
    Monkey\setUp();

    $this->command = new TestConsoleCommand();
});

afterEach(function () {
    Monkey\tearDown();
});

it('command works', function () {
    Functions\when('file_get_contents')->justReturn('["Anne"]');

    TestCommand::for($this->command)
        ->execute()
        ->assertSuccessful()
        ->assertOutputContains('Anne')
        ->assertOutputNotContains('Mark');
});
