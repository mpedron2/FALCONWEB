<!-- MODAL -->
 <div class="modal fade" id="account_add_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box box-solid">
        <div class="overlay hidden"><i class="fa fa-spin fa-refresh"></i></div>
        <form id="form_add_accounts" method="post">
            <div class="modal-header box-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Account</h4>
            </div>

            <div class="modal-body">

                <div id="accounts_validation_error" class="alert alert-danger alert-dismissible" style="margin:10px 0; display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Error Adding the Account!</h4>
                    <ul></ul>

                </div>

                {{ csrf_field() }}
                <div class="form-group">
                    <div class="help-block has-error text-center" id="general-error"></div>
                </div>
                
                <div class="form-group">
                  <label for="name">Name: <span class="text-red">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" value="">
                  <div class="help-block has-error text-center" id="name-error"></div>
                </div>

                <div class="form-group">
                  <label for="contact">Contact #:</label>
                  <input type="text" class="form-control" id="contact" name="contact" value="">
                  <div class="help-block has-error text-center" id="contact-error"></div>
                </div>

                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" value="">
                  <div class="help-block has-error text-center" id="email-error"></div>
                </div>

                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password" value="">
                  <div class="help-block has-error text-center" id="password-error"></div>
                </div>

                <div class="form-group">
                  <label for="password_confirm">Confirm Password:</label>
                  <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="">
                  <div class="help-block has-error text-center" id="password_confirm-error"></div>
                </div>

                <div class="form-group">
                  <label for="role_id">Role:</label>
                  <select class="form-control" name="role_id" id="role_id">
                    <option value="">Select a role</option>
                    @if($roles)
                      @foreach($roles as $role)
                        @if($role->id != 2)
                          <option value="{{$role->id}}">{{$role->name}}</option>
                        @endif
                      @endforeach
                    @endif
                  </select>
                  <div class="help-block has-error text-center" id="role_id-error"></div>
                </div>


                
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-flat">Add</button>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>




<script type="text/javascript">
  
  // ADD ACHIVEMENTS AJAX
  $('#form_add_accounts').on('submit', function(e) {
      e.preventDefault();
      var form_data =  $("#form_add_accounts").serialize();


      $.ajax({
          type: "post",
          url: "{{ route('account.add.save') }}",
          data: form_data,
          success : function (retData) {

            $('.has-error').html('');

            var event_error_logs;
            if(retData.code == 0) {
                console.log(retData.messages);
                $('#accounts_validation_error ul').html("");
                $.each(retData.messages, function( index, value ) {
                    event_error_logs="<li>"+value+"</li>";
                    $('#accounts_validation_error ul').append(event_error_logs);
                });
                $('#accounts_validation_error').show();

                for(var err in retData.messages) {
                  $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
                }
                
                $('#account_add_modal').scrollTop(0);
            } else {
              location.reload();
            }
          }
      })
  });

  




</script>

