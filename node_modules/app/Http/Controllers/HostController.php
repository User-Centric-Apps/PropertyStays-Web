<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Models\Pages;
use Session;

class HostController extends Controller
{

    public function hostSetup(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 1)->first();
        return view('hosts.host-setup', ['item' => $item]);
    }

    public function hostInsurance(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 2)->first();
        return view('hosts.host-insurance', ['item' => $item]);
    }

    public function hostSafety(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 3)->first();
        return view('hosts.host-safety', ['item' => $item]);
    }

    public function listingProperties(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 4)->first();
        return view('hosts.host-properties', ['item' => $item]);
    }
}
