@extends('backend.layout.main')
@section('title', 'Category')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Bulk Upload</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('category') }}">Category</a></li>
                        <li class="breadcrumb-item active">Bulk Upload</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('backend.alert.simple-alert')
    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Grid</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('category-bulk-upload') }}" method="POST" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label class="form-label mb-0">Bulk Upload</label>
                                            <a href="{{ route('category-sheet') }}" class="small">Download Spread sheet</a>
                                        </div>
                                        <input type="file" class="form-control" name="categories">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>

                <div class="d-flex ms-2">
                    <div class="flex-shrink-0 me-1">
                        <i data-feather="check-circle" class="text-success icon-dual-success icon-xs"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5>Important Instructions for Bulk Upload</h5>
                        <p class="text-muted">We use the information we collect in various ways, including to:</p>
                        <ul class="text-muted vstack gap-2">
                            <li>
                                User can download that template excel and upload the same.
                            </li>
                            <li>
                                Excel should have columns name.
                            </li>
                            <li>
                                Upload Limit 500 data rows at a time.
                            </li>
                            <li>
                                Category Name,Slug,Status (if category show in sidebar of menu) should
                                be Mandatory columns in the excel sheet.
                            </li>
                            <li>
                                Status should be written as active,inactive or suspended.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    @if (session()->has('failures'))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h5 class="card-title mb-0 flex-grow-1 text-danger">Rejected Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @php
                                $groupedFailures = collect(session('failures'))->groupBy(function ($failure) {
                                    return $failure->row();
                                });
                            @endphp
                            <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Category</th>
                                        <th>Slug</th>
                                        <th>Error</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($groupedFailures as $row => $failures)
                                        @php
                                            $values = $failures->first()->values();
                                        @endphp
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $values['categories'] ?? '-' }}</td>
                                            <td>{{ $values['slug'] ?? '-' }}</td>
                                            <td class="text-danger">
                                                The category or slug has already been taken.
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
