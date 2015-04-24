<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {
    /**
     * Creates the application.
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication() {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }

    /**
     * A basic functional test example.
     * @return void
     */
    /*public function testBasicExample() {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }*/
}