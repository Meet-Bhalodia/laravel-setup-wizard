<?php

namespace YourName\WizardInstaller\Console\Commands;

use Illuminate\Console\Command;
use YourName\WizardInstaller\Helpers\FileHelper;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'wizard:install {--force : Force installation even if already installed}';

    /**
     * The console command description.
     */
    protected $description = 'Install the wizard installer package';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $fileHelper = new FileHelper();

        if ($fileHelper->isInstalled() && !$this->option('force')) {
            $this->error('Application is already installed. Use --force to reinstall.');
            return 1;
        }

        $this->info('Installing wizard installer...');

        // Publish configuration
        $this->call('vendor:publish', [
            '--provider' => 'YourName\\WizardInstaller\\Providers\\WizardServiceProvider',
            '--tag' => 'config',
        ]);

        // Publish views
        $this->call('vendor:publish', [
            '--provider' => 'YourName\\WizardInstaller\\Providers\\WizardServiceProvider',
            '--tag' => 'views',
        ]);

        $this->info('Wizard installer installed successfully!');
        $this->info('Visit /install to start the installation wizard.');

        return 0;
    }
}
