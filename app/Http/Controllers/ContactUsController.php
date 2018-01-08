<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inquiry;
use App\Mail\InquiryEmail;

use Validator;
use Mail;


class ContactUsController extends Controller
{
    public function index(){
    	return view('contact-us');
    }

    public function contact_form_save(Request $request) {
    	
        $validator = Validator::make($request->all(),
            [
            'level'=>'required',
            'fullname'=>'required',
            'email'=>'required|email',
            'mobile'=>'required',
            'message'=>'required'

            ]
        );


        if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {
            $inquiry = Inquiry::create(
            	request(['level', 'fullname', 'email', 'mobile', 'message'])
            );

            $inquiry_request = ['email'=>$request->email];

            $email_data = ([
                'email' => $request->email,
                'fullname' => $request->fullname,
                'mobile' => $request->mobile,
                'message' => $request->message,
                'level' => $request->level
            ]);

            Mail::to('mpedron2@gmail.com')->send(new InquiryEmail($email_data));


            return response()->json(['code' => 1, 'messages' => 'Inquiry Submitted']);
        }

    }

    
}
