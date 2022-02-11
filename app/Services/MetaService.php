<?php


namespace App\Services;

use App\Interfaces\MetaInterface;

class MetaService
{
    /**
     * The attributes that are mass assignable.
     *
     * @var object
     */
    public $meta;

    public function __construct(MetaInterface $meta)
    {
        $this->meta = $meta;
    }


}