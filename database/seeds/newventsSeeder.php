<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class newventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	

        DB::table('news_events')->insert(array(
        	array(
        		'article_title'=>'Falcon School News ',
        		'article_date'=>'2017-08-05',
        		'article_content'=>'Lorem ipsum dolor sit amet, graece perfecto ne mei, qui officiis mnesarchum no. Et qui agam prompta salutandi, per at inermis concludaturque, his tamquam oportere ad.',
        		'article_type'=>'News',
        		'article_status'=>'Published',
        		'article_eventdate1'=>'',
        		'article_eventdate2'=>'',
        	),

        	array(
        		'article_title'=>'Falcon School Events ',
        		'article_date'=>'2017-08-05',
        		'article_content'=>'Lorem ipsum dolor sit amet, graece perfecto ne mei, qui officiis mnesarchum no. Et qui agam prompta salutandi, per at inermis concludaturque, his tamquam oportere ad.',
        		'article_type'=>'Events',
        		'article_status'=>'Published',
        		'article_eventdate1'=>'',
        		'article_eventdate2'=>'',
        	),

        	array(
        		'article_title'=>'Falcon School Annoucements ',
        		'article_date'=>'2017-08-05',
        		'article_content'=>'Lorem ipsum dolor sit amet, graece perfecto ne mei, qui officiis mnesarchum no. Et qui agam prompta salutandi, per at inermis concludaturque, his tamquam oportere ad.',
        		'article_type'=>'Annoucements',
        		'article_status'=>'Draft',
        		'article_eventdate1'=>'',
        		'article_eventdate2'=>'',
        	)



        ));
    }
}
