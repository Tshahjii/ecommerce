@extends('backend.layout.main')
@section('title', 'Discount')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Discount</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Discount</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('backend.alert.simple-alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <!-- Left Side -->
                    <h5 class="card-title mb-0">Discount</h5>

                    <!-- Right Side -->
                    <div class="d-flex gap-2">
                        <button class="btn btn-info btn-label right create-discount-btn" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-center">
                            <i class="ri-edit-2-fill label-icon align-middle fs-16 ms-2"></i>
                            Create
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Discount Amount</th>
                                    <th>Max Uses</th>
                                    <th>Max Uses Users</th>
                                    <th>Status</th>
                                    <th>Starts At</th>
                                    <th>Expired At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($discount as $values)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $values->code }}</td>
                                        <td>{{ $values->name }}</td>
                                        <td>{{ $values->description }}</td>
                                        <td>
                                            @if ($values->type == 'percent')
                                                <span class="badge bg-secondary-subtle text-secondary badge-border">
                                                    Percent</span>
                                            @else
                                                <span class="badge bg-success-subtle text-success badge-border">
                                                    Fixed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($values->type == 'percent')
                                                {{ $values->discount_amount }} %
                                            @else
                                                ₹ {{ number_formate($values->discount_amount, 2) }}
                                            @endif
                                        </td>
                                        <td><i class="ri-user-smile-line"></i> {{ $values->max_uses }}</td>
                                        <td><i class="ri-user-smile-line"></i> {{ $values->max_uses_user ?? 0 }}</td>
                                        <td>
                                            @if ($values->status == 'active')
                                                <span class="badge bg-primary-subtle text-primary"><i
                                                        class="ri-checkbox-circle-line align-middle text-success"></i>Active</span>
                                            @elseif ($values->status == 'inactive')
                                                <span class="badge bg-warning-subtle text-warning"><i
                                                        class="ri-eye-off-line align-middle text-warning"></i>In-active</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger"><i
                                                        class="ri-close-circle-line align-middle text-danger"></i>Suspended</span>
                                            @endif
                                        </td>
                                        <td>{{ $values->starts_at }}</td>
                                        <td>{{ $values->expired_at }}</td>
                                        <td>
                                            <div class="hstack gap-3 flex-wrap">
                                                <a href="javascript:void(0);" class="link-success fs-15 update-discount"
                                                    data-id="{{ $values->id }}" data-bs-toggle="modal"
                                                    data-bs-target=".bs-example-modal-center"><i
                                                        class="ri-edit-2-line"></i></a>
                                                <a href="{{ route('delete-discount', ['id' => $values->id]) }}"
                                                    class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                            </div>
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

    {{-- create modal --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discountModal">
                        Create Discount
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create-discount') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="did" name="did" />
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="customer-name" class="col-form-label">Code:</label>
                                        <button type="button" class="btn btn-sm btn-primary small"
                                            onclick="generateCouponCode()">Coupons Code</button>
                                    </div>
                                    <input type="text" class="form-control" id="code" name="code" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Type:</label>
                                    <select name="type" class="form-select status" id="type" data-choices
                                        data-choices-sorting="true">
                                        <option disabled selected>Choose...</option>
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Status:</label>
                                    <select name="status" class="form-select" id="status_dis" data-choices
                                        data-choices-sorting="true">
                                        <option disabled selected>Choose...</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">In-Active</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Discount Amount:</label>
                                    <input type="text" class="form-control" id="discount_amount"
                                        name="discount_amount" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Max Uses:</label>
                                    <input type="text" class="form-control" id="max_uses" name="max_uses"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="customer-name" class="col-form-label">Starts At:</label>
                                <input type="datetime-local" class="form-control" id="starts_at" name="starts_at"
                                    value="{{ old('starts_at', now()->format('Y-m-d\TH:i')) }}"
                                    min="{{ now()->format('Y-m-d\TH:i') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="customer-name" class="col-form-label">Expired At:</label>
                                <input type="datetime-local" class="form-control" id="expired_at" name="expired_at"
                                    value="{{ old('expired_at', now()->format('Y-m-d\TH:i')) }}"
                                    min="{{ now()->format('Y-m-d\TH:i') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="customer-name" class="col-form-label">Discription:</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                                Back
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function generateCouponCode() {
            const length = 8;
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let code = '';
            for (let i = 0; i < length; i++) {
                code += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('code').value = code;
        }

        $(document).on('change', '#type', function() {
            let type = $(this).val();

            if (type === 'percent') {
                $('#discount_amount').prop('disabled', false);
                $('#discount_amount').attr('maxlength', 3);
            } else {
                $('#discount_amount').prop('disabled', false);
                $('#discount_amount').attr('maxlength', 10);
            }
        });


        $(document).on('click', '.create-discount-btn', function() {
            $('code').val('');
            $('name').val('');
            $('description').val('');
            $('type').val('');
            $('discount_amount').val('');
            $('max_uses').val('');
            $('max_uses_user').val('');
            $('status').val('');
            $('starts_at').val('');
            $('expired_at').val('');
            $('#discountModal').text('Create Categories');
        });
        $(document).on('click', '.update-discount', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('get-discount', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        $('#did').val(response.data.id);
                        $('#code').val(response.data.code);
                        $('#name').val(response.data.name);
                        $('#description').val(response.data.description);
                        $('#type').val(response.data.type);
                        $('#discount_amount').val(response.data.discount_amount);
                        $('#max_uses').val(response.data.max_uses);
                        $('#max_uses_user').val(response.data.max_uses_user);
                        $('#status_dis').val(response.data.status);
                        $('#starts_at').val(response.data.starts_at);
                        $('#expired_at').val(response.data.expired_at);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Something went wrong!");
                }
            });
        });
    </script>
@endsection
