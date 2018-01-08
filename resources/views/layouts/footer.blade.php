<footer class="text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-12 col-sm-4">
                <span class="ion-icon ion-android-call"></span>
                <div class="m-b-4 p">
                    <a href="tel:+6329395848">939 58 48</a> / <a href="tel:+6329397475">939 74 75</a>  
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <span class="ion-icon ion-ios-location"></span>
                <div class="m-b-4 p">
                    <p>Blk 13, Lot 6, Dahlia Avenue, Brgy. West Fairview, Quezon City, Philippines 1118</p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <span class="ion-icon ion-android-drafts"></span>
                <div class="m-b-4 p">
                    <a href="mailto:contact@falcon.edu.ph">contact@falcon.edu.ph</a>
                </div>
            </div>
        </div>


        <hr>


        <div class="row">
            <div class="col-xs-12 col-sm-6 text-left">
                <p>© Copyright 2017 Falcon School</p>
            </div>

            <div class="col-xs-12 col-sm-6 text-right">
                <ul class="list-inline pull-right">
                    <li><a href="{{ url('/mission-vision') }}">About Us</a></li>
                    <li><a href="{{ route('school.level', ['level' => 'pre-school']) }}">Levels</a></li>
                    <li><a href="{{ route('gallery.all') }}">Gallery</a></li>
                    <li><a href="{{ route('article.newsannoucements') }}">News &amp; Events</a></li>
                    <li><a href="{{ route('contact.form') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>