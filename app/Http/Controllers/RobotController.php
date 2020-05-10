<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HardCoreFloorService;
use App\Services\CarpetFloorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Config;



class RobotController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Here Robot initially to start clean the apartment.
     *
     * @param  Illuminate\Http\Request $request;
     * @return $response
     */
    protected function clean(Request $request)
    {
        $input = $request->all();
        $floor = !empty($input['floor']) ? $input['floor'] : '';
        $area = !empty($input['area']) ? $input['area'] : '';
        try
        {
            if(!empty($floor) && !empty($area))
            {
                $response = '';
                switch ($floor) {
                    case Config::get('constants.APT_HARD'):
                        $hardCoreFloorObj = new HardCoreFloorService();  
                        $response = $hardCoreFloorObj->doClean($area);
                        break;
                    case Config::get('constants.APT_CARPET'):
                      $carpetFloorObj = new CarpetFloorService();  
                      $response = $carpetFloorObj->doClean($area);
                      break;
                    default:
                        $response = "Invalid floor type provided";
                        break;
                }

                return $response;

            } else{
                return 'Floor and Area arguments are required';
                //throw new \InvalidArgumentException('Floor and Area arguments are required');
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }
}
