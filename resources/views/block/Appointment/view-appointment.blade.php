@extends('master')
@section('title', 'View Appointment')
@section('page-title', 'View Appointment')
@section('page-subtitle') <a href=" {{url('/home')}}">Dashboard</a>@endsection
@section('subtitle', 'View Appointment')
@section('content')
    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3" hidden>
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Draggable Events</h4>
                            </div>
                            <div class="card-body" hidden>
                                <!-- the events -->
                                <div id="external-events">

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Event</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <div class="input-group">
                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                    <div class="input-group-append">
                                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                    <!-- /btn-group -->
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.content-wrapper -->

        <script>
            $(function () {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
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
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        })

                    })
                }

                ini_events($('#external-events div.external-event'))

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date()
                var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear()

                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendarInteraction.Draggable;

                var containerEl = document.getElementById('external-events');
                var checkbox = document.getElementById('drop-remove');
                var calendarEl = document.getElementById('calendar');

                // initialize the external events
                // -----------------------------------------------------------------

                new Draggable(containerEl, {
                    itemSelector: '.external-event',
                    eventData: function (eventEl) {
                        console.log(eventEl);
                        return {
                            title: eventEl.innerText,
                            backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                            borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                            textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                        };
                    }
                });

                var calendar = new Calendar(calendarEl, {
                    plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    //Random default events
                    events: [
                            @foreach($appointments as $appointment)
                        {
                            id:  '{{$appointment->appointment_id}}',
                            title: '{{$appointment->appointment_title}}',
                            start: new Date( {{$appointment->date.','.$appointment->time}}),
                            backgroundColor: '{{$appointment->color}}',
                            borderColor: '{{$appointment->color}}',
                            constraint:'{{'Doctor Name: '.$appointment->staffs -> staff_name_kh.'  |  Patient Name: '.$appointment->patients->patient_name}}',
                            <?php $id =1 ?>
                        },
                        @endforeach
                    ],
                    editable: false,
                    eventClick: function (info) {
                        info.jsEvent.preventDefault();
                        if (info.event.url) {
                            window.open(info.event.url)
                        } else {
                            Swal.fire({
                                html: '<strong >'+info.event.constraint+'</strong>'+
                                    '<div class="row"  style="margin-top: 20px" >'+
                                    '<div class = "col-sm-6">' +
                                    '<form method="get" action="{{url('EditAppointment')}}"> <input type="hidden" value="' + info.event.id + '" name="appointment_id" id="appointment_id"> <div class="text-center"> <button type="text" class="btn btn-success">Go to Appointment</button> </div> </form>'+
                                    '</div> <div class = "col-sm-6">'+
                                    '<form method="get" action="{{url('EditAppointment')}}"> <input type="hidden" value="' + info.event.id + '" name="appointment_id" id="appointment_id"> <div class="text-center"> <button type="text" class="btn btn-primary">Edit Appointment</button> </div> </form>'+
                                    '</div>'+
                                '</div>',
                                title: info.event.title,
                                icon: 'info',
                                showCloseButton: false,
                                showCancelButton: false,
                                focusConfirm: false,
                                reverseButtons: true,
                                focusCancel: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#FFC107',
                                showConfirmButton: false
                            });
                        }
                    }
                });

                calendar.render();
                // $('#calendar').fullCalendar()

                /* ADDING EVENTS */
                var currColor = '#3c8dbc' //Red by default
                //Color chooser button
                var colorChooser = $('#color-chooser-btn')
                $('#color-chooser > li > a').click(function (e) {
                    e.preventDefault()
                    //Save color
                    currColor = $(this).css('color')
                    //Add color effect to button
                    $('#add-new-event').css({
                        'background-color': currColor,
                        'border-color': currColor
                    })
                })
                $('#add-new-event').click(function (e) {
                    e.preventDefault()
                    //Get value and make sure it is not null
                    var val = $('#new-event').val()
                    if (val.length == 0) {
                        return
                    }

                    //Create events
                    var event = $('<div />')
                    event.css({
                        'background-color': currColor,
                        'border-color': currColor,
                        'color': '#fff'
                    }).addClass('external-event')
                    event.html(val)
                    $('#external-events').prepend(event)

                    //Add draggable funtionality
                    ini_events(event)

                    //Remove event from text input
                    $('#new-event').val('')
                })
            })
        </script>
@endsection
