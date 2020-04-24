<div class="d-flex flex-nowrap justify-content-end">

    <button class="btn btn-sm btn-primary" onclick="asignarAsesoria({{$id}})">
        Asignar
    </button>

    @php
        $ruta = route('admin.paquetes.destroy', $id);
    @endphp

    <button class="btn btn-sm btn-danger ml-1" onclick="AlertaAnular('{{$ruta}}')">
        Eliminar
    </button>
</div>