<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BillSplitterController extends Controller {

    public function calculateBill(Request $request) {

        $dividedBill = 0;

        #If service score wasn't selected then default to 18% tip
        $recommendedTip = 18;
        $personalTip = 0;

        #Store the inputs in variables
        $pplCount = $request->input('pplCount', null);
        $billSum = $request->input('billSum', null);
        $roundUp = $request->input('roundUp', null);
        $serviceScore = $request->input('serviceScore', null);

        #Check if form was submitted before priceeding to validation
        if (($request->getRequestUri()) != "/") {

            #Validate input fields
            $this->validate($request, [
                  'pplCount' => 'required|numeric|between:1,100',
                  'billSum' => 'required|numeric|between:1,3000',
                  'serviceScore' => Rule::in(['','bad','average','good','excellent']),
                  'roundUp' => Rule::in(['','on'])
            ]);

            #Proceed to calculate bill with or without round up
            if($roundUp) {
                $dividedBill = ceil($billSum/$pplCount);
            }
            else {
                $dividedBill = number_format(($billSum/$pplCount),2);
            }

            #calculate tip based on service score
            switch ($serviceScore)  {
                case "bad":
                    $recommendedTip = 15;
                    break;
                case "average":
                    $recommendedTip = 18;
                    break;
                case "good":
                    $recommendedTip = 20;
                    break;
                case "excellent":
                    $recommendedTip = 22;
                    break;
            }

            #Calculate tip per person
                $personalTip = $recommendedTip/100 * $dividedBill;

        }

        #Return the view with the user's input and the calculation results
        return view('billsplitter.calculate')->with([
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
