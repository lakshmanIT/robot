<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;


class Robot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robot {uri} {--floor=} {--area=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php artsian robot:clean /route';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $request = Request::create($this->argument('uri'), 'GET');
        $request['floor'] = $this->option('floor');
        $request['area'] = $this->option('area');
        $this->info(app()->make(\Illuminate\Contracts\Http\Kernel::class)->handle($request));
    }
}
