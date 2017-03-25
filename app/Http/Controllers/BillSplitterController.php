<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillSplitterController extends Controller {

    /**
    * GET /
    */

    public function index() {
        return view('billsplitter.show');
    }


    /**
    * GET /
    */
    public function calculate(Request $request) {

        $dividedBill = 0;
        $recommendedTip = 15;
        $personalTip = 0;

        # Store the inputs in variables
        $pplCount = $request->input('pplCount', null);
        $billSum = $request->input('billSum', null);
        $roundUp = $request->input('roundUp', null);
        $serviceScore = $request->input('serviceScore', null);

        # Proceed to validate and calculate only if there are variables
        if($pplCount and $billSum) {

            # Validate
            $this->validate($request, [
                  'pplCount' => 'required|numeric|between:1,1000',
                  'billSum' => 'required|numeric|between:1,3000',
              ]);

            #calculate bill
            if($roundUp) {
                $dividedBill = ceil($billSum/$pplCount);
            }
            else {
                $dividedBill = number_format(($billSum/$pplCount),2);
            }

            #calculate tip
            switch ($serviceScore)  {
                case "bad":
                    $recommendedTip = 12;
                    break;
                case "average":
                    $recommendedTip = 15;
                    break;
                case "good":
                    $recommendedTip = 18;
                    break;
                case "excellent":
                    $recommendedTip = 20;
                    break;
            }

            #calculate tip per person
                $personalTip = $recommendedTip/100 * $dividedBill;

        }

        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('billsplitter.show')->with([
            'pplCount' => $pplCount,
            'billSum' => $billSum,
            'roundUp' => $request->has('roundUp'),
            'dividedBill' => $dividedBill,
            'serviceScore' => $serviceScore,
            'recommendedTip' => $recommendedTip,
            'personalTip' => $personalTip,
        ]);
    }

}
