<?php

namespace App\Spiders;

use App\Processors\MyFirstProcessor;
use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;

class BukhariSpider extends BasicSpider
{
    public array $startUrls = [
        'https://roach-php.dev/docs/spiders'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        // MyFirstProcessor::class,
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $title = $response->filter('h1')->text();
        $this->logger->info('Title found: ' . $title);
        
        $subtitle = $response
            ->filter('main > div:nth-child(2) p:first-of-type')
            ->text();
        $this->logger->info('Subtitle found: ' . $subtitle);
    }
}
