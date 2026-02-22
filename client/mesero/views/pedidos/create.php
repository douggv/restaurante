<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 

$id_mesa_get = $_GET['id_mesa'];

// Consultar datos de la mesa
$sql_mesa = "SELECT * FROM mesas WHERE id_mesa = :id_mesa";
$query_mesa = $pdo->prepare($sql_mesa);
$query_mesa->bindParam(':id_mesa', $id_mesa_get);
$query_mesa->execute();
$datos_mesa = $query_mesa->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="fw-bold"><i class="bi bi-cart-plus"></i> Nueva Comanda: Mesa <?php echo $datos_mesa['nro_mesa']; ?></h2>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white"><b>Seleccionar Productos</b></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Plato / Bebida</label>
                        <select id="select_producto" class="form-select">
                            <option value="">Seleccione...</option>
                            <?php 
                            $sql_m = "SELECT * FROM menu WHERE disponible = '1' ORDER BY nombre_comida ASC";
                            $q_m = $pdo->query($sql_m);
                            while($m = $q_m->fetch()){ 
                                echo "<option value='".$m['id_comida']."' data-nombre='".$m['nombre_comida']."' data-precio='".$m['precio']."'>".$m['nombre_comida']." ($".$m['precio'].")</option>"; 
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Instrucción (Opcional)</label>
                        <input type="text" id="nota_producto" class="form-control" placeholder="Ej: Sin cebolla">
                    </div>
                    <button type="button" onclick="agregarFila()" class="btn btn-primary w-100">
                        <i class="bi bi-plus-lg"></i> Añadir a la lista
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <form action="../../../../app/controllers/controllers_mesera/pedidos/create.php" method="POST">
                <input type="hidden" name="id_mesa_fk" value="<?php echo $id_mesa_get; ?>">
                <input type="hidden" name="id_usuario_fk" value="<?php echo $datos_usuario['id_usuario']; ?>">
                
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="fw-bold">Cliente</label>
                            <select name="id_cliente_fk" class="form-select">
                                <option value="">-- Cliente Ocasional --</option>
                                <?php 
                                $sql_c = "SELECT * FROM clientes ORDER BY email_cliente ASC";
                                $q_c = $pdo->query($sql_c);
                                while($c = $q_c->fetch()){ echo "<option value='".$c['id_cliente']."'>".$c['email_cliente']."</option>"; }
                                ?>
                            </select>
                        </div>

                        <table class="table table-bordered mt-3" id="tabla_pedido">
                            <thead class="bg-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla">
                                </tbody>
                        </table>

                        <div class="text-end">
                            <h3 class="fw-bold text-success">Total: $<span id="total_mostrado">0.00</span></h3>
                            <input type="hidden" name="total_pagar" id="total_input" value="0">
                            <hr>
                            <a href="../mesas/index.php" class="btn btn-secondary rounded-pill">Cancelar</a>
                            <button type="submit" class="btn btn-success rounded-pill px-5 shadow">Confirmar Pedido</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let totalPedido = 0;

function agregarFila() {
    const select = document.getElementById("select_producto");
    const productoId = select.value;
    const productoNombre = select.options[select.selectedIndex].getAttribute("data-nombre");
    const productoPrecio = parseFloat(select.options[select.selectedIndex].getAttribute("data-precio"));
    const nota = document.getElementById("nota_producto").value;

    if (!productoId) { alert("Selecciona un producto"); return; }

    const cuerpo = document.getElementById("cuerpo_tabla");
    const fila = document.createElement("tr");

    fila.innerHTML = `
        <td>
            <input type="hidden" name="id_menu_fk[]" value="${productoId}">
            ${productoNombre}
        </td>
        <td>
            <input type="hidden" name="descripcion_pedido[]" value="${nota}">
            ${nota}
        </td>
        <td>$${productoPrecio.toFixed(2)}</td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this, ${productoPrecio})"><i class="bi bi-trash"></i></button></td>
    `;

    cuerpo.appendChild(fila);

    // Actualizar Total
    totalPedido += productoPrecio;
    document.getElementById("total_mostrado").innerText = totalPedido.toFixed(2);
    document.getElementById("total_input").value = totalPedido;

    // Limpiar campos
    select.value = "";
    document.getElementById("nota_producto").value = "";
}

function eliminarFila(boton, precio) {
    boton.closest("tr").remove();
    totalPedido -= precio;
    document.getElementById("total_mostrado").innerText = totalPedido.toFixed(2);
    document.getElementById("total_input").value = totalPedido;
}
</script>

<?php include '../../layouts/parte2.php'; ?>