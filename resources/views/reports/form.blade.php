@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="post" action="{{ $route }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email"
                                    class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone
                                    Number</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="identity_type" class="form-label">Identity
                                    Type</label>
                                <select class="form-select"
                                    aria-label="Default select example" name="identity_type"
                                    id="identity_type">
                                    <option value="KTP" selected>KTP</option>
                                    <option value="SIM">SIM</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="identity_number" class="form-label">Identity
                                    Number</label>
                                <input type="number" name="identity_number"
                                    id="identity_number" class="form-control"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="pob" class="form-label">Place Of
                                    Birth</label>
                                <input type="text" name="pob" id="pob"
                                    class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date Of Birth</label>
                                <input type="date" name="dob" id="dob"
                                    class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title Report</label>
                                <input type="text" name="title" id="title"
                                    class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Report
                                    Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="document" class="form-label">Upload Report</label>
                                <input type="file" name="document[]" id="document"
                                    class="form-control" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
