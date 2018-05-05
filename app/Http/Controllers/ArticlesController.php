<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\newsevents;


class ArticlesController extends Controller
{
    public function fetch_article_data(Request $request) {
    	$article_details = newsevents::find($request->id);

    	$related_articles = DB::table('news_events')
    		->where('article_type', $article_details->article_type)
            ->where('article_status', 'Published')
    		->orderBy('article_date', 'desc')
    		->limit(3)
    		->get();

        $related_gallery = DB::table('article_images')
            ->select('article_images.gallery_id', 'article_images.article_id_fk', 'gallery.*', 'gallery_images.img_id_fk', 'file_uploads.file_title', 'file_uploads.file_filename')
            ->leftJoin('gallery', 'article_images.gallery_id', '=', 'gallery.id')
            ->leftJoin('gallery_images', 'gallery.id', '=', 'gallery_images.gal_id_fk')
            ->leftJoin('file_uploads', 'gallery_images.img_id_fk', '=', 'file_uploads.id')
            ->where('article_images.article_id_fk', '=', $request->id)
            ->where('gallery.gal_status', '=', 'Published')
            ->groupBy('gallery.id')
            ->get();

    	return view('article-details', compact('article_details', 'related_articles', 'related_gallery'));
    }


    public function news_announcements_data() {
        $news_announcements = DB::table('news_events')
            ->where('article_type', 'News')
            ->orWhere('article_type', 'Annoucements')
            ->where('article_status', 'Published')
            ->orderBy('article_date', 'desc')
            ->paginate(5);

        $upcoming_events = DB::table('news_events')
            ->where('article_type', 'Events')
            ->where('article_status', 'Published')
            ->orderBy('article_eventdate1', 'desc')
            ->limit(3)
            ->get();

        return view('article-news-announcements', compact('news_announcements', 'upcoming_events'));
    }

    public function articles_data_filter(Request $request) {
        $news_announcements = DB::table('news_events')
            ->where('article_type', $request->type)
            ->where('article_status', 'Published')
            ->orderBy('article_date', 'desc')
            ->paginate(5);

            $upcoming_events = DB::table('news_events')
            ->where('article_type', 'Events')
             ->where('article_status', 'Published')
            ->orderBy('article_eventdate1', 'desc')
            ->limit(3)
            ->get();

        $type = $request->type;

        return view('article-news-announcements', compact('news_announcements', 'upcoming_events', 'type'));
    }


    public function academic_calendar() {
        return view('academic-calendars');
    }

    public function fetch_event_fullcalendar() {
        $events = array();
        $data = DB::table('news_events')
            ->where('article_type', 'Events')
            ->where('article_status', 'Published')
            ->orderBy('article_eventdate1', 'desc')
            ->get();

        if($data->count()){
            $incI = 0;
            foreach ($data as $key => $value) {
                $events[$incI]['id']= $value->id;
                $events[$incI]['title']= $value->article_title;
                $events[$incI]['start']= $value->article_eventdate1;
                $events[$incI]['end']= date('Y-m-d',date(strtotime("+1 day", strtotime($value->article_eventdate2))));
                $incI++;
            }

       }

       $encodedEvents = json_encode($events);
       return $encodedEvents;

    }


    public function fetch_event_fullcalendar_details(Request $request) {
        $events_details = newsevents::find($request->id);

        return view('partials.events_view_modal', ['events_details' => $events_details]);

    }

}
