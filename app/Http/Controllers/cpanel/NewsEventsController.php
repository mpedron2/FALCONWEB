<?php

namespace App\Http\Controllers\cpanel;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\newsevents;
use App\school_levels; 

use Validator;

use Auth;
use DB;
use View;



class NewseventsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'logout']);
    }

    public function index()
    {
        $news_events = newsevents::all();
        return view('cpanel.news-events.cms-newsevents', ['news_events'=>$news_events]);
    }

    public function news_events_add() {
        $school_level = school_levels::all();
    	return view('cpanel.partials.news_events_add_form', ['school_level'=>$school_level]);
    }

    public function save_articles(Request $request) {
    	$news_events = new newsevents;
       

        if($request->article_type != 'Events') {
            $validator = Validator::make($request->all(),
                [
                'article_type'=>'required',
                'article_title'=>'required',
                'article_content'=>'nullable',
                'article_status'=>'nullable',
                'article_levels'=>'required',
                'article_featured_img'=>'nullable|max:300000|mimes:jpeg,jpg,png'
                ],
                [
                'article_levels.required'=>'Check atleast one (1) applicable levels.'
                ]
            );
        } else {
            $validator = Validator::make($request->all(),
                [
                'article_type'=>'required',
                'article_title'=>'required',
                'article_eventdate1'=>'required|date',
                'article_eventdate2'=>'date|after:article_eventdate1',
                'article_content'=>'nullable',
                'article_status'=>'nullable',
                'article_levels'=>'required',
                'article_featured_img'=>'nullable|max:300000|mimes:jpeg,jpg,png'
                ],
                [
                'article_levels.required'=>'Check atleast one (1) applicable levels.',
                'article_eventdate1.required'=>'The article start date field is required.',
                'article_eventdate1.date'=>'The event start date is not a valid date.',
                'article_eventdate2.date'=>'The event end date is not a valid date.',
                'article_eventdate2.after'=>'Invalid start and end date'
                ]
            );    
        }

        if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {

            // UPLOAD FEATURED IMG
            if($request->hasFile('article_featured_img')) {
                $file = $request->file('article_featured_img');
                $file_ext = $file->getClientOriginalExtension();

                if($file_ext == "jpg" || $file_ext == "jpeg" || $file_ext == "JPG") {
                    $article_featured_img = sha1(time()).'.'.$file_ext;
                    $request->file('article_featured_img')->move(public_path('uploads/articles'), $article_featured_img);
                } else {
                    return response()->json(['code' => 2, 'messages' =>"Only jpg,jpef,JPG are accepted to Article Featured Image Upload"]);
                }

                $news_events->article_featured_img = $article_featured_img;
            } 


            $news_events->article_type = $request->article_type;
            $news_events->article_title = $request->article_title;
            $news_events->article_date = date('Y-m-d');
            $news_events->article_eventdate1 = $request->article_eventdate1;
            $news_events->article_eventdate2 = $request->article_eventdate2;
            $news_events->article_content = $request->article_content;
            $news_events->article_status = $request->article_status;
            
            $news_events->save();

            $article_levels=$request->input('article_levels');
            if(isset($article_levels)) {
                $article_id=$news_events->id;
                $dataset = [];
                foreach ($article_levels as $level_id) {
                    $dataset[] = [
                        'level_id'=>$level_id,
                        'article_id'=>$article_id
                    ];
                }

                DB::table('article_level')->insert($dataset);
            }



             return response()->json(['code' => 1, 'messages' => 'Event Successfully Added']);

        }
    }


    public function fetch_articles_data(Request $request) {
        $article_details = NULL;
        if ($request->id) {
            $article_details = newsevents::where('id', $request->id)->first();
        }

        $gallerys = DB::table('gallery')
        ->join('gallery_type', 'gallery.id', '=', 'gallery_type.gallery_id')
        ->where('gallery_type.gallery_type', '=', 'articles')
        ->where('gallery.gal_status', '=', 'Published')
        ->get();

        $article_images = DB::table('article_images')->where('article_id_fk', '=', $request->id)->get();

        $school_level = school_levels::all();

        $articles_level_checked = DB::table('article_level')->where('article_id', '=', $request->id)->get();


        return view('cpanel.partials.news_events_update_form', compact('article_details', 'gallerys', 'article_images', 'school_level', 'articles_level_checked')); 

    }

    public function news_events_update(Request $request) {
        $news_events = newsevents::find($request->id);
        $news_events->article_type = $request->article_type;
        $news_events->article_title = $request->article_title;
        $news_events->article_content = $request->article_content;
        $news_events->article_eventdate1 = $request->article_eventdate1;
        $news_events->article_eventdate2 = $request->article_eventdate2;
        $news_events->article_status = $request->article_status;


        if($request->article_type != 'Events') {
            $validator = Validator::make($request->all(),
                [
                'article_type'=>'required',
                'article_title'=>'required',
                'article_content'=>'nullable',
                'article_status'=>'nullable',
                'article_levels'=>'required',
                'article_featured_img'=>'nullable|max:300000|mimes:jpeg,jpg,png'
                ]
            );
        } else {
            $validator = Validator::make($request->all(),
                [
                'article_type'=>'required',
                'article_title'=>'required',
                'article_eventdate1'=>'required|date',
                'article_eventdate2'=>'date|after:article_eventdate1',
                'article_content'=>'nullable',
                'article_status'=>'nullable',
                'article_levels'=>'required',
                'article_featured_img'=>'nullable|max:300000|mimes:jpeg,jpg,png'
                ],
                [
                'article_levels.required'=>'Check atleast one (1) applicable levels.',
                'article_eventdate1.required'=>'The article start date field is required.',
                'article_eventdate1.date'=>'The event start date is not a valid date.',
                'article_eventdate2.date'=>'The event end date is not a valid date.',
                'article_eventdate2.after'=>'Invalid start and end date'
                ]
            );    
        }


        
        if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {

            // FEATURED IMAGE 
            if($request->hasFile('article_featured_img')) {                
                // DELETE IMAGE
                $images_path='uploads/articles/'.$news_events->article_featured_img;
                if(file_exists($images_path)){
                    @unlink($images_path);
                }

                // UPLOAD NEW IMAGE
                $file = $request->file('article_featured_img');
                $file_ext = $file->getClientOriginalExtension();
                $article_featured_img = sha1(time()).'.'.$file_ext;
                $request->file('article_featured_img')->move(public_path('uploads/articles'), $article_featured_img);

                $news_events->article_featured_img = $article_featured_img;
            } else {
                $news_events->article_featured_img = $news_events->article_featured_img;
            }


            // DELETE EXISTING LEVEL
            DB::table('article_level')->where('article_id', '=', $request->id)->delete();

            // ADD CHECKED LEVEL
            $article_levels=$request->input('article_levels');
            if(isset($article_levels)) {
                $article_id=$news_events->id;
                $dataset = [];
                foreach ($article_levels as $level_id) {
                    $dataset[] = [
                        'level_id'=>$level_id,
                        'article_id'=>$article_id
                    ];
                }

                DB::table('article_level')->insert($dataset);
            }

            // SAVE UPDATES IN NEWS AND EVENTS
            $news_events->save();
            return response()->json(['code' => 1, 'messages' => 'Event Successfully Added']);
        }    

    }

    public function news_events_delete(Request $request) {
        $id = $request->id;
        $articles= newsevents::find($id);

        if(!empty($articles->article_featured_img)) {
            $images_path='uploads/articles/'.$articles->article_featured_img;
            if(file_exists($images_path)){
                @unlink($images_path);
            }
        }

        DB::table('article_level')->where('article_id', '=', $id)->delete();
        DB::table('article_images')->where('article_id_fk', '=', $id)->delete();


        $articles->delete();
        return back();
    }


    public function selected_gallery_save(Request $request) {

        $gal_ids = $request->input('gal_id');
        $article_id_fk = $request->article_id_fk;
        if($gal_ids) {
            // DELETE THE EXISTING GALLERY
            DB::table('article_images')->where('article_id_fk', '=', $article_id_fk)->delete();

            // SAVE NEW GALLERY
            $dataset = [];
            foreach ($gal_ids as $gallery_id) {
                $dataset[] = [
                    'gallery_id' => $gallery_id,
                    'article_id_fk' => $article_id_fk
                ];
                
            }

            DB::table('article_images')->insert($dataset);
        }


    }

}
