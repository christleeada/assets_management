<?php

namespace App\Console\Commands;

use App\Mail\AssetRecommendation;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDeviceRecommendations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recommendations:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send device recommendations to owners';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $items = Item::all();
        
       

        // Loop through the items and send email to the owner
        foreach ($items as $item) {
            $recommendations = AssetRecommendation::generateForItem($item->id);
            Mail::to($item->owner_email)->send(new AssetRecommendation($recommendations));
        }
        
        

        $this->info('Device recommendations sent successfully!');
    }
}
