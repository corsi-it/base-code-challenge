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
    protected $signature = 'app:items-create {--name=} {--sku=}';

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

        $item = new \App\Models\Item();
        $item->name = $name;
        $item->sku = $sku;
        $item->save();
    }
}
