@extends('layouts.app')

@section('content')
<div class="container p-4">
    <h2 class="mb-4">Detalles</h2>
    <div class="mb-4 d-flex gap-2">
        <a href="?tipo=venta" class="btn btn-primary {{ request('tipo', 'venta') == 'venta' ? 'active' : '' }}">Ver detalles de ventas</a>
        <a href="?tipo=compra" class="btn btn-primary {{ request('tipo') == 'compra' ? 'active' : '' }}">Ver detalles de compras</a>
    </div>

    @if(request('tipo', 'venta') == 'venta')
        <h3 class="mb-3">Detalles de Ventas</h3>
        <div class="table-responsive p-2">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Venta ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($detallesVenta as $detalle)
                    <tr>
                        <td>{{ $detalle->id }}</td>
                        <td>{{ $detalle->venta_id }}</td>
                        <td>
                            @if($detalle->producto)
                                <strong>{{ $detalle->producto->nombre }}</strong>
                                <br>
                                <small class="text-muted">ID: {{ $detalle->producto_id }}</small>
                            @else
                                <span class="text-danger">Producto no encontrado (ID: {{ $detalle->producto_id }})</span>
                            @endif
                        </td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>Bs {{ number_format($detalle->subtotal, 2) }}</td>
                        <td>{{ $detalle->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $detalle->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            @if ($detallesVenta->hasPages())
                <ul class="pagination">
                    
                    @if ($detallesVenta->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                            <span class="page-link" aria-hidden="true">‹</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $detallesVenta->previousPageUrl() }}&tipo=venta" rel="prev" aria-label="« Previous">‹</a>
                        </li>
                    @endif

                   
                    @foreach ($detallesVenta->getUrlRange(1, $detallesVenta->lastPage()) as $page => $url)
                        @if ($page == $detallesVenta->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}&tipo=venta">{{ $page }}</a></li>
                        @endif
                    @endforeach

                  
                    @if ($detallesVenta->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $detallesVenta->nextPageUrl() }}&tipo=venta" rel="next" aria-label="Next »">›</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                            <span class="page-link" aria-hidden="true">›</span>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    @elseif(request('tipo') == 'compra')
        <h3 class="mb-3">Detalles de Compras</h3>
        <div class="table-responsive p-2">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Compra ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($detallesCompra as $detalle)
                    <tr>
                        <td>{{ $detalle->id }}</td>
                        <td>{{ $detalle->compra_id }}</td>
                        <td>
                            @if($detalle->producto)
                                <strong>{{ $detalle->producto->nombre }}</strong>
                                <br>
                                <small class="text-muted">ID: {{ $detalle->producto_id }}</small>
                            @else
                                <span class="text-danger">Producto no encontrado (ID: {{ $detalle->producto_id }})</span>
                            @endif
                        </td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>Bs {{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td>Bs {{ number_format($detalle->subtotal, 2) }}</td>
                        <td>{{ $detalle->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $detalle->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            @if ($detallesCompra->hasPages())
                <ul class="pagination">
                    
                    @if ($detallesCompra->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                            <span class="page-link" aria-hidden="true">‹</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $detallesCompra->previousPageUrl() }}&tipo=compra" rel="prev" aria-label="« Previous">‹</a>
                        </li>
                    @endif

                   
                    @foreach ($detallesCompra->getUrlRange(1, $detallesCompra->lastPage()) as $page => $url)
                        @if ($page == $detallesCompra->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}&tipo=compra">{{ $page }}</a></li>
                        @endif
                    @endforeach

                   
                    @if ($detallesCompra->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $detallesCompra->nextPageUrl() }}&tipo=compra" rel="next" aria-label="Next »">›</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                            <span class="page-link" aria-hidden="true">›</span>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    @endif
</div>
@endsection 