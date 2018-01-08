<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class CpanelController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth', ['except' => 'logout']);
    }

    public function index() {
    	return redirect()->route('news-events');
    }
}
