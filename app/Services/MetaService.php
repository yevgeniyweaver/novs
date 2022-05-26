<?php


namespace App\Services;

use App\Interfaces\MetaInterface;
use Eusonlito\LaravelMeta\Meta;

class MetaService
{
    /**
     * The attributes that are mass assignable.
     *
     * @var object
     */
    public $meta;

    public function __construct(Meta $meta)
    {
        $this->meta = $meta;
        //dump($this->meta);
    }


    /**
     * @param  string $key
     * @param  string $value
     *
     * @return string
     */
    public function setKey(string $key, string $value): string
    {
        return $this->meta->set($key, $value);
        //return $this->meta;
    }
}
