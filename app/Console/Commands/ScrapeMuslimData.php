<?php

namespace App\Console\Commands;

use App\Models\MuslimModel;
use Illuminate\Console\Command;
use Goutte;
class ScrapeMuslimData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:MuslimData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->writeln('Scraper Running For Sahih Muslim');

        for ($i = 1; $i <= 7561; $i++) {
            $url = "https://www.quranohadith.com/hadees-details/muslim/{$i}";
    
            $crawler = Goutte::request('GET', $url);

            $hadeesNumber = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0')->first()->text();
            $hadeesNumberOnly = intval(preg_replace('/[^0-9]+/', '', $hadeesNumber));

            $hadees_en = $crawler->filter('.container .row .col-md-12 .text-center .text-justify')->first()->text();
            $hadees_ar = $crawler->filter('h3.font-arabic2.text-center.mb-4')->first()->text();
            $hadees_ur = $crawler->filter('h5.font-urdu.text-justify.m-0')->first()->text();

            $book_name_ur = $crawler->filter('section:nth-of-type(2) h2')->first()->text();
            $book_name_en = $crawler->filter('section:nth-of-type(2) h5')->first()->text();

            $book_chapter_ur = $crawler->filter('section:nth-of-type(2) h4')->first()->text();
            $book_chapter_en = $crawler->filter('section:nth-of-type(2) p')->first()->text();

            $authenticity_en = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0 span.text-success, section:nth-of-type(4) .col-6.text-left p.m-0 span.text-danger')->first()->text();
            $authenticity_ur = $crawler->filter('section:nth-of-type(4) .col-6.text-right h3.m-0 span.text-success, section:nth-of-type(4) .col-6.text-right h3.m-0 span.text-danger')->first()->text();
            $hadeesModel = new MuslimModel();
            $hadeesModel->hadees_number = $hadeesNumberOnly;
            $hadeesModel->hadees_en = $hadees_en;
            $hadeesModel->hadees_ar = $hadees_ar;
            $hadeesModel->hadees_ur = $hadees_ur;
            $hadeesModel->book_name_ur = $book_name_ur;
            $hadeesModel->book_name_en = $book_name_en;
            $hadeesModel->book_chapter_ur = $book_chapter_ur;
            $hadeesModel->book_chapter_en = $book_chapter_en;
            $hadeesModel->status_en = $authenticity_en;
            $hadeesModel->status_ur = $authenticity_ur;
            $hadeesModel->save();

            $this->output->writeln("Hadees #{$hadeesNumberOnly}: Saved To Database");
    }
}
}