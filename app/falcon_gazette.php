<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class falcon_gazette extends Model
{
    protected $table = 'falcon_gazette';
    protected $fillable = ['gaz_title', 'gaz_date', 'gaz_pdf_filename', 'gaz_pdf_size', 'gaz_status'];
}
