<?php

namespace meet-bhalodia\WizardInstaller\Tests\Feature;

use meet-bhalodia\WizardInstaller\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstallationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_access_welcome_page()
    {
        $response = $this->get('/install');

        $response->assertStatus(200);
        $response->assertViewIs('wizard-installer::steps.welcome');
    }

    /** @test */
    public function it_can_access_environment_page()
    {
        $response = $this->get('/install/environment');

        $response->assertStatus(200);
        $response->assertViewIs('wizard-installer::steps.environment');
    }

    /** @test */
    public function it_can_process_environment_setup()
    {
        $data = [
            'app_name' => 'Test App',
            'app_url' => 'http://localhost',
            'db_connection' => 'mysql',
            'db_host' => '127.0.0.1',
            'db_port' => 3306,
            'db_database' => 'test_db',
            'db_username' => 'root',
            'db_password' => 'password',
        ];

        $response = $this->post('/install/environment', $data);

        $response->assertRedirect('/install/database');
    }

    /** @test */
    public function it_can_access_database_page()
    {
        $response = $this->get('/install/database');

        $response->assertStatus(200);
        $response->assertViewIs('wizard-installer::steps.database');
    }

    /** @test */
    public function it_can_access_admin_page()
    {
        $response = $this->get('/install/admin');

        $response->assertStatus(200);
        $response->assertViewIs('wizard-installer::steps.admin');
    }

    /** @test */
    public function it_can_access_complete_page()
    {
        $response = $this->get('/install/complete');

        $response->assertStatus(200);
        $response->assertViewIs('wizard-installer::steps.complete');
    }
}
