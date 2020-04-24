<div class="d-flex flex-nowrap justify-content-end">
    
    <a href="{{route('admin.asesorias.edit', $asesoria)}}" class="btn btn-success btn-sm mr-1" role="button">
        <i class="fas fa-edit"></i>
    </a>

    @php
        $ruta = route('admin.asesorias.destroy', $asesoria);
    @endphp

    <button class="btn btn-danger btn-sm" onclick="AlertaEliminar('{{$ruta}}')">
        <i class="fas fa-eraser"></i>
    </button>
    
</div>