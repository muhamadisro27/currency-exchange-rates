<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </x-slot>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Currency Exchange Rates</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="currency" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Currency</th>
                            <th>Rates</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rates as $rate)
                            <tr>
                                <td>{{ $rate['currency'] }}</td>
                                <td>{{ $rate['rate'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->
    @push('dashboard')
        <script>
            $('#currency').DataTable({
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
