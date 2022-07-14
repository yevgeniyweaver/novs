<?php

namespace App\Console\Commands;

use App\Jobs\CheckBuildingJob;
use App\Models\Building;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;
use Exception;
use Illuminate\Support\Collection;


/**
 * Class CheckBuildingsInfo
 * @package App\Console\Commands
 */
class CheckBuildingsInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-buildings-list:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private int $limitJobs = 300000;
    private int $countGetRows = 100;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @throws \Exception
     */
    private function init()
    {
        $queues = [
            'default',
            'checkBuildingsInfo'
        ];
        $counters = [];
        foreach ($queues as $queue) {
            $counters[$queue] = Queue::getRedis()->command('LLEN', ["queues:{$queue}"]);
            $counters[$queue . ':reserved'] = Queue::getRedis()->command('ZCARD', ["queues:{$queue}:reserved"]);
        }
        dump($counters);

        if ($this->limitJobs < $counters['checkBuildingsInfo']) {
            throw new Exception("Too many jobs");
        }
    }


    /**
     * @return int
     * @throws Exception
     */
    public function handle()
    {
        $this->init();
        $this->prepareBuildingsList();
        return 0;
    }

    private function prepareBuildingsList() {

        dump(static::class);
//        (new Building)
//            ->select('id', 'url')
////            ->whereJsonLength('crawling_status', 0)
////            ->orWhere('crawling_status->status', 'fail')
//            ->orderBy('id', "ASC")
//            ->chunk($this->countGetRows, function ($sources) {
//                $this->sendJobs($sources);
//            });
    }

    private function sendJobs(Collection $buildings) {
        $buildingsArray = $buildings->toArray();
        dump($buildingsArray);
        foreach ($buildingsArray as $source) {
            CheckBuildingJob::dispatch($source)->onQueue('checkBuildingsInfo');
        }
    }
}
