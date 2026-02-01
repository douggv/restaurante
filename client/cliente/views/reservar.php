<?php include '../layouts/verificacion.php'; ?>   
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>


<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    if(isset($_SESSION['mensaje'])):
        $mensaje = $_SESSION['mensaje'];
        $color = $_SESSION['color'];
?>
    <div id="alerta-flotante" 
         class="<?= $color ?> alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg" 
         style="z-index: 9999; min-width: 320px; text-align: center; margin-top: 160px;" 
         role="alert">
        
        <i class="bi bi-info-circle me-2"></i> <strong><?= $mensaje ?></strong>
        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        // Esperar 3 segundos y cerrar la alerta usando Bootstrap
        setTimeout(function() {
            const alerta = document.getElementById('alerta-flotante');
            if (alerta) {
                // Esto aplica la animación de desvanecimiento de Bootstrap
                alerta.classList.remove('show');
                // Eliminar el elemento del DOM después de la animación (0.5s después)
                setTimeout(() => alerta.remove(), 500);
            }
        }, 3000);
    </script>

<?php 
    // LIMPIEZA INMEDIATA: Una vez que PHP genera el HTML, borramos la sesión
    unset($_SESSION['mensaje']);
    unset($_SESSION['color']);
    endif; 
?>



<div class="container mt-4">
    <div id='calendar'></div>
</div>

<div class="modal fade" id="modalReserva" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Reservar Mesa #<?php echo $_GET['id']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../../../app/controllers/controllers_cliente/reservar.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente_sesion; // Asegúrate que la variable sea la correcta ?>">
          <input type="hidden" name="id_mesa" value="<?php echo htmlspecialchars($_GET['id']); ?>">
          <input readonly type="text" class="form-control mb-3" value="Cliente <?php echo $nombre_cliente_sesion; ?>">
          <div class="mb-3">
            <label class="form-label">Fecha Seleccionada</label>
            <input type="text" id="fecha_visual" class="form-control" readonly>
            <input type="hidden" name="fecha_reserva" id="fecha_reserva">
          </div>

          <div class="mb-3">
            <label class="form-label">Bloque de 2 horas (Obligatorio):</label>
            <select name="bloque_horario" class="form-select" required>
              <option value="">-- Seleccione un horario --</option>
              <option value="12:00:00-14:00:00">12:00 PM - 02:00 PM</option>
              <option value="14:00:00-16:00:00">02:00 PM - 04:00 PM</option>
              <option value="16:00:00-18:00:00">04:00 PM - 06:00 PM</option>
              <option value="18:00:00-20:00:00">06:00 PM - 08:00 PM</option>
              <option value="20:00:00-22:00:00">08:00 PM - 10:00 PM</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Título del Evento</label>
            <input type="text" name="titulo_evento" class="form-control" placeholder="Ej: Cena de aniversario">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Reservar ahora</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    // Inicializar el Modal correctamente con Bootstrap 5
    var myModalElement = document.getElementById('modalReserva');
    var myModal = new bootstrap.Modal(myModalElement);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      // IMPORTANTE: dateClick requiere el script global de FullCalendar 6
      dateClick: function(info) {
        // Llenamos los inputs
        document.getElementById('fecha_reserva').value = info.dateStr;
        document.getElementById('fecha_visual').value = info.dateStr;

        // Mostramos el modal
        myModal.show();
      },
      // Esto sirve para que se vea la manito al pasar sobre un día
      navLinks: true, 
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      }
    });
    
    calendar.render();
  });
</script>

<?php include '../layouts/parte2.php'; ?>