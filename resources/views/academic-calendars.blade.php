@extends('layouts.main')
@section('additional-css')
  <!-- FULL CALENDAR -->
  <link href="{{ asset('assets/lib/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">
@endsection
@section('title', 'Falcon School | Academic Calendar')
@section('body-contents')
	<div class="no-header container m-b-6">
    <div id="calendar" class="m-t-3"></div>
  </div>

  <div class="js-modal_holder"></div>

@endsection

@section('additional-scripts')
  <!-- FULL CALENDAR SCRIPT -->
  <script src="{{ asset('assets/lib/fullcalendar/fullcalendar.min.js')}}" defer></script>
  <script type="text/javascript">
    $('html').addClass('about-us');

    /*$(document).ready(function() {
        $('#calendar').fullCalendar({
          themeSystem:'bootstrap3'
        });
    });*/

    $(function () {
      /* initialize the external events
       -----------------------------------------------------------------*/
      function init_events(ele) {
        ele.each(function () {

          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
            })

        })
      }


      init_events($('#external-events div.external-event'))

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()


          var formData = {_token : '{{ csrf_token() }}'};

          $.ajax({
              type:'post',
              url:"{{ route('fetch_event_fullcalendar') }}",
              dataType:'json',
              data : formData,
              success: function (data){

                  console.log(data);

                  $('#calendar').fullCalendar({
                      header    : {
                          left  : 'prev,next today',
                          center: 'title',
                          right : 'month,agendaWeek,agendaDay'
                      },
                      buttonText: {
                          today: 'today',
                          month: 'month',
                          week : 'week',
                          day  : 'day'
                      },


                      events: data,


                      eventClick: function(calEvent, jsEvent, view) {
                          show_form_modal({
                              method : 'GET',
                              modal : '#events_view_modal',
                              route : "{{ route('fetch_event_fullcalendar_details') }}",
                              id : calEvent.id
                          });   
                      }
                  });

              }
          });

    // SHOW MODAL FORM FUNCTION
    function show_form_modal (data){
      var formData = {_token : '{{ csrf_token() }}'};
      if (data.id) {
          var formData = {_token : '{{ csrf_token() }}', id : data.id};
      }

      $.ajax({
          url : data.route,
          type : data.method,
          data : formData,
          success : function (retData) {
              $('.js-modal_holder').html(retData);
              $(data.modal).modal({ backdrop : 'static' });
          }
      });
    } // END OF FUNCTION

    }) // END OF FUNCTION  

  </script>

@endsection 




