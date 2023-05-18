<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateModelFiles extends Command
{
    protected $signature = 'make:pmodel {model}';

    protected $description = 'Generate model';

    public function handle()
    {
        $model = $this->argument('model');
        $this->call('make:request', ['name' => $model.'Request']);
        $this->call('make:resource', ['name' => $model.'Resource']);
        $this->call('make:controller', ['name' => 'Admin/'.$model.'Controller']);
        $this->call('repository:create', ['name' => $model.'Repository']);
        $this->info('Model request and resource files generated successfully.');
    }
}
