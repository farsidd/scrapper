<?php

namespace App\Processors;


use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

class MyFirstProcessor implements ItemProcessorInterface
{
    use Configurable;
    
    public function processItem(ItemInterface $item): ItemInterface
    {
        // Return the item without making any modifications
        
        return $item;
    }
}
