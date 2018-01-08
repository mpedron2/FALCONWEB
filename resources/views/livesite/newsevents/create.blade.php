@extends('livesite.layout.layout')
@section('title', 'Add News &#38; Events')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="/news-events" method="post">
               {{csrf_field() }} 

              <fieldset>
                <legend>Legend</legend>
                <div class="form-group">
                  <label for="newsevents_title" class="col-lg-2 control-label">Title</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="newsevents_title" name="newsevents_title" placeholder="Email">
                  </div>
                </div>

                <div class="form-group">
                  <label for="newsevents_date" class="col-lg-2 control-label">Date</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="newsevents_date" name="newsevents_date" placeholder="Email">
                  </div>
                </div>


                
                <div class="form-group">
                  <label for="newsevents_content" class="col-lg-2 control-label">Content</label>
                  <div class="col-lg-10">
                    <textarea class="form-control" rows="5" id="newsevents_content" name="newsevents_content"></textarea>
                  </div>
                </div>
                
               
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>


              </fieldset>
            </form>

            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif


        </div>
    </div>

@endsection