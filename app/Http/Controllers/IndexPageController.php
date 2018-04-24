<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\falcon_gazette;

class IndexPageController extends Controller
{
    public function index() {

    	$latest_news = DB::table('news_events')
    		->where('article_type', 'News')
    		->orWhere('article_type', 'Annoucements')
    		->orderBy('article_date', 'desc')
    		->limit(3)
    		->get();

    	$upcoming_events = DB::table('news_events')
    		->where('article_type', 'Events')
    		->orderBy('article_eventdate1', 'desc')
    		->limit(5)
    		->get();

        $falcon_gazette = DB::table('falcon_gazette')
            ->where('gaz_status', 'Published')
            ->orderBy('gaz_date', 'desc')
            ->limit(1)
            ->get();


    	return view('index', compact('latest_news', 'upcoming_events', 'falcon_gazette'));
    }
}
