<div class="modal fade" id="events_view_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Event ({{ $events_details->article_title }})</h4>
            </div>
            <div class="modal-body">
               

               <div class="row">
                <div class="col-sm-12 col-md-12">

                  <h2 class="bottom-bar m-b-3">{{ $events_details->article_title }}</h2>
                  <small class="text-muted m-b-5">Event Date: <span class="posting-date text-danger">{{ date('F d, Y', strtotime($events_details->article_eventdate1)) }} - {{ date('F d, Y', strtotime($events_details->article_eventdate2)) }}</span></small>

                  @if(!empty($events_details-> article_featured_img))
                    <div class="w-100">
                        <img src="{{ asset('uploads/articles/'.$events_details->article_featured_img) }}" class="img-responsive">
                    </div>
                   @endif
                  
                  <div class="m-y-3">
                    <?= $events_details->article_content ?>
                  </div>

                  
                </div>
              </div>

                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



