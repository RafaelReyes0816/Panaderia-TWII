@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Registrar Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Cliente:</label>
            <select name="cliente_id" class="form-control">
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('cliente_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha:</label>
            <input type="date" name="fecha" value="{{ old('fecha') }}" class="form-control">
            @error('fecha') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Producto:</label>
            <select id="producto-select" class="form-control">
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Cantidad:</label>
            <input type="number" id="cantidad-input" class="form-control" min="1" value="1">
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-producto">Agregar producto</button>
        <div id="alerta-producto" class="alert alert-success d-none" role="alert">
            ¡Producto agregado!
        </div>
        <div class="mb-3">
            <label class="form-label">Productos agregados:</label>
            <table class="table" id="resumen-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            <label class="form-label">Total:</label>
            <input type="number" step="0.01" name="total" id="total" value="0" class="form-control" readonly>
        </div>
        <div id="inputs-hidden"></div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection

@section('scripts')
<script>
const productosData = {
    @foreach($productos as $producto)
        {{ $producto->id }}: {
            nombre: "{{ $producto->nombre }}",
            precio: {{ $producto->precio }}
        },
    @endforeach
};

let productosVenta = [];

function renderResumen() {
    const tbody = document.querySelector('#resumen-table tbody');
    tbody.innerHTML = '';
    let total = 0;
    productosVenta.forEach((item, idx) => {
        const subtotal = item.precio * item.cantidad;
        total += subtotal;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.nombre}<input type="hidden" name="productos[]" value="${item.id}"></td>
            <td>${item.cantidad}<input type="hidden" name="cantidades[]" value="${item.cantidad}"></td>
            <td>${item.precio.toFixed(2)}</td>
            <td>${subtotal.toFixed(2)}</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row" data-idx="${idx}">Eliminar</button></td>
        `;
        tbody.appendChild(row);
    });
    document.getElementById('total').value = total.toFixed(2);
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-producto').addEventListener('click', function() {
        const productoId = document.getElementById('producto-select').value;
        const cantidad = parseInt(document.getElementById('cantidad-input').value) || 1;
        if (!productoId || !productosData[productoId]) return;
        const existente = productosVenta.find(p => p.id == productoId);
        if (existente) {
            let alerta = document.getElementById('alerta-producto');
            alerta.textContent = '¡Este producto ya fue agregado!';
            alerta.classList.remove('d-none');
            alerta.classList.remove('alert-success');
            alerta.classList.add('alert-danger');
            alerta.classList.add('show');
            setTimeout(() => {
                alerta.classList.remove('show');
                alerta.classList.add('d-none');
                alerta.classList.remove('alert-danger');
                alerta.classList.add('alert-success');
                alerta.textContent = '¡Producto agregado!';
            }, 1500);
            return;
        }
        productosVenta.push({
            id: productoId,
            nombre: productosData[productoId].nombre,
            precio: productosData[productoId].precio,
            cantidad: cantidad
        });
        renderResumen();
        let alerta = document.getElementById('alerta-producto');
        alerta.textContent = '¡Producto agregado!';
        alerta.classList.remove('d-none');
        alerta.classList.remove('alert-danger');
        alerta.classList.add('alert-success');
        alerta.classList.add('show');
        setTimeout(() => {
            alerta.classList.remove('show');
            alerta.classList.add('d-none');
        }, 1000);
    });
    document.getElementById('resumen-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            const idx = e.target.getAttribute('data-idx');
            productosVenta.splice(idx, 1);
            renderResumen();
        }
    });
    document.querySelector('form').addEventListener('submit', function(e) {
        if (productosVenta.length === 0) {
            alert('Debe agregar al menos un producto a la venta.');
            e.preventDefault();
        }
    });
});
</script>
@endsection 