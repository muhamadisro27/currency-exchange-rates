<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
    </x-slot>

    <!-- Main content -->
    <section class="content">
        @if (session()->has('status'))
        <div class="alert alert-{{ session()->get('status') == 200 ?'success' : 'danger' }}" role="alert">
            {{ session()->get('message') }}
          </div>
        @endif
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User</h3>
                <div class="card-tools">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="currency" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="width:10%;">
                                    <div class="flex-row gap-1 d-flex">
                                        <a href="{{ route('user.edit', $user->uuid) }}" class="btn btn-warning mr-2">
                                            <i class="fas fa-edit text-white" title="Edit"></i>
                                        </a>
                                        @if ($user->uuid != auth()->user()->uuid)
                                        <form action="{{ route('user.destroy', $user->uuid) }}" method="POST" id="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash" title="Delete"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>

                                </td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ count($user->getRoleNames()) > 0 ? $user->getRoleNames()[0] : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
    @push('user')
        <script>
            $('#user').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        </script>
    @endpush
</x-app-layout>
