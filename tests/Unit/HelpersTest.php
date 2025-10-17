<?php

namespace meet-bhalodia\WizardInstaller\Tests\Unit;

use meet-bhalodia\WizardInstaller\Tests\TestCase;
use meet-bhalodia\WizardInstaller\Helpers\FileHelper;
use meet-bhalodia\WizardInstaller\Helpers\EnvironmentHelper;
use meet-bhalodia\WizardInstaller\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\File;

class HelpersTest extends TestCase
{
    /** @test */
    public function file_helper_can_check_installation_status()
    {
        $helper = new FileHelper();
        
        $this->assertFalse($helper->isInstalled());
    }

    /** @test */
    public function file_helper_can_create_installation_lock()
    {
        $helper = new FileHelper();
        
        $helper->createInstallationLock();
        
        $this->assertTrue($helper->isInstalled());
        $this->assertNotNull($helper->getInstallationInfo());
    }

    /** @test */
    public function file_helper_can_remove_installation_lock()
    {
        $helper = new FileHelper();
        
        $helper->createInstallationLock();
        $this->assertTrue($helper->isInstalled());
        
        $helper->removeInstallationLock();
        $this->assertFalse($helper->isInstalled());
    }

    /** @test */
    public function environment_helper_can_update_environment()
    {
        $helper = new EnvironmentHelper();
        
        // Create a test .env file
        File::put(base_path('.env'), 'APP_NAME=Laravel');
        
        $helper->updateEnvironment([
            'APP_NAME' => 'Test App',
            'DB_HOST' => 'localhost',
        ]);
        
        $envContent = File::get(base_path('.env'));
        
        $this->assertStringContainsString('APP_NAME=Test App', $envContent);
        $this->assertStringContainsString('DB_HOST=localhost', $envContent);
        
        // Clean up
        File::delete(base_path('.env'));
    }

    /** @test */
    public function database_helper_can_get_connection_status()
    {
        $helper = new DatabaseHelper();
        
        $status = $helper->getConnectionStatus();
        
        $this->assertIsArray($status);
        $this->assertArrayHasKey('connected', $status);
        $this->assertArrayHasKey('message', $status);
    }
}
