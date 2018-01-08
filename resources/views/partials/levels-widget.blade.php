<div class="side-widget m-t-6">
  <h3 class="text-center text-muted">Inquire Now</h3>

  <form id="inquireNow" name="inquireNow"  class="form">
    <input type="hidden" class="form-control" id="level" name="level" value="<?= $inq_level ?>">
    {{ csrf_field() }}
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

    <button type="submit" class="btn btn-info w-100">Inquire Now</button>

  </form>
</div>

@include('partials.inquiry_success_modal')