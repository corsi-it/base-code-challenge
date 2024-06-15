<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CategoriesCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:categories-create {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name');

        if (empty($name)) {
            $name = $this->ask('What is the name of the category?');
        }

        $category = new \App\Models\Category();
        $category->name = $name;
        $category->save();
    }
}
