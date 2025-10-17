<?php

namespace YourName\WizardInstaller\Helpers;

use Illuminate\Support\Facades\File;

class EnvironmentHelper
{
    /**
     * Update the .env file with new values.
     */
    public function updateEnvironment(array $data): void
    {
        $envPath = base_path('.env');
        
        if (!File::exists($envPath)) {
            $this->createEnvFile();
        }

        $envContent = File::get($envPath);
        
        foreach ($data as $key => $value) {
            $envContent = $this->updateEnvValue($envContent, $key, $value);
        }

        File::put($envPath, $envContent);
    }

    /**
     * Create a new .env file from .env.example.
     */
    protected function createEnvFile(): void
    {
        $examplePath = base_path('.env.example');
        
        if (File::exists($examplePath)) {
            File::copy($examplePath, base_path('.env'));
        } else {
            $this->createDefaultEnvFile();
        }
    }

    /**
     * Create a default .env file.
     */
    protected function createDefaultEnvFile(): void
    {
        $defaultEnv = "APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=\"hello@example.com\"
MAIL_FROM_NAME=\"\${APP_NAME}\"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY=\"\${PUSHER_APP_KEY}\"
VITE_PUSHER_HOST=\"\${PUSHER_HOST}\"
VITE_PUSHER_PORT=\"\${PUSHER_PORT}\"
VITE_PUSHER_SCHEME=\"\${PUSHER_SCHEME}\"
VITE_PUSHER_APP_CLUSTER=\"\${PUSHER_APP_CLUSTER}\"";

        File::put(base_path('.env'), $defaultEnv);
    }

    /**
     * Update a specific value in the .env content.
     */
    protected function updateEnvValue(string $envContent, string $key, string $value): string
    {
        $pattern = "/^{$key}=.*/m";
        $replacement = "{$key}={$value}";
        
        if (preg_match($pattern, $envContent)) {
            return preg_replace($pattern, $replacement, $envContent);
        }
        
        return $envContent . "\n{$replacement}";
    }

    /**
     * Generate application key.
     */
    public function generateAppKey(): void
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);
        
        $key = 'base64:' . base64_encode(random_bytes(32));
        $envContent = $this->updateEnvValue($envContent, 'APP_KEY', $key);
        
        File::put($envPath, $envContent);
    }
}
