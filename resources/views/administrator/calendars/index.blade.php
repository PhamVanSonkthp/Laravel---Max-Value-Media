@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/assets/administrator/NobleUI/assets/vendors/fullcalendar/main.min.css">
    <!-- End plugin css for this page -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('/assets/administrator/NobleUI/assets/vendors/fullcalendar/main.min.css')}}">

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Full calendar</h6>
                            <div id='external-events' class='external-events'>
                                <h6 class="mb-2 text-muted">Draggable Events</h6>
                                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                    <div class='fc-event-main'>Birth Day</div>
                                </div>
                                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                    <div class='fc-event-main'>New Project</div>
                                </div>
                                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                    <div class='fc-event-main'>Anniversary</div>
                                </div>
                                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                                    <div class='fc-event-main'>Clent Meeting</div>
                                </div>
                                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event hii'>
                                    <div class='fc-event-main'>Office Trip</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div id='fullcalendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle1" class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><span
                            class="visually-hidden">close</span></button>
                </div>
                <div id="modalBody1" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Event Page</button>
                </div>
            </div>
        </div>
    </div>

    <div id="createEventModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle2" class="modal-title">Thêm sự kiện</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><span
                            class="visually-hidden">close</span></button>
                </div>
                <div id="modalBody2" class="modal-body">
                    <form>

                        @include('administrator.components.require_input_datetime' , ['name' => 'begin' , 'label' => 'Ngày bắt đầu'])

                        @include('administrator.components.require_input_datetime' , ['name' => 'end' , 'label' => 'Ngày kết thúc'])

                        @include('administrator.components.require_textarea' , ['name' => 'begin' , 'label' => 'Nội dung sự kiện', 'height' => 100])

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onchange="onAddEvent()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')


    <script src="{{asset('/assets/administrator/NobleUI/assets/vendors/fullcalendar/main.min.js')}}"></script>
    <!-- End plugin js for this page -->

    <script>
        $(function () {

            // sample calendar events data

            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('fullcalendar');
            var containerEl = document.getElementById('external-events');

            var curYear = moment().format('YYYY');
            var curMonth = moment().format('MM');

            // Calendar Event Source
            var calendarEvents = {
                id: 1,
                backgroundColor: 'rgba(1,104,250, .15)',
                borderColor: '#0168fa',
                events: [
                    {
                        id: '1',
                        start: curYear + '-' + curMonth + '-08T08:30:00',
                        end: curYear + '-' + curMonth + '-08T13:00:00',
                        title: 'Google Developers Meetup',
                        description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
                    }
                ]
            };



            var otherEvents = {
                id: 6,
                backgroundColor: 'rgba(253,126,20,.25)',
                borderColor: '#fd7e14',
                events: [
                    {
                        id: '16',
                        start: curYear + '-' + curMonth + '-20',
                        end: curYear + '-' + curMonth + '-25',
                        title: 'My Rest Day',
                        description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
                    },
                    {
                        id: '17',
                        start: curYear + '-' + curMonth + '-29',
                        end: curYear + '-' + curMonth + '-31',
                        title: 'My Rest Day',
                        description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
                    }
                ]
            };

            new Draggable(containerEl, {
                itemSelector: '.fc-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText
                    };
                }
            });


            // initialize the calendar
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,today,next",
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar
                fixedWeekCount: true,
                // height: 300,
                initialView: 'dayGridMonth',
                timeZone: 'UTC',
                hiddenDays: [],
                navLinks: 'true',
                // weekNumbers: true,
                // weekNumberFormat: {
                //   week:'numeric',
                // },
                dayMaxEvents: 2,
                events: [],
                eventSources: [calendarEvents, otherEvents],
                drop: function (info) {
                    // remove the element from the "Draggable Events" list
                    // info.draggedEl.parentNode.removeChild(info.draggedEl);
                },
                eventClick: function (info) {
                    var eventObj = info.event;
                    console.log(info);
                    console.log(eventObj.id);
                    $('#modalTitle1').html(eventObj.title);
                    $('#modalBody1').html(eventObj._def.extendedProps.description);
                    $('#eventUrl').attr('href', eventObj.url);
                    $('#fullCalModal').modal("show");

                },
                dateClick: function (info) {
                    $("#createEventModal").modal("show");

                    $('input[name="begin"]').val(getOnlyDate(info.date, "yyyy-mm-dd") + " 00:00")
                    $('input[name="end"]').val(getOnlyDate(info.date, "yyyy-mm-dd") + " 23:59")
                },
            });

            calendar.render();


        });

        function onAddEvent() {

            callAjax(
                "PUT",
                "{{route('ajax.administrator.calendar.store')}}",
                {
                    id: id
                },
                (response) => {
                    $('#row_' + id).after(response.html).remove();
                },
                (error) => {

                },
                false,
            )

        }
    </script>
@endsection

