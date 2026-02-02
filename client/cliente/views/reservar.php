<?php include '../layouts/verificacion.php'; ?>   
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>
<?php include '../../../alert.php'; ?>

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
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente_sesion; ?>">
          <input type="hidden" name="id_mesa" id="id_mesa_input" value="<?php echo htmlspecialchars($_GET['id']); ?>">
          <input readonly type="text" class="form-control mb-3" value="Cliente <?php echo $nombre_cliente_sesion; ?>">
          
          <div class="mb-3">
            <label class="form-label fw-bold">Fecha Seleccionada</label>
            <input type="text" id="fecha_visual" class="form-control bg-light" readonly>
            <input type="hidden" name="fecha_reserva" id="fecha_reserva">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Bloque de 2 horas (Obligatorio):</label>
            <select name="bloque_horario" id="select_bloque" class="form-select" required>
              <option value="">-- Seleccione un horario --</option>
              <option value="12:00:00-14:00:00">12:00 PM - 02:00 PM</option>
              <option value="14:00:00-16:00:00">02:00 PM - 04:00 PM</option>
              <option value="16:00:00-18:00:00">04:00 PM - 06:00 PM</option>
              <option value="18:00:00-20:00:00">06:00 PM - 08:00 PM</option>
              <option value="20:00:00-22:00:00">08:00 PM - 10:00 PM</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label fw-bold">Título del Evento</label>
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
    var myModalElement = document.getElementById('modalReserva');
    var myModal = new bootstrap.Modal(myModalElement);
    var selectBloque = document.getElementById('select_bloque');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      dateClick: function(info) {
        var fecha = info.dateStr;
        var idMesa = document.getElementById('id_mesa_input').value;

        // 1. Resetear el select antes de la consulta
        Array.from(selectBloque.options).forEach(opt => {
            opt.disabled = false;
            opt.text = opt.text.replace(" (Ocupado)", "");
            opt.style.backgroundColor = "";
        });

        // 2. Intentar consultar horas ocupadas
        // IMPORTANTE: Asegúrate que consultar_horas.php esté en la misma carpeta que este archivo
        fetch('consultar_horas.php?fecha=' + fecha + '&id_mesa=' + idMesa)
          .then(response => {
            if (!response.ok) throw new Error('Error en servidor');
            return response.json();
          })
          .then(ocupados => {
            // 3. Bloquear las horas que devuelve el PHP
            Array.from(selectBloque.options).forEach(opt => {
                if (ocupados.includes(opt.value)) {
                    opt.disabled = true;
                    opt.text += " (Ocupado)";
                    opt.style.backgroundColor = "#e9ecef";
                }
            });
          })
          .catch(error => console.error('Error al consultar horas:', error))
          .finally(() => {
            // 4. ESTO ABRE EL MODAL pase lo que pase
            document.getElementById('fecha_reserva').value = fecha;
            document.getElementById('fecha_visual').value = fecha;
            myModal.show();
          });
      },
      navLinks: true, 
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth'
      }
    });
    
    calendar.render();
  });
</script>

<?php include '../layouts/parte2.php'; ?>