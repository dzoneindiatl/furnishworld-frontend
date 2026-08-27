<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class shiftProductContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shift-product-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = 0;
        Product::chunkById(100, function ($products) use (&$count) {
            foreach ($products as $product) {
                // Old values ko pehle store kar lo
                $content1 = $product->content_1;
                $content2 = $product->content_2;
                $content3 = $product->content_3;
                $content4 = $product->content_4;
                $content5 = $product->content_5;
                // Shift
                $product->content_2 = $content1;
                $product->content_3 = $content2;
                $product->content_4 = $content3;
                $product->content_5 = $content4;

                // content_1 blank
                $product->content_1 = null;
                $product->save();
                $count++;
            }
        });
            $this->info("Successfully shifted content for {$count} products.");

        return Command::SUCCESS;
    }
}
