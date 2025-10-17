<?php

namespace MeetBhalodia\SetupWizard\Console\Commands;

use Illuminate\Console\Command;
use MeetBhalodia\SetupWizard\Helpers\FileHelper;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'setup-wizard:install {--force : Force installation even if already installed}';

    /**
     * The console command description.
     */
    protected $description = 'Install the setup wizard package';

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

        $this->info('Installing setup wizard...');

        // Publish configuration
        $this->call('vendor:publish', [
            '--provider' => 'MeetBhalodia\\SetupWizard\\Providers\\SetupWizardServiceProvider',
            '--tag' => 'config',
        ]);

        // Publish views
        $this->call('vendor:publish', [
            '--provider' => 'MeetBhalodia\\SetupWizard\\Providers\\SetupWizardServiceProvider',
            '--tag' => 'views',
        ]);

        $this->info('Setup wizard installed successfully!');
        $this->info('Visit /install to start the setup wizard.');

        return 0;
    }
}
