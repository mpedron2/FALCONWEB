<!-- MODAL -->
 <div class="modal fade" id="inquiries_view_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        
          <div class="modal-header box-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">View Inquiry Details</h4>
          </div>

          <div class="modal-body">

              
              <div class="form-group">
                <label>Inquiry Date and Time: </label>
                <p>{{ date('F d, Y | h:i:s a', strtotime($inquiry->created_at)) }}</p>
                <hr>
              </div>

              <div class="form-group">
                <label>Level: </label>
                <p>{{ $inquiry->level }}</p>
                <hr>
              </div>

              <div class="form-group">
                <label>Full Name: </label>
                <p>{{ $inquiry->fullname }}</p>
                <hr>
              </div>

              <div class="form-group">
                <label>Email Address: </label>
                <p>{{ $inquiry->email }}</p>
                <hr>
              </div>

              <div class="form-group">
                <label>Mobile #: </label>
                <p>{{ $inquiry->mobile }}</p>
                <hr>
              </div>


              <div class="form-group">
                <label>Message: </label>
                <p>{{ $inquiry->  message }}</p>
                <hr>
              </div>

              
              
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          </div>
        
        </div>
    </div>
</div>


