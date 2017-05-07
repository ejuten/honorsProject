function initiateFullCalendar(eventData) {
    $(document).ready(function() {
        function addImage(event, element, date) {
            if (event.imageurl) {
                element.append("<img src='images/icons/" + event.imageurl + ".png' class='event-icon' />");
            } 
        };

        //Drag and create an event
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2017-05-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectHelper: true, 
            events: eventData,
            dayClick: function(date, jsEvent, view) {
                $("#myModal").modal("show");
            },
            eventRender: function(event, element) {
                addImage(event, element);
            },
            
        });
        
    });
}
