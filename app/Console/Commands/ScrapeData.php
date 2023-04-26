<?php

namespace App\Console\Commands;

use App\Models\HadeesModel;
use Illuminate\Console\Command;
use App\Spiders\BukhariSpider;
use RoachPHP\Roach;
use Goutte;

class ScrapeData extends Command
{
    protected $signature = 'scrape:data';
    protected $description = 'Scrape data using MySpider';

    public function handle()
    {
        // // Run the spider
        // $items = Roach::collectSpider(BukhariSpider::class);

        // // Output the items to the terminal
        // foreach ($items as $item) {
        //     $this->line(json_encode($item));
        // }
        $this->output->writeln('Scraper Running');

        for ($i = 11; $i <= 10; $i++) {
            $url = "https://www.quranohadith.com/hadees-details/bukhari/{$i}";
    
            $crawler = Goutte::request('GET', $url);
    
            $hadees = $crawler->filter('.container .row .col-md-12 .text-center .text-justify')->first()->text();
            $hadeesNumber = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0')->first()->text();
            $hadeesNumberOnly = intval(preg_replace('/[^0-9]+/', '', $hadeesNumber));
            $authenticity = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0 span.text-success')->first()->text();
    
            // $hadeesModel = new HadeesModel();
            // $hadeesModel->hadees_number = $hadeesNumberOnly;
            // $hadeesModel->status = $authenticity;
            // $hadeesModel->hadees = $hadees;
            // $hadeesModel->save();

            $this->output->writeln("Hadees #{$hadeesNumberOnly}: Saved To Database");
            // $this->output->writeln("Authenticity: {$authenticity}");
        }
    }
}
