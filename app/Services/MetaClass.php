<?php


namespace App\Services;

use App\Interfaces\MetaInterface;
use Eusonlito\LaravelMeta\Meta;

class MetaClass implements MetaInterface
{
    public $meta;

    public function __construct(Meta $meta)
    {
        return $meta;
    }
}