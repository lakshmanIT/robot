<?php
namespace App\Services;

/*
|--------------------------------------------------------------------------
| Floor Interface
|--------------------------------------------------------------------------
|
| Here is all the hard core floor apartments robot cleaning functionality executed here
|
*/
interface FloorInterface
{
    public function doClean($area);
    public function doStart():string;
    public function doInprogress($area, $output);
    public function calculateRobotCleanTimeOnSurface():int;
    public function doCharge():string;
    public function robotChargeOver():string;
    public function robotFullCharged():string;
    public function robotFullChargeTime():int;
    public function doEnd():string;
}

?>