<?php
namespace App\Traits;

trait MultiDispatch
{
    public function multiDispatch(array $events)
    {
        foreach($events as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}

