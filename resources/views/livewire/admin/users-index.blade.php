<div>
    
<div class="card">

    {{-- <div class="card-header">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.create') }}">Crear nueva publicación</a>
    </div> --}}

    <div class="card-header">
        <input wire:model="search" type="text" class="form-control" placeholder="Buscador de usuario">
    </div>

    @if($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th colspan="2">Operaciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td width="8%">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.users.edit', $user) }}">Editar rol</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    
    @else
        <div class="card-body">
            <strong>No hay ningún registro coincidente</strong>
        </div>
    @endif
</div>
    

</div>
