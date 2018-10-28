<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SchoolLevelController extends Controller
{
    
	// ======= PRE SCHOOL =======
    public function school_level(Request $request) {
    	
    	switch ($request->level) {
    		case 'pre-school': 
    			$levelID=1;
    			$view_page = 'pre-school-level'; 
    		break;
    		case 'grade-school': 
    			$levelID=2; 
    			$view_page = 'grade-school-level';
    		break;
    		case 'junior-high': 
    			$levelID=3;
    			$view_page = 'junior-high-level'; 
    		break;
    		case 'senior-high': 
    			$levelID=4;
    			$view_page = 'senior-high-level'; 
    		break;
    		default:
				$levelID=1;
    			$view_page = 'pre-school-level';
			break;
    	}

    	$related_articles = DB::table('news_events')
    		->leftJoin('article_level', 'article_level.article_id', '=', 'news_events.id')
    		->where('article_level.level_id', '=', $levelID)
    		->where('news_events.article_status', '=', 'Published')
    		->orderBy('news_events.article_date', 'desc')
    		->paginate(5);

    	$gallery = DB::table('gallery')
    		->select('gallery.*', 'gallery_level.*', 'gallery_images.img_id_fk', 'file_uploads.file_title', 'file_uploads.file_filename')
	    	->leftJoin('gallery_level', 'gallery.id', '=', 'gallery_level.gallery_id')
	    	->leftJoin('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
	    	->leftJoin('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
	    	->where('gallery.gal_status', '=', 'Published')
	    	->where('gallery_level.level_id', '=', $levelID)
	    	->groupBy('gallery.id')
	    	->get();

    	return view($view_page, compact('related_articles', 'gallery'));
    }

    public function school_gallery_images(Request $request) {
    	$gal_id = $request->id;

    	$gallery_images = DB::table('gallery')
	    	->leftJoin('gallery_type', 'gallery.id', '=', 'gallery_type.gallery_id')
	    	->leftJoin('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
	    	->leftJoin('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
	    	->where('gallery.id', '=', $gal_id)
	    	->groupBy('file_uploads.id')
	    	->get();

	    
	    $items_dataset = array();
	    foreach ($gallery_images as $images) {
	    	$items_dataset[] = [
	    		'src' => asset('uploads/gallery/'.$images->file_filename),
	    		'w' => $images->file_width,
	    		'h' => $images->file_height,
	    		'title' => $images->file_title
	    	];		
	    }

	    $gallery_item = json_encode($items_dataset);
       return $gallery_item;
    }


    // ======= PRE SCHOOL =======


}
