<link href='{{asset("css/main.min.css")}}' rel='stylesheet'/>
<script src='{{asset("js/main.min.js")}}'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {!!$event_data!!},
            eventClick: function (info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.open(info.event.url);
                }
            }
        });

        calendar.render();
    });
</script>
