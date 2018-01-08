<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Gallery;

class GalleriesController extends Controller
{
    public function facilities_gallery() {
    	$gal_facilities = DB::table('gallery')
    		->select('gallery.*','gallery_type.gallery_type', 'gallery_images.img_id_fk', 'file_uploads.file_title', 'file_uploads.file_filename')
	    	->leftJoin('gallery_type', 'gallery.id', '=', 'gallery_type.gallery_id')
	    	->leftJoin('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
	    	->leftJoin('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
	    	->where('gallery_type.gallery_type', '=', 'facilities')
	    	->where('gallery.gal_status', '=', 'Published')
	    	->groupBy('gallery.id')
	    	->get();

	    return view('facilities', compact('gal_facilities'));

    }

    public function fetch_facilities_details(Request $request) {
    	$gal_id = $request->id;

    	$facilities_details = Gallery::find($gal_id);
	    	

		$facilities_gallery_images = DB::table('gallery')
	    	->leftJoin('gallery_type', 'gallery.id', '=', 'gallery_type.gallery_id')
	    	->leftJoin('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
	    	->leftJoin('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
	    	->where('gallery.id', '=', $gal_id)
	    	->groupBy('file_uploads.id')
	    	->orderBy('gallery_images.img_order', 'asc')
	    	->get();

	    return view('facilities-details', compact('facilities_details', 'facilities_gallery_images'));


    }

    public function gallery() {
    	$galleries = DB::table('gallery')
    		->select('gallery.*','gallery_type.gallery_type', 'gallery_images.img_id_fk', 'file_uploads.file_title', 'file_uploads.file_filename')
	    	->leftJoin('gallery_type', 'gallery.id', '=', 'gallery_type.gallery_id')
	    	->leftJoin('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
	    	->leftJoin('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
	    	->where('gallery_type.gallery_type', '=', 'gallery')
	    	->where('gallery.gal_status', '=', 'Published')
	    	->groupBy('gallery.id')
	    	->get();

	    return view('gallery', compact('galleries'));

    }


    public function fetch_gallery_details(Request $request) {
    	$gal_id = $request->id;

    	$gallery_details = Gallery::find($gal_id);
	    	

		$gallery_images = DB::table('gallery')
	    	->leftJoin('gallery_type', 'gallery.id', '=', 'gallery_type.gallery_id')
	    	->leftJoin('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
	    	->leftJoin('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
	    	->where('gallery.id', '=', $gal_id)
	    	->groupBy('file_uploads.id')
	    	->orderBy('gallery_images.img_order', 'asc')
	    	->get();

	    return view('gallery-details', compact('gallery_details', 'gallery_images'));


    }

}
