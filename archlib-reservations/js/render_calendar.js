

// FullCalender JavaScript Initialization
$(document).ready(function() {

    $('#calendar').fullCalendar({
        aspectRatio: 1.8
    });

    var event1 = {
        title : "Laptop #3 KUPF 212",
        allDay : false,
        start : "Fri, 17 Oct 2014 13:00:00 EST",
        end : "Fri, 17 Oct 2014 14:00:00 EST"
    };

    $("#calendar").fullCalendar( 'renderEvent', event1, true )

});
