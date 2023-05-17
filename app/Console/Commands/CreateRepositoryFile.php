<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class CreateRepositoryFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repository:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new file in app/Repository directory.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $className = $this->argument('name');
        $fileName = app_path("Repositories/{$className}.php");

        $fileContent = "<?php\n\nnamespace App\Repository;\n\nuse App\Models\\{$className};\n\nclass {$className}\n{\n    protected \${$className};\n\n    public function __construct({$className} \${$className})\n    {\n        \$this->{$className} = \${$className};\n    }\n\n    // Add your methods here\n    public function all()\n    {\n        return \$this->{$className}::all();\n    }\n\n    public function find(\$id)\n    {\n        return \$this->{$className}::findOrFail(\$id);\n    }\n\n    public function create(array \$data, \$id)\n    {\n        return \$this->{$className}::create(\$data);\n    }\n\n    public function update(array \$data, \$id)\n    {\n        \$model = \$this->{$className}::findOrFail(\$id);\n        \$model->update(\$data);\n        return \$model;\n    }\n\n    public function delete(\$id)\n    {\n        \$model = \$this->{$className}::findOrFail(\$id);\n        \$model->delete();\n        return \$model;\n    }\n\n    public function rules()\n    {\n        return [];\n    }\n\n    public function rules_update()\n    {\n        return [];\n    }\n}";
        if (!file_exists($fileName)) {
            file_put_contents($fileName, $fileContent);
            $this->info("Repository {$className} created successfully.");
        } else {
            $this->error("Repository {$className} already exists.");
        }
    }
}
