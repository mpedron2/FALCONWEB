@extends('layouts.main')
@section('title', 'Falcon School | Contact Us')
@section('body-contents')
	
  <div class="no-header container m-b-6">
    <div class="row">
      <h1 class="bottom-bar">Contact Us</h1>
      <div class="col-sm-12 col-md-8">
        
        <!-- <form id="inquireNow" name="inquireNow" action="{{ route('contact.form.save') }}" method="POST" class="form"> -->
        <form id="inquireNow" name="inquireNow" class="form">
          {{ csrf_field() }}

          <input type="hidden" class="form-control" id="level" name="level" value="General Inquiry">
          <div class="form-group">
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Name">
            <div class="help-block has-error text-center" id="fullname-error"></div>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            <div class="help-block has-error text-center" id="email-error"></div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
            <div class="help-block has-error text-center" id="mobile-error"></div>
          </div>
          <div class="form-group">
            <textarea id="message" name="message" class="form-control" rows="3" placeholder="Message"></textarea>
            <div class="help-block has-error text-center" id="message-error"></div>
          </div>
          <button class="btn btn-info w-100">Inquire Now</button>
        </form>

      </div>
      <div class="col-md-4 col-sm-12">
        <div class="side-widget">
          <h3 class="m-t-0">Address</h3>
          <p>Blk 13, Lot 6, Dahlia Avenue, Brgy. West Fairview, Quezon City, Philippines 1118</p>
          <h3>Phone</h3>
          <a href="tel:+6329395848">939 58 48</a> / <a href="tel:+6329397475">939 74 75</a>  
          <h3>Email</h3>
          <a href="mailto:contact@falcon.edu.ph">contact@falcon.edu.ph</a>
        </div>
      </div>
    </div>
  </div>

  
  @include('partials.inquiry_success_modal')
  



@endsection

@section('additional-scripts')
	<script type="text/javascript">
		$('html').addClass('about-us');

    $(function(){
      $("#nav--core-values").addClass('active');
    });

    
	</script>

  <script type="text/javascript">
    // INQUIRY SUMBIT
    $('#inquireNow').on('submit', function(e) {
        e.preventDefault();
        var form_data =  $("#inquireNow").serialize();
        
        $.ajax({
            type: "post",
            url: "{{ route('contact.form.save') }}",
            data: form_data,
            success : function (retData) {

              $('.has-error').html('');

              var event_error_logs;
              if(retData.code == 0) {
                  for(var err in retData.messages) {
                    $('#'+err+'-error').html('<code>'+ retData.messages[err] +'</code>');
                  }
                  
              } else {
                $("#inquiry_success").modal();
              }
            }
        })
    });


    $('#inquiry_success').on('hidden.bs.modal', function (e) {
      location.reload();
    });
  </script>

  
@endsection 




