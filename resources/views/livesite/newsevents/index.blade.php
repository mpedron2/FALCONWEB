@extends('livesite.layout.layout')
@section('title', 'News &#38; Events')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a href="news-events/create" class="btn btn-primary">Add News & Events</a>
            </div>
            <div class="clearfix"></div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach($newsevents as $article)
                            <tr>
                                <td>{{ $article->newsevents_title }}</td>
                                <td>{{ $article->newsevents_date }}</td>
                                <td align="right">
                                    <button class="btn btn-success">Update</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table> 
            </div>
        </div>
    </div>

@endsection