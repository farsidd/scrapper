<?php

use Illuminate\Support\Facades\Route;
use App\Spiders\BukhariSpider;
use RoachPHP\Roach;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     $items = Roach::collectSpider(BukhariSpider::class);
//     dd($items);
//     // return view('welcome', ['scrapedData' => $items]);
// });

Route::get('/', function () {
    $crawler = Goutte::request('GET', 'https://www.quranohadith.com/hadees-details/bukhari/2');
    $hadees_en = $crawler->filter('.container .row .col-md-12 .text-center .text-justify')->first()->text();
    $hadees_ar = $crawler->filter('h3.font-arabic2.text-center.mb-4')->first()->text();
    $hadees_ur = $crawler->filter('h5.font-urdu.text-justify.m-0')->first()->text();
    $hadeesNumber = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0')->first()->text();
    $hadeesNumberOnly = intval(preg_replace('/[^0-9]+/', '', $hadeesNumber));
    $book_name_ur = $crawler->filter('section:nth-of-type(2) h2')->first()->text();
    $book_name_en = $crawler->filter('section:nth-of-type(2) h5')->first()->text();
    $book_chapter_ur = $crawler->filter('section:nth-of-type(2) h4')->first()->text();
    $book_chapter_en = $crawler->filter('section:nth-of-type(2) p')->first()->text();
    $authenticity_en = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0 span.text-success')->first()->text();
    $authenticity_ur = $crawler->filter('section:nth-of-type(4) .col-6.text-right h3.m-0 span.text-success')->first()->text();


    dump($hadees_en);
    dump($hadees_ar);
    dump($hadees_ur);
    dump($hadeesNumberOnly);
    dump($authenticity_en);
    dump($authenticity_ur);
    dump($book_name_ur);
    dump($book_name_en);
    dump($book_chapter_ur);
    dump($book_chapter_en);



    // return view('welcome');
});
// Route::get('/', function() {
//     $crawler = Goutte::request('GET', 'https://www.quranohadith.com/hadees-details/bukhari/1');
//     $crawler->filter('.container .row .col-md-12 .text-center');
//     dump($crawler);
//     return view('welcome');
// });