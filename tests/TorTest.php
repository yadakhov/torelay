<?php

use App\Tor;

class TorTest extends TestCase
{
    public function __construct()
    {
        $this->tor = new Tor();
        $this->tor->start();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_constructor()
    {
        $this->assertTrue($this->tor instanceof Tor);
    }

    public function test_command_invalid_argument()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->tor->command('everything');
    }

    public function test_command_status()
    {
        $command = $this->tor->command('status');

        $this->assertEquals(0, $command->getExitCode());
    }

    public function test_isRunning()
    {
        $this->tor->isRunning();
    }

    public function test_curl_exists()
    {
        $this->assertTrue(function_exists('curl_version'));
    }

    public function test_start()
    {
        $this->tor->stop();
        $command = $this->tor->start();

        $this->assertStringStartsWith('* Starting tor daemon', $command->getOutput());
    }

    public function test_stop()
    {
        $command = $this->tor->stop();

        $this->assertStringStartsWith('* Stopping tor daemon', $command->getOutput());
        $this->tor->start();
    }

    public function test_reload()
    {
        $command = $this->tor->reload();

        $this->assertStringEndsWith('done.', $command->getOutput());
    }

    public function test_force_reload()
    {
        $command = $this->tor->forceReload();
        $this->assertStringEndsWith('done.', $command->getOutput());
    }

    public function test_status()
    {
        $command = $this->tor->status();

        $this->assertEquals('* tor is running', $command->getOutput());
    }

    public function test_newIp()
    {
        $this->tor->newIp();
    }

    public function test_getRandomHeader()
    {
        $header = $this->tor->getRandomHeader();
        $this->assertTrue(is_array($header));

        $this->assertEquals(1, count($header));
    }
}
