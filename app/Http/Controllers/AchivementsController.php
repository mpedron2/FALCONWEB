<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Achivements;

class AchivementsController extends Controller
{
    



    public function achievements_all(Request $request) {

        

        // FILTER BY: LEVEL ONLY
        if(!empty($request->level) && empty($request->year)) {
           switch ($request->level) {
                case 'pre-school': $level=1; break;
                case 'grade-school': $level=2; break;
                case 'junior-high': $level=3; break;
                case 'senior-high': $level=4; break;
                case 'all': $level=""; break;
                default: $level=""; break;
            }

            $achievements_data_all = DB::table('achivements')
            ->leftJoin('achivements_level as level', 'level.achivements_id', '=', 'achivements.id')
            ->where('level.level_id', '=', $level)
            ->where('achivements.ach_status', 'Published')
            ->groupBy('level.achivements_id')
            ->paginate(12)
            ->appends('level', $request->level);

        // FILTER BY: YEAR ONLY
        } else if(empty($request->level) && !empty($request->year)) {
           
            $achievements_data_all = DB::table('achivements')
            ->leftJoin('achivements_level as level', 'level.achivements_id', '=', 'achivements.id')
            ->where('achivements.ach_date_awarded', 'like', $request->year.'%')
            ->where('achivements.ach_status', 'Published')
            ->groupBy('level.achivements_id')
            ->paginate(12)
            ->appends('level', $request->year);

        // FILTER BY: LEVEL & YEAR
        } else if(!empty($request->level) && !empty($request->year)) {
           switch ($request->level) {
                case 'pre-school': $level=1; break;
                case 'grade-school': $level=2; break;
                case 'junior-high': $level=3; break;
                case 'senior-high': $level=4; break;
                case 'all': $level=""; break;
                default: $level=""; break;
            }

            $achievements_data_all = DB::table('achivements')
            ->leftJoin('achivements_level as level', 'level.achivements_id', '=', 'achivements.id')
            ->where('level.level_id', '=', $level)
            ->where('achivements.ach_date_awarded', 'like', $request->year.'%')
            ->where('achivements.ach_status', 'Published')
            ->groupBy('level.achivements_id')
            ->paginate(12)
            ->appends(['year' => $request->year, 'level' => $request->level]);


        // NO FILTER
        } else {
            $achievements_data_all = Achivements::where('ach_status', 'Published')
            ->select('achivements.*', 'id as achivements_id')
            ->orderBy('ach_date_awarded', 'desc')
            ->simplePaginate(12);
        }


    	if($request->ajax()) {
    		return view('partials.achievement-data', ['achievements_data_all' => $achievements_data_all])->render();
    	}

    	return view('achievements', compact('achievements_data_all'));
    }


    public function achievements_details(Request $request) {
        $id = $request->id;
        $achievements_details = Achivements::find($id);

         $achievements_gallery = DB::table('achivements')
            ->leftJoin('achivements_images as ach_img', 'ach_img.ach_id_fk', '=', 'achivements.id')
            ->leftJoin('gallery', 'gallery.id', '=', 'ach_img.gallery_id')
            ->leftJoin('gallery_images', 'gallery_images.gal_id_fk', '=', 'gallery.id')
            ->leftJoin('file_uploads', 'file_uploads.id', '=', 'gallery_images.img_id_fk')
            ->where('achivements.id', '=', $id)
            ->get();


        return view('achievements-details', compact('achievements_details', 'achievements_gallery'));
            
    }
    
}
