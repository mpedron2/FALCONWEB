<?php

use Illuminate\Database\Seeder;

class SchoolLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_levels')->insert(array(
        	array(
        		'level_name'=>'Pre-School',
        		'created_at' => date("Y-m-d H:i:s"),
        		'updated_at' => date("Y-m-d H:i:s")
        	),

        	array(
        		'level_name'=>'Grade School',
        		'created_at' => date("Y-m-d H:i:s"),
        		'updated_at' => date("Y-m-d H:i:s")
        	),

        	array(
        		'level_name'=>'Junior High School',
        		'created_at' => date("Y-m-d H:i:s"),
        		'updated_at' => date("Y-m-d H:i:s")
        	),

        	array(
        		'level_name'=>'Senior High School',
        		'created_at' => date("Y-m-d H:i:s"),
        		'updated_at' => date("Y-m-d H:i:s")
        	)



        ));
    }
}
