<div class="d-flex flex-nowrap justify-content-end">
    
    <a href="#" class="btn btn-primary btn-sm mr-2" role="button">
        Editar
    </a>

    @php
        $ruta = route('admin.coordinadores.destroy', $id);
    @endphp

    <button class="btn btn-danger btn-sm" onclick="AlertaAnular('{{$ruta}}')">
        Eliminar
    </button>
    
</div>