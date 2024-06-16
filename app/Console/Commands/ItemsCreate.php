<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ItemsCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:items-create {--name=} {--sku=} {--category_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new item';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name');

        if (empty($name)) {
            $name = $this->ask('What is the name of the item?');
        }

        $sku = $this->option('sku');
        if (empty($sku)) {
            $sku = $this->ask('What is the SKU of the item?');
        }

        $categoryId = $this->option('category_id');
        if (empty($categoryId)) {
            $categoryId = $this->ask('What is the category ID of the item? (press enter to skip)');
        }

        $item = new \App\Models\Item();
        $item->name = $name;
        $item->sku = $sku;

        if (!empty($categoryId)) {
            $category = \App\Models\Category::find($categoryId);
            if (!$category) {
                $this->error('Category not found');
                return;
            }
            $item->category()->associate($category);
        }

        $item->save();
    }
}
