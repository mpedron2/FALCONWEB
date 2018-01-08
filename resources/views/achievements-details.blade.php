@extends('layouts.main')
@section('additional-css')
  <!-- Photoswipe -->
  <link rel="stylesheet" href="{{ asset('assets/lib/photoswipe/photoswipe.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/lib/photoswipe/default-skin/default-skin.css') }}">
@endsection
@section('title', 'Falcon School | Achievements')
@section('body-contents')
	<div class="no-header container m-b-6">
      <div class="row">
        <div class="col-sm-12 col-md-12">

          <?php 
            if(!empty($achievements_details->ach_subtitle)) {
              $bottom_bar_class_sub='bottom-bar';
              $bottom_bar_class_title='';
            } else {
              $bottom_bar_class_sub='';
              $bottom_bar_class_title='bottom-bar';
            } 
          ?>  

          <h1 class="<?= $bottom_bar_class_title ?> m-b-3">{{ $achievements_details->ach_title }}</h1>
          <h2 class="<?= $bottom_bar_class_sub ?> m-b-3">{{ $achievements_details->ach_subtitle }}</h2>
          <small class="text-muted m-b-5">Awarded on <span class="posting-date text-danger">{{ date('F d, Y', strtotime($achievements_details->ach_date_awarded)) }}</span></small>

          <div class="m-y-3">
          	<?= $achievements_details->ach_context ?>
          </div>

          <div class="m-y-3 m-t-6">
            @if($achievements_gallery)
              <div class="row my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                @foreach($achievements_gallery as $ach_gal)
                  <?php $image_dimension = $ach_gal->file_width.'x'.$ach_gal->file_height; ?>
                  <figure class="col-sm-12 col-md-4 m-y-3" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" >
                    <a href="{{  asset('uploads/gallery/'.$ach_gal->file_filename) }}" itemprop="contentUrl" data-size="{{ $image_dimension }}" class="pswp-thumb w-100 four-three" style="background-image:url('{{  asset('uploads/gallery/'.$ach_gal->file_filename) }}');">
                      <div class="w-100 h-100" itemprop="thumbnail" data-src="{{  asset('uploads/gallery/'.$ach_gal->file_filename) }}"></div>
                    </a>
                    <figcaption itemprop="caption description" class="hidden">{{ $ach_gal->file_title }}</figcaption>
                  </figure>
                @endforeach
              </div>
            @endif


          </div>

          <a href="{{ route('achievements.data') }}" class="btn btn-sm btn-info m-y-6">Back to Achievements Listing</a>
        </div>
       
      </div>
    </div>

    @include('partials.pwsp')

@endsection

@section('additional-scripts')
  <!-- PHOTOSWIPE -->
  <script src="{{ asset('assets/lib/photoswipe/photoswipe.min.js') }}"></script>
  <script src="{{ asset('assets/lib/photoswipe/photoswipe-ui-default.min.js') }}"></script>

	<script type="text/javascript">
		$('html').addClass('about-us');

    $(function(){

      var initPhotoSwipeFromDOM = function(gallerySelector) {
          // parse slide data (url, title, size ...) from DOM elements 
          // (children of gallerySelector)
          var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;



            for(var i = 0; i < numNodes; i++) {
              figureEl = thumbElements[i]; // <figure> element
              // include only element nodes 
              if(figureEl.nodeType !== 1) {
                continue;
              }

              linkEl = figureEl.children[0]; // <a> element
              size = linkEl.getAttribute('data-size').split('x');

              // create slide object
              item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
              };

              if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML; 
              }


              if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('data-src');
              } 


              item.el = figureEl; // save link to element for getThumbBoundsFn
              items.push(item);

            }

            return items;
          };



          // find nearest parent element

          var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
          };



          // triggers when user clicks on thumbnail

          var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
              return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if(!clickedListItem) {
              return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;


            for (var i = 0; i < numChildNodes; i++) {

              if(childNodes[i].nodeType !== 1) { 
                continue; 
              }



              if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
              }

              nodeIndex++;
            }



            if(index >= 0) {
              // open PhotoSwipe if valid index found
              openPhotoSwipe( index, clickedGallery );
            }

            return false;

          };



          // parse picture index and gallery index from URL (#&pid=1&gid=2)
          var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
            params = {};

            if(hash.length < 5) {
              return params;
            }



            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
              if(!vars[i]) {
                continue;
              }

              var pair = vars[i].split('=');  
              if(pair.length < 2) {
                continue;
              }           

              params[pair[0]] = pair[1];
            }



            if(params.gid) {
              params.gid = parseInt(params.gid, 10);
            }

            return params;
          };



          var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {

            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);



            // define options (if needed)
            options = {
              showHideOpacity:true,
              closeOnScroll:false,
              // define gallery index (for URL)
              galleryUID: galleryElement.getAttribute('data-pswp-uid'),
              getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('div')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect(); 

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};

              }


            };



            // PhotoSwipe opened from URL

            if(fromURL) {
              if(options.galleryPIDs) {
                // parse real index when custom PIDs are used 
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                  if(items[j].pid == index) {
                    options.index = j;
                    break;
                  }

                }

              } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
              }

            } else {
              options.index = parseInt(index, 10);
            }



            // exit if index not found

            if( isNaN(options.index) ) {
              return;
            }



            if(disableAnimation) {
              options.showAnimationDuration = 0;
            }


            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();

          };



          // loop through all gallery elements and bind events
          var galleryElements = document.querySelectorAll( gallerySelector );



          for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].onclick = onThumbnailsClick;
          }


          // Parse URL and open gallery if it contains #&pid=3&gid=1
          var hashData = photoswipeParseHash();
          if(hashData.pid && hashData.gid) {
            openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
          }

        };

        // execute above function
        initPhotoSwipeFromDOM('.my-gallery');
    });
	</script>

@endsection 




