<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use DB;
use Validator;
use View;
use File;

use App\Gallery;
use App\school_levels;
use App\gallery_level;
use App\FileUploads;
use App\GalleryImages;
use App\GalleryTime;

class GalleryController extends Controller
{
    
	public function __construct() {
		$this->middleware('auth', ['except' => 'logout']);
	}

    public function index() {
    	$gallery=Gallery::all();
    	return view('cpanel.gallery.gallery', compact('gallery'));
    }

    public function album_add_modal() {
    	$levels=school_levels::all();
    	return view('cpanel.partials.album_add_form', ['levels'=>$levels]);
    }


    public function fetch_album_data(Request $request) {
        $levels = school_levels::all();
        $gallery = Gallery::find($request->id);
        $gallery_level = DB::table('gallery_level')
            ->join('gallery', 'gallery.id', '=', 'gallery_level.gallery_id')
            ->join('school_levels', 'school_levels.id', '=', 'gallery_level.level_id')
            ->select('gallery_level.*', 'gallery.*', 'school_levels.*')
            ->where('gallery.id', '=', $request->id)
            ->get();

        $gallery_types = DB::table('gallery_type')
            ->join('gallery', 'gallery.id', '=', 'gallery_type.gallery_id')
            ->where('gallery_type.gallery_id', '=', $request->id)
            ->get();    

        return view('cpanel.partials.album_update_form', compact('gallery', 'levels', 'gallery_level', 'gallery_types'));
    }


