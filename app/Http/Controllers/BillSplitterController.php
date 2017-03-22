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
}
