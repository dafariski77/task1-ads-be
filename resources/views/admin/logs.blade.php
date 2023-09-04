@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reports Logs</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Log Name</th>
                                        <th>Description</th>
                                        <th>Subject Type</th>
                                        <th>Event</th>
                                        <th>Subject ID</th>
                                        <th>Causer Type</th>
                                        <th>Causer ID</th>
                                        <th>Properties</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%'
                    },
                    {
                        data: 'log_name',
                        name: 'log_name',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'subject_type',
                        name: 'subject_type',
                    },
                    {
                        data: 'event',
                        name: 'event',
                    },
                    {
                        data: 'subject_id',
                        name: 'subject_id',
                    },
                    {
                        data: 'causer_type',
                        name: 'causer_type',
                    },
                    {
                        data: 'causer_id',
                        name: 'causer_id',
                    },
                    {
                        data: 'properties',
                        name: 'properties',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                ]
            });
        });
    </script>
@endpush