    public function gallery_update_save(Request $request) {
        $gallery = Gallery::find($request->id);

        
        $rules = [
            'gal_name'=>'required',
            'gal_date'=>'required|date',
            'gal_desc'=>'nullable',
            'gal_status'=>'required',
            'gallery_type'=>'required',
            'gal_levels'=>'required' 
        ];

        $message = [
            'gal_name.required'=>'The ALBUM TITLE field is required.',
            'gal_date.required'=>'The DATE field is required.',
            'gal_date.date'=>'Please enter the correct DATE format.',
            'gal_status.required'=>'The STATUS field is required.',
            'gallery_type.required'=>'Please check at least (1) ALBUM TYPE.',
            'gal_levels.required'=>'Please check at least (1) APPLICABLE LEVELS.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()) {
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {
            $gallery->gal_name = $request->gal_name;
            $gallery->gal_date = $request->gal_date;
            $gallery->gal_desc = $request->gal_desc;
            $gallery->gal_status = $request->gal_status;
            $gallery->save(); 

            // DELETE GALLERY LEVEL
            DB::table('gallery_level')->where('gallery_id', '=', $request->id)->delete();
            // RE-INSERT THE GALLERY LEVEL
            $gal_levels=$request->input('gal_levels');
            $gallery_id = $gallery->id;
            if(isset($gal_levels)) {
                $dataset = [];
                foreach ($gal_levels as $level_id) {
                     $dataSet[] = [
                        'level_id'  => $level_id,
                        'gallery_id'    => $gallery_id
                    ];
                }

                DB::table('gallery_level')->insert($dataSet);
            }

            // DELETE GALLERY TYPE
            DB::table('gallery_type')->where('gallery_id', '=',  $request->id)->delete();
            $gallery_types = $request->input('gallery_type');
            if(isset($gallery_types)) {
                $type_dataset = [];
                foreach ($gallery_types as $gallery_type) {
                    $type_dataset[] = [
                        'gallery_id' => $gallery_id,
                        'gallery_type' => $gallery_type
                    ];
                }

                DB::table('gallery_type')->insert($type_dataset);
            }






            return response()->json(['code' => 1, 'messages' => 'Album Successfully Updated']);
        }
    }


    public function gallery_add_save(Request $request) {
    	$gallery = new Gallery;

        
        $rules = [
            'gal_name'=>'required',
            'gal_date'=>'required|date',
            'gal_desc'=>'nullable',
            'gal_status'=>'required',
            'gallery_type'=>'required',
            'gal_levels'=>'required' 
        ];

        $message = [
            'gal_name.required'=>'The ALBUM TITLE field is required.',
            'gal_date.required'=>'The DATE field is required.',
            'gal_date.date'=>'Please enter the correct DATE format.',
            'gal_status.required'=>'The STATUS field is required.',
            'gallery_type.required'=>'Please check at least (1) ALBUM TYPE.',
            'gal_levels.required'=>'Please check at least (1) APPLICABLE LEVELS.'
        ];


    	$validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()) {
        	return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {
        	$gallery->gal_name = $request->gal_name;
        	$gallery->gal_date = $request->gal_date;
        	$gallery->gal_desc = $request->gal_desc;
        	$gallery->gal_status = $request->gal_status;
        	$gallery->save();

        	$gal_levels=$request->input('gal_levels');
            $gallery_id = $gallery->id;
            if(isset($gal_levels)) {
                $dataSet = [];
                foreach ($gal_levels as $level_id) {
                    $dataSet[] = [
                        'level_id'  => $level_id,
                        'gallery_id'    => $gallery_id
                    ];
                }

                DB::table('gallery_level')->insert($dataSet);

            }


            $gallery_types=$request->input('gallery_type');
            if(isset($gallery_types)) {
                $typedataset = [];
                
                foreach ($gallery_types as $gallery_type) {
                    $typedataset[] =[
                        'gallery_id'=>$gallery_id,
                        'gallery_type'=>$gallery_type
                    ];
                }

                DB::table('gallery_type')->insert($typedataset);    
            }

        	return response()->json(['code' => 1, 'messages' => 'Album Successfully Added']);

        }
    }



    public function manage_gallery(Request $request) {
        $album=Gallery::find($request->id);

        $gallery_pictures = DB::table('gallery')
        ->join('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
        ->join('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
        ->where('gallery.id', $request->id)
        ->orderBy('gallery_images.img_order', 'asc')
        ->get();

        return view('cpanel.gallery.manage_gallery', compact('album', 'gallery_pictures'));
    }


    public function post_gallery(Request $request) {
        $file_uploads = new FileUploads;
        $gallery_images = new GalleryImages;

        $images_count = DB::table('gallery_images')
        ->where('gal_id_fk', $request->gal_id_fk)
        ->count();

        $file_src_url = 'uploads/gallery/';

        if ($request->hasFile('file')) {
            // UPLOAD IMAGE
            $file_size=$request->file('file')->getClientSize();
            $image = $request->file('file');
            $imageName = sha1(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'),$imageName);

            $data = getimagesize(public_path('uploads/gallery/'.$imageName));
            $width = $data[0];
            $height = $data[1];

            $file_uploads->file_title = $request->file_title;
            $file_uploads->file_filename = $imageName;
            $file_uploads->file_type = $image->getClientOriginalExtension();
            $file_uploads->file_width = $width;
            $file_uploads->file_height = $height;
            $file_uploads->file_size = $file_size;
            $file_uploads->file_src_url = $file_src_url;
            $file_uploads->save();

            $gallery_images->gal_id_fk = $request->gal_id_fk;
            $gallery_images->img_id_fk = $file_uploads->id;
            $gallery_images->img_order = $images_count+1;
            $gallery_images->save();


            return redirect()->route('manage_gallery');
        } else {

        }

    }

    public function fetch_images_data(Request $request) {
        $FileUploads = FileUploads::find($request->id);  
        return view('cpanel.partials.gallery_images_update_form', ['FileUploads' => $FileUploads]);
    }


    public function images_data_update_save(Request $request) {
        $FileUploads = FileUploads::find($request->id);

        $validator = Validator::make($request->all(), [
            'file_title' => 'required'
        ]);

        if($validator->passes()) {
            $FileUploads->file_title = $request->file_title;
            $FileUploads->save();

            return response()->json(['code' => 1, 'messages' => 'Successfully Updated']);
        } else {
            return response()->json(['code' => 0, 'messages' => $validator->errors()->all()]);
        }

    }


    public function images_sorting_save(Request $request) {
        $items = $request->input('item');
        $img_order=0;
        foreach ($items as $img_id_fk) {
            $img_order++;
            $GalleryImages = DB::table('gallery_images')
            ->where('img_id_fk', $img_id_fk)
            ->update(['img_order' => $img_order]);
        }

    }


    public function delete_gallery_images(Request $request) {
        $FileUploads = FileUploads::find($request->id);

        $images_path='uploads/gallery/'.$FileUploads->file_filename;
        if(file_exists($images_path)){
            @unlink($images_path);
        }

        $FileUploads->delete();
        $GalleryImages = DB::table('gallery_images')->where('img_id_fk', '=',  $request->id)->delete();
    }



}
