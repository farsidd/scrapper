<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spiders\BukhariSpider;
use RoachPHP\SpiderRunner;

class HadeesController extends Controller
{
    // public function index()
    // {
    //     $spider = new BukhariSpider();
    //     $runner = new SpiderRunner();
    //     $results = $runner->run($spider);

    //     // Process the scraped data as needed, for example:
    //     $data = [];
    //     foreach ($results as $result) {
    //         $data[] = $result->data;
    //     }

    //     return view('home', ['data' => $data]);
    // }
}
