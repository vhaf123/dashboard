<div class="d-flex flex-nowrap justify-content-end">
    
    <a href="{{route('admin.boletas.show', $id)}}" class="btn btn-info btn-sm" role="button">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{route('admin.boletas.edit', $id)}}" class="btn btn-success btn-sm mx-1 @if($estado != 'GENERADO') disabled @endif" role="button" @if($estado != 'GENERADO') aria-disabled="true" @endif>
        <i class="fas fa-edit"></i>
    </a>

    @php
        $ruta = route('admin.boletas.destroy', $id);
    @endphp

    <button class="btn btn-danger btn-sm" onclick="AlertaAnular('{{$ruta}}')" @if($estado == 'ANULADO') disabled @endif>
        <i class="fas fa-eraser"></i>
    </button>
    
</div>