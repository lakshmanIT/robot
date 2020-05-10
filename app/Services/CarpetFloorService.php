<?php
namespace App\Services;
use Config;
use \Symfony\Component\Console\Output\ConsoleOutput;

/*
|--------------------------------------------------------------------------
| Carpet Floor Service Class
|--------------------------------------------------------------------------
|
| Here is all the carpet floor apartments robot cleaning functionality executed here
|
*/
class CarpetFloorService implements FloorInterface
{
    public $area; 

    /**
     * Here Robot initially to start clean the Carpet floor apartment.
     *
     * @param  $area;
     * @return $response
     */
    public function doClean($area)
    {    
        $output = new ConsoleOutput();    
        $output->writeln($this->doStart());
        $this->doInprogress($area, $output);
        $output->writeln($this->doEnd());
    }

    /**
     * Robot started cleaning apartment.
     *
     * @return $message
     */
    public function doStart() : string
    {
        $message = Config::get('constants.ROBOT_WORK_STARTDED');
        return $message;
    }

    /**
     * Robot started cleaning apartment.
     *
     * @param $area
     * @return $time
     */
    public function doInprogress($area, $output)
    {
        $output->writeln(Config::get('constants.ROBOT_WORK_Inprogress'));
        $robotCleanTimeOnSurface = $this->calculateRobotCleanTimeOnSurface();
        $robotChargingCount = 1;
        $robotCleaningTimeCount = 1;
        for($i=1; $i<=$area; $i++)
        {
            if($robotChargingCount==$robotCleanTimeOnSurface && $i != $area)
            {
                $output->writeln(Config::get('constants.ROBOT_WORK_PROGRESS_STATUS').$i.' meters in '.$robotCleaningTimeCount.' seconds');
                $output->writeln($this->robotChargeOver());
                $output->writeln($this->doCharge());
                $robotChargingCount = 0;
                $output->writeln($this->robotFullCharged());
                $robotCleaningTimeCount = $robotCleaningTimeCount + $this->robotFullChargeTime();
                $output->writeln($this->doStart());
                $output->writeln(Config::get('constants.ROBOT_WORK_Inprogress'));
            }
            else if($i == $area){
                $output->writeln(Config::get('constants.ROBOT_WORK_PROGRESS_STATUS').$i.' meters in '.$robotCleaningTimeCount.' seconds');
            }
            $robotChargingCount++;
            $robotCleaningTimeCount++;
        }
        
        return true;
    }

    /**
     * Robot taking charge by self.
     *
     * @return $message
     */
    public function doCharge() : string
    {
        $message = Config::get('constants.ROBOT_TAKING_CHARGING');
       return  $message;
    }

    /**
     * Robot Full charged.
     *
     * @return $message
     */
    public function robotFullCharged() : string
    {
        $message = Config::get('constants.ROBOT_FULL_CHARGED').' in '.$this->robotFullChargeTime().' seconds';
       return  $message;
    }

    /**
     * Robot Full charge time in seconds.
     *
     * @return $time
     */
    public function robotFullChargeTime() : int
    {
        $time = Config::get('constants.ROBOT_FULL_CHARGE_TIME');
       return  $time;
    }

    /**
     * Robot charging over.
     *
     * @return $message
     */
    public function robotChargeOver() : string
    {
        $message = Config::get('constants.ROBOT_CHARGING_OVER');
       return  $message;
    }
    

    /**
     * Robot started calculating time for cleaning apartment.
     *
     * @param $area
     * @return $time
     */
    public function calculateRobotCleanTimeOnSurface():int
    {
        $time = Config::get('constants.ROBOT_LIFE_ONCE_CHARGE')/Config::get('constants.ROBOT_CLEAN_TIME_1M_CARPET');
        return $time;
    }

    /**
     * Robot completed cleaning apartment.
     *
     * @return $message
     */
    public function doEnd():string
    {
        $message = Config::get('constants.ROBOT_WORK_Completed');
        return $message;
    }

}

?>