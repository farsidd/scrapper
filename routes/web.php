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
    $crawler = Goutte::request('GET', 'https://www.quranohadith.com/hadees-details/bukhari/1');
    $hadees = $crawler->filter('.container .row .col-md-12 .text-center .text-justify')->first()->text();
    $hadeesNumber = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0')->first()->text();
    $hadeesNumberOnly = intval(preg_replace('/[^0-9]+/', '', $hadeesNumber));
    $authenticity = $crawler->filter('section:nth-of-type(4) .col-6.text-left p.m-0 span.text-success')->first()->text();

    dump($hadees);
    dump($hadeesNumberOnly);
    dump($authenticity);

    // return view('welcome');
});
// Route::get('/', function() {
//     $crawler = Goutte::request('GET', 'https://www.quranohadith.com/hadees-details/bukhari/1');
//     $crawler->filter('.container .row .col-md-12 .text-center');
//     dump($crawler);
//     return view('welcome');
// });