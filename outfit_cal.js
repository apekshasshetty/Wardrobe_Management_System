$(document).ready(function () {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'month',

        events: {
            url: 'fetch_outfit_events.php', // Change this to the correct path
            type: 'POST',
            error: function () {
                alert('There was an error while fetching events!');
            }
        },
        eventRender: function (event, element) {
            // Customize the event rendering, add images
            if (event.image) {
                // Create an image element
                var image = $('<img src="' + event.image + '" class="event-image" />');
                // Append the image to the event title
                element.find('.fc-title').append('<br/>').append(image);
            }

            // Bind a click event to the event element
            element.click(function () {
                // Display a popup or perform any other action on click
                alert('Clicked on outfit for ' + event.start.format() + '\nImage Path: ' + event.image);
            });
        },
    });
});