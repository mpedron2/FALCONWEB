<?php

namespace App\Http\Controllers\cpanel;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use View;
use App\Achivements;
use App\school_levels;
use App\achivements_level;

class AchivementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'logout']);
    }

    //
    public function index() {
    	$achivements = Achivements::all()->sortByDesc("ach_date_awarded");
        return view('cpanel.achivements.achivements', ['achivements'=>$achivements]);

        
    } // END OF FUNCTION

    public function achivements_add_form() {
        $levels = school_levels::all();
    	return view('cpanel.partials.achivements_add_form', ['levels'=>$levels]);
    } // END OF FUNCTION

    public function achivements_add_save(Request $request) {

        $achivements = new Achivements;
        


        $validator = Validator::make($request->all(),
            [
            'ach_title'=>'required',
            'ach_date_awarded'=>'required|date',
            'ach_context'=>'nullable',
            'ach_status'=>'required',
            'ach_levels'=>'required'

            ],
            [
            'ach_title.required'=>'The title field is required.',
            'ach_date_awarded.required'=>'The date awarded field is required.',
            'ach_date_awarded.date'=>'The date awarded is not a valid date.',
            'ach_status.required'=>'The status field is required.',
            'ach_levels.required'=>'Check atleast one (1) applicable levels.'
            ]
        );
       
        if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {
            $achivements->ach_title = $request->ach_title;
            $achivements->ach_subtitle = $request->ach_subtitle;
            $achivements->ach_date_awarded = $request->ach_date_awarded;
            $achivements->ach_context = $request->ach_context;
            $achivements->ach_status = $request->ach_status;
            $achivements->save();

            $ach_levels=$request->input('ach_levels');
            $achivements_id = $achivements->id;
            if(isset($ach_levels)) {
                $dataSet = [];
                foreach ($ach_levels as $level_id) {
                    $dataSet[] = [
                        'level_id'  => $level_id,
                        'achivements_id'    => $achivements_id
                    ];
                }

                DB::table('achivements_level')->insert($dataSet);

            }

            return response()->json(['code' => 1, 'messages' => 'Achivements Successfully Added']);

        }
    	
    } // END OF FUNCTION

    public function fetch_achivements_data(Request $request) {
        $levels = school_levels::all();

        $achivements_details = Achivements::where('id', $request->id)->first();

        $achivements_level = DB::table('school_levels')
            ->join('achivements_level', 'school_levels.id', '=', 'achivements_level.level_id')
            ->join('achivements', 'achivements.id', '=', 'achivements_level.achivements_id')
            ->where('achivements.id', '=', $request->id)
            ->select('school_levels.*', 'achivements_level.*', 'achivements.*')
            ->get();

        $gallerys = DB::table('gallery')
            ->join('gallery_type', 'gallery.id', '=', 'gallery_type.gallery_id')
            ->where('gallery_type.gallery_type', '=', 'achivements')
            ->where('gallery.gal_status', '=', 'Published')
            ->get();

        $achivements_images = DB::table('achivements_images')->where('ach_id_fk', '=', $request->id)->get();

        

        return view('cpanel.partials.achivements_update_form', compact('levels','achivements_details','achivements_level', 'gallerys', 'achivements_images'));


    } // END OF FUNCTIOM


    public function achivements_update_save(Request $request) {
        $achivements = Achivements::find($request->id);
        $achivements->ach_title = $request->ach_title;
        $achivements->ach_subtitle = $request->ach_subtitle;
        $achivements->ach_date_awarded = $request->ach_date_awarded;
        $achivements->ach_context = $request->ach_context;
        $achivements->ach_status = $request->ach_status;

        $validator = Validator::make($request->all(),
            [
            'ach_title'=>'required',
            'ach_date_awarded'=>'required|date',
            'ach_context'=>'nullable',
            'ach_status'=>'required',
            'ach_levels'=>'required'
            ]
            ,
            [
            'ach_title.required'=>'The title field is required.',
            'ach_date_awarded.required'=>'The date awarded field is required.',
            'ach_date_awarded.date'=>'The date awarded is not a valid date.',
            'ach_status.required'=>'The status field is required.',
            'ach_levels.required'=>'Check atleast one (1) applicable levels.'
            ]
        );

        if ($validator->fails()){
            return response()->json(['code' => 0, 'messages' => $validator->getMessageBag()]);
        } else {
            // SAVE ACHIVEMENTS UPDATE
            $achivements->save();

            // DELETE THE EXISTING ACHIVEMENT LEVELS
            DB::table('achivements_level')->where('achivements_id', '=', $request->id)->delete();

            // ADD NEW ACHIVEMENT LEVEL
            $ach_levels=$request->input('ach_levels');
            $achivements_id = $achivements->id;
            if(isset($ach_levels)) {
                $dataSet = [];
                foreach ($ach_levels as $level_id) {
                    $dataSet[] = [
                        'level_id'  => $level_id,
                        'achivements_id'    => $achivements_id
                    ];
                }

                DB::table('achivements_level')->insert($dataSet);

            }

            return response()->json(['code' => 1, 'messages' => 'Achivement Successfully Updated']);

        }

    } // END OF FUNCTION

    public function achivements_delete(Request $request) {
        $id = $request->id;
        // DELETE ACHIVEMENTS
        $achivements= Achivements::find($id);
        $achivements->delete();
        // DELETE ACHIVEMENT LEVELS
        DB::table('achivements_level')->where('achivements_id', '=', $id)->delete();

        return back();
    } // END OF FUNCTION


    public function ach_selected_gallery_save(Request $request) {
        $gal_ids = $request->input('gal_id');
        $ach_id_fk = $request->ach_id_fk;
        if($gal_ids) {
            // DELETE THE EXISTING GALLERY
            DB::table('achivements_images')->where('ach_id_fk', '=', $ach_id_fk)->delete();

            // SAVE NEW GALLERY
            $dataset = [];
            foreach ($gal_ids as $gallery_id) {
                $dataset[] = [
                    'gallery_id' => $gallery_id,
                    'ach_id_fk' => $ach_id_fk
                ];
                
            }

            DB::table('achivements_images')->insert($dataset);
        }


    }

}
