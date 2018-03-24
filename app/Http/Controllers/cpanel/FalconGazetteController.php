<?php

namespace App\Http\Controllers\cpanel;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use View;

use App\falcon_gazette;

class FalconGazetteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'logout']);
    }

    public function index() {
    	$falcon_gazette = falcon_gazette::all()->sortByDesc("gaz_date");
        return view('cpanel.gazette.gazette', ['falcon_gazette'=>$falcon_gazette]);
    } // END OF FUNCTION

    public function gazette_add_form() {
    	return view('cpanel.partials.gazette_add_form');
    }// END OF FUNCTION

    public function gazette_add_save(Request $request) {
    	
		$validator = Validator::make($request->all(), 
			[
	        'gaz_title' => 'required',
	        'gaz_date' => 'required|date',
	        'gaz_pdf_filename' => 'required|max:2048|mimes:pdf',
	        'gaz_image' => 'required|max:2048|mimes:jpg,jpeg',
	        'gaz_status' => 'required',
	    	],
	    	[
	    	'gaz_title.required' => 'The title field is required.',
	    	'gaz_date.required' => 'The date field is required.',
	    	'gaz_date.date'=>'The date field is not a valid date.',
	    	'gaz_pdf_filename.required' => 'The pdf file field is required.',
	    	'gaz_pdf_filename.mimes' => 'The pdf filename must be a file of type: pdf.',
	    	'gaz_pdf_filename.max' => 'The pdf file must maximum of 2MB of file size.',
	    	'gaz_image.required' => 'The featured image field is required.',
	    	'gaz_image.mimes' => 'The featured image must be a file of type: jpg.',
	    	'gaz_image.max' => 'The featured image must maximum of 2MB of file size.',
	    	'gaz_status.required' => 'The status field is required.'
	    	]
	    );

	    if ($validator->passes()) {
	    	$falcon_gazette = new falcon_gazette;
	    	
	    	if($request->gaz_pdf_filename->getClientOriginalExtension() == "pdf") {
		        // UPLOAD PDF FILE
		        $input = $request->all();
		        $input['gaz_pdf_filename'] = time().'.'.$request->gaz_pdf_filename->getClientOriginalExtension();
		        $request->gaz_pdf_filename->move(public_path('uploads/falcon-gazette'), $input['gaz_pdf_filename']);

		        $gaz_image = sha1(time()).'.'.$request->gaz_image->getClientOriginalExtension();
                $request->file('gaz_image')->move(public_path('uploads/falcon-gazette'), $gaz_image);
		       
 
	        	// SAVE DETAILS
		    	$falcon_gazette->gaz_title = $request->gaz_title;
		    	$falcon_gazette->gaz_date = $request->gaz_date;
		    	$falcon_gazette->gaz_status = $request->gaz_status;
		    	$falcon_gazette->gaz_pdf_filename = $input['gaz_pdf_filename'];
		    	$falcon_gazette->gaz_image = $gaz_image;
		    	$falcon_gazette->save();
		    	return response()->json(['code' => 1, 'messages' =>"Successfully Uploaded"]);
		        
		    } else {
		    	return response()->json(['code' => 2, 'messages' =>"Only PDF are accepted"]);
		    }

	        
	    } else {
	    	return response()->json(['code' => 0, 'messages' =>$validator->getMessageBag()]);
	    }
       

    } // END OF FUNCTION


    public function fetch_gazette_data(Request $request) {
    	$id = $request->id;
        $falcon_gazette= falcon_gazette::find($id);

        return view('cpanel.partials.gazette_update_form', ['falcon_gazette' => $falcon_gazette]);

    } // END OF FUNCTION


    public function gazette_update_save(Request $request) {
    	
		$validator = Validator::make($request->all(), 
			[
	        'gaz_title' => 'required',
	        'gaz_date' => 'required|date',
	        'gaz_pdf_filename' => 'max:2048',
	        'gaz_status' => 'required',
	    	],
	    	[
	    	'gaz_title.required' => 'The title field is required.',
	    	'gaz_date.required' => 'The date field is required.',
	    	'gaz_date.date'=>'The date field is not a valid date.',
	    	'gaz_pdf_filename.required' => 'The pdf file field is required.',
	    	'gaz_pdf_filename.mimes' => 'The pdf filename must be a file of type: pdf.',
	    	'gaz_pdf_filename.max' => 'The pdf file must maximum of 2MB of file size.',
	    	'gaz_status.required' => 'The status field is required.'
	    	]
	    );

	    if ($validator->passes()) {
	    	$falcon_gazette = falcon_gazette::find($request->id);
	    	

	    	if(!empty($request->gaz_pdf_filename)) {
		    	if($request->gaz_pdf_filename->getClientOriginalExtension() == "pdf") {
			        //DELETE EXISTING FILE
			        $old_pdf_path='uploads/falcon-gazette/'.$falcon_gazette->gaz_pdf_filename;
			        if(file_exists($old_pdf_path)){
				        @unlink($old_pdf_path);
				    }

			        // UPLOAD PDF FILE
			        $input = $request->all();
			        $input['gaz_pdf_filename'] = time().'.'.$request->gaz_pdf_filename->getClientOriginalExtension();
			        $request->gaz_pdf_filename->move(public_path('uploads/falcon-gazette'), $input['gaz_pdf_filename']);
			      
			      	$falcon_gazette->gaz_pdf_filename = $input['gaz_pdf_filename']; 
			    } else {
			    	return response()->json(['code' => 2, 'messages' =>"Only PDF are accepted"]);
			    }
			} 

		    $falcon_gazette->gaz_title = $request->gaz_title;
	    	$falcon_gazette->gaz_date = $request->gaz_date;
	    	$falcon_gazette->gaz_status = $request->gaz_status;
	    	$falcon_gazette->save();


		    return response()->json(['code' => 1, 'messages' =>"Successfully Updated"]);

	        
	    } else {
	    	return response()->json(['code' => 0, 'messages' =>$validator->getMessageBag()]);
	    }
       

    } // END OF FUNCTION

    public function gazette_delete(Request $request) {
    	$id = $request->id;
        // DELETE GAZETTE
        $falcon_gazette= falcon_gazette::find($id);
        // DELETE FILE
        $pdf_path='uploads/falcon-gazette/'.$falcon_gazette->gaz_pdf_filename;
        if(file_exists($pdf_path)){
	        @unlink($pdf_path);
	    }

        $falcon_gazette->delete();

    } // END OF FUNCTION

}
