<div class="d-flex flex-nowrap justify-content-end">
    
    <a href="{{route('admin.boletas.show', $id)}}" class="btn btn-info btn-sm" role="button">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{route('admin.boletas.edit', $id)}}" class="btn btn-success btn-sm mx-1 @if($estado2 != 'GENERADO') disabled @endif" role="button" @if($estado2 != 'GENERADO') aria-disabled="true" @endif>
        <i class="fas fa-edit"></i>
    </a>

    @php
        $ruta = route('admin.boletas.destroy', $id);
    @endphp

    <button class="btn btn-danger btn-sm" onclick="AlertaAnular('{{$ruta}}')" @if($estado2 == 'ANULADO') disabled @endif>
        <i class="fas fa-eraser"></i>
    </button>

    {{-- <form method="POST" action="{{route('admin.boletas.destroy', $id)}}" style="display: inline;">

        @method('DELETE')
        @csrf

        <button class="btn btn-danger btn-sm" @if($estado2 == 'ANULADO') disabled @endif>
            <i class="fas fa-eraser"></i>
        </button>
    </form> --}}
</div>