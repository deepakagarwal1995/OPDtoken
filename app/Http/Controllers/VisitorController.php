<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token_settings;

class VisitorController extends Controller
{

    public function index()
    {
        $data = Token_settings::latest()->first();
        return view('welcome', compact('data'));
    }
    public function check_my_time(Request $request)
    {
        $output = array();
        if($request->token !=''){
            $data = Token_settings::latest()->first();
            if($data->status==1){
                $ct = $data->curr_token;
                if($request->token<= $ct){
                    $output['messg'] = 'Your token number has expired';
                    $output['status'] = 0;
                }else{
                    $tt = $request->token - $ct;
                    $avg = $data->avg_time_in_min;
                    $tmin = round($tt * $avg);

                    $output['minutes'] = $tmin % 60;
                    $output['hours'] = intdiv($tmin, 60);
                    $output['status'] = 1;
                }
            }else{
                $output['messg'] = 'OPD Not Started';
                $output['status'] = 0;
            }

        }else{
            $output['messg'] = 'Token Required !!';
            $output['status'] = 0;
        }
        echo json_encode($output);
    }
    public function update_data(Request $request)
    {
        try {
            $output = '';
            $data = Token_settings::latest()->first();
            $output.= '<div class="d-flex justify-content-between py-2 px-4 bg-primary text-uppercase"><div class="dateTime">
              <h3 class="title">
                <span class=""><img style="    height: 22px;" class="img-fluid" src="'.config('app.url') .'/assets/images/calendar.svg"></span><span> '.date('jS F Y').'</span>
              </h3>
          </div>
          <div class="dateTime">
            <h3 class="title">
              <span class=""><img style="    height: 22px;" class="img-fluid" src="'.config('app.url') .'/assets/images/wall-clock.svg"></span><span>
              '.date('g:i a').' IST </span>
            </h3></div></div>';

            if ($data->status == 1){
                $output .= '<div class="d-flex justify-content-center py-2 px-4 bg-primary mt-3"><div class="cTime"><h3 class="title">
            CURRENT TOKEN NUMBER FOR OPD IS
          </h3>
        </div></div><div class="d-flex justify-content-center py-2 px-4  mt-3">

        <div class="cNumber">
          <h3 class="text-primary">
            '.$data->curr_token. '
          </h3>
        </div>
      </div><h5 class="text-center h6">NEXT NUMBER WILL COME WITHIN '.$data->avg_time_in_min. ' MINUTES</h5><div class="mt-5">
        <form class="form-checkTime">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Enter your token Number" id="MyToken">
            <span class="input-group-btn">
              <button class="btn" type="button" id="checkMyTime">check estimate time</button>
            </span>
          </div>
        </form>
      </div>';
            }else{
                $output .= '<h4 class="text-center text-danger mt-5 text-uppercase">
        Next OPD will be starts on <br><b>'.date('jS F Y',strtotime($data->start_from_date)).'</b> at <b>'.date('g:i a',strtotime($data->start_from_time)).'</b>

      </h4>';

                    }
        } catch (\Exception $e) {

            $mssg =  $e->getMessage();
            $output = $mssg;
                }


        echo $output;
    }

}
