<?php 
include '../layouts/verificacion.php'; 
include '../layouts/parte1.php'; 
include '../layouts/nav.php'; 
include '../../../alert.php'; 

// --- LÓGICA PARA OBTENER EVENTOS (SE MANTIENE IGUAL) ---
if (isset($_GET['get_eventos'])) {
    $id_mesa_query = $_GET['id_mesa_fk'] ?? 0;
    $sql_eventos = "SELECT titulo_evento, fecha_reserva, bloque_horario FROM reservas WHERE id_mesa_fk = :id_mesa";
    $query_eventos = $pdo->prepare($sql_eventos);
    $query_eventos->execute(['id_mesa' => $id_mesa_query]);
    $resultados = $query_eventos->fetchAll(PDO::FETCH_ASSOC);

    $eventos_calendario = [];
    foreach ($resultados as $row) {
        $horas = explode('-', $row['bloque_horario']);
        $inicio = $horas[0];
        $fin = $horas[1];

        $eventos_calendario[] = [
            'title' => $row['titulo_evento'] ?: 'Ocupado',
            'start' => $row['fecha_reserva'] . 'T' . $inicio,
            'end'   => $row['fecha_reserva'] . 'T' . $fin,
            'color' => '#e74c3c',
            'textColor' => '#ffffff'
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($eventos_calendario);
    exit;
}

$id_mesa_actual = htmlspecialchars($_GET['id']);
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h4 class="mb-0 text-dark">Calendario de Disponibilidad - Mesa #<?php echo $id_mesa_actual; ?></h4>
        </div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReserva" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Nueva Reserva - Mesa #<?php echo $id_mesa_actual; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../../../app/controllers/controllers_cliente/reservar.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente_sesion; ?>">
          <input type="hidden" name="id_mesa" id="id_mesa_input" value="<?php echo $id_mesa_actual; ?>">
          
          <div class="mb-3">
            <label class="form-label fw-bold">Fecha</label>
            <input type="text" id="fecha_visual" class="form-control bg-light" readonly>
            <input type="hidden" name="fecha_reserva" id="fecha_reserva">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Seleccionar Horario</label>
            <select name="bloque_horario" id="select_bloque" class="form-select" required>
              <option value="">-- Seleccione un bloque --</option>
              <option value="12:00:00-14:00:00">12:00 PM - 02:00 PM</option>
              <option value="14:00:00-16:00:00">02:00 PM - 04:00 PM</option>
              <option value="16:00:00-18:00:00">04:00 PM - 06:00 PM</option>
              <option value="18:00:00-20:00:00">06:00 PM - 08:00 PM</option>
              <option value="20:00:00-22:00:00">08:00 PM - 10:00 PM</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label fw-bold">Motivo/Título</label>
            <input type="text" name="titulo_evento" class="form-control" placeholder="Ej: Cumpleaños" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Reservar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var myModal = new bootstrap.Modal(document.getElementById('modalReserva'));
    var selectBloque = document.getElementById('select_bloque');
    var idMesa = "<?php echo $id_mesa_actual; ?>";

    // Obtener fecha actual en formato YYYY-MM-DD para FullCalendar
    var today = new Date().toISOString().split('T')[0];

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      
      events: window.location.href + '&get_eventos=1&id_mesa_fk=' + idMesa,
      
      // Bloquea visualmente los días pasados (opcional pero recomendado)
      validRange: {
        start: today
      },

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth'
      },

      dateClick: function(info) {
        var fechaSeleccionada = info.dateStr;

        // --- NUEVA VALIDACIÓN ---
        // Comparamos la fecha seleccionada con la fecha de hoy
        if (fechaSeleccionada < today) {
            Swal.fire({
                icon: 'error',
                title: 'Fecha no válida',
                text: 'No puedes realizar reservas en fechas pasadas.',
                confirmButtonColor: '#3085d6'
            });
            return; // Detiene la ejecución y no abre el modal
        }

        // --- EL RESTO DEL CÓDIGO SIGUE IGUAL ---
        Array.from(selectBloque.options).forEach(opt => {
            opt.disabled = false;
            opt.text = opt.text.replace(" (Ocupado)", "");
            opt.style.color = "";
        });

        fetch('consultar_horas.php?fecha=' + fechaSeleccionada + '&id_mesa=' + idMesa)
          .then(response => response.json())
          .then(ocupados => {
            Array.from(selectBloque.options).forEach(opt => {
                if (ocupados.includes(opt.value)) {
                    opt.disabled = true;
                    opt.text += " (Ocupado)";
                    opt.style.color = "red";
                }
            });
          })
          .catch(error => console.error('Error:', error))
          .finally(() => {
            document.getElementById('fecha_reserva').value = fechaSeleccionada;
            document.getElementById('fecha_visual').value = fechaSeleccionada;
            myModal.show();
          });
      }
    });
    
    calendar.render();
  });
</script>

<style>
    #calendar { background: #ffffff; padding: 10px; border-radius: 5px; }
    .fc-event { font-size: 0.85em; cursor: help; }
    .fc-day-today { background: #f8f9fa !important; }
    
    /* Estilo para días deshabilitados (pasados) */
    .fc-day-past {
        background-color: #f2f2f2 !important;
        cursor: not-allowed !important;
    }
</style>

<?php include '../layouts/parte2.php'; ?>