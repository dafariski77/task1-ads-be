@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reports List</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="reportTable" class="table table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Reporter</th>
                                        <th>Category</th>
                                        <th>Ticket ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Media</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <div class="modal fade" id="editModal" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ticketId"></h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm" method="POST"
                                                action="{{ $route }}">
                                                @method($method)
                                                @csrf
                                                <input type="hidden" id="reportId"
                                                    name="reportId">

                                                <div class="mb-3">
                                                    <label for="status"
                                                        class="form-label">Status</label>
                                                    <select class="form-select"
                                                        aria-label="Default select example"
                                                        name="status" id="status">
                                                        <option value="Pending" selected>
                                                            Pending
                                                        </option>
                                                        <option value="Proses Administratrif">
                                                            Proses Administratrif</option>
                                                        <option value="Proses Penanganan">
                                                            Proses
                                                            Penanganan</option>
                                                        <option value="Selesai Ditangani">
                                                            Selesai
                                                            Ditangani</option>
                                                        <option value="Laporan Ditolak">
                                                            Laporan
                                                            Ditolak</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="category_id"
                                                        class="form-label">Category</label>
                                                    <select class="form-select"
                                                        aria-label="Default select example"
                                                        name="category_id" id="category_id">
                                                        @foreach ($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="note"
                                                        class="form-label">Note</label>
                                                    <textarea name="note" id="note" class="form-control">{{ old('note') }}</textarea>
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            $('#reportTable').DataTable({
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
                        data: 'reporter_id',
                        name: 'reporter_id',
                    },
                    {
                        data: 'category_id',
                        name: 'category_id',
                    },
                    {
                        data: 'ticket_id',
                        name: 'ticket_id',
                    },
                    {
                        data: 'title',
                        name: 'title',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'media', // Use a placeholder name for the media column
                        name: 'media',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            var mediaHtml = '';

                            // Check if media items exist
                            if (data && data.length > 0) {
                                // Loop through the media and create HTML for each media item
                                data.forEach(function(mediaItem) {
                                    mediaHtml += '<a href="' + mediaItem.url + '" target="_blank">' + mediaItem.name + '</a><br>';
                                });
                            }

                            return mediaHtml;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });

            $('#reportTable').on('click', '.edit-button', function() {
                var reportId = $(this).data('id');

                $.ajax({
                    url: '/api/reports/' + reportId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#reportId').val(data[0].id);
                        $('#ticketId').text(data[0].ticket_id);
                    }
                })

                $('#editModal').modal('show')
            })

        });
    </script>
@endpush
