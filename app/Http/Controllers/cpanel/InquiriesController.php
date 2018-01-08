<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Inquiry;
use Excel;

class InquiriesController extends Controller
{
    public function index() {
    	$inquiry_all = Inquiry::orderBy('created_at', 'desc')->get();
    	return view('cpanel.inquiries.inquiries', ['inquiry_all' => $inquiry_all]);

    }

    public function inquiries_details(Request $request) {
    	$inquiry = Inquiry::find($request->id);
    	return view('cpanel.partials.inquiries_view', ['inquiry' => $inquiry]);
    }

    public function export_inquiries() {
    	$inquiry_all = Inquiry::orderBy('created_at', 'desc')->get();

    	Excel::create('falcon_web_inquiries', function($excel) use($inquiry_all) {
	        $excel->sheet('Falcon Website Inquiries', function($sheet) use($inquiry_all) {
	        	$sheet->fromArray($inquiry_all);
	        });
	    })->export('xlsx');
    }

    public function inquiries_delete(Request $request) {
    	$inquiry = Inquiry::find($request->id);
    	$inquiry->delete();
    }
}
