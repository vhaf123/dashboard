<div class="d-flex flex-nowrap justify-content-end">
    <a href="{{route('admin.boletas.show', $id)}}" class="btn bg-info btn-sm">
        <i class="fas fa-eye"></i>
    </a>

    <a href="{{route('admin.boletas.edit', $id)}}" class="btn btn-success btn-sm mx-1">
        <i class="fas fa-edit"></i>
    </a>


    <form method="POST" action="{{route('admin.boletas.destroy', $id)}}" style="display: inline;">

        @method('DELETE')
        @csrf

        <button class="btn btn-danger btn-sm">
            <i class="fas fa-eraser"></i>
        </button>
    </form>
</div>