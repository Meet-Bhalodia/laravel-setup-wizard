<?php

namespace meet-bhalodia\WizardInstaller\Console\Commands;

use Illuminate\Console\Command;
use meet-bhalodia\WizardInstaller\Helpers\FileHelper;

class UninstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'wizard:uninstall {--force : Force uninstallation}';

    /**
     * The console command description.
     */
    protected $description = 'Uninstall the wizard installer package';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $fileHelper = new FileHelper();

        if (!$fileHelper->isInstalled() && !$this->option('force')) {
            $this->error('Application is not installed.');
            return 1;
        }

        if (!$this->option('force')) {
            if (!$this->confirm('Are you sure you want to uninstall the wizard installer?')) {
                $this->info('Uninstallation cancelled.');
                return 0;
            }
        }

        $this->info('Uninstalling wizard installer...');

        // Remove installation lock file
        $fileHelper->removeInstallationLock();

        $this->info('Wizard installer uninstalled successfully!');

        return 0;
    }
}
