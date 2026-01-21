<?php include '../layouts/verificacion.php'; ?>   
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>


    <div id='calendar'></div>