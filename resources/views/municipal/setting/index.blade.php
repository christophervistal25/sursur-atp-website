@extends('municipal.layouts.app')
@section('page-small-title','Personnel')
@section('page-title','Profile')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold card-title">Edit Accounts</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="accounts-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach($municipals as $municipal)
                <tr id="account-{{ $municipal->id }}">
                    <td data-field="true" data-field-key="username" id="username-field-{{ $municipal->id }}" class="text-center" contenteditable="true">{{ $municipal->username }}</td>
                    <td data-field="true" data-field-key="password" id="password-field-{{ $municipal->id }}" class="text-center password-field" contenteditable="true">{{ str_repeat("*", strlen($municipal->password)) }}</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-icon  btn-sm btn-account-edit" data-source-id="{{ $municipal->id }}">
                            <i class="la la-edit "></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if(Session::has('success-barangay'))
    <div class="card bg-success text-white shadow">
        <div class="card-body">
                {{ Session::get('success-barangay') }}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table table-bordered" id="barangays-table">
            <thead>
                <tr>
                    <th>Place</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangays as $barangay)
                <tr>
                    <td>{{ $barangay->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

  
@push('page-scripts')
<script>
    $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});
</script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $('#accounts-table').DataTable();
    $('#barangays-table').DataTable();
</script>
{{-- ACCOUNT JS SCRIPT --}}
<script>
    $(document).on('click', '.btn-account-edit', function (e) {
        let sourceAccount = $(this).attr('data-source-id');

        let data = {
            account_id : sourceAccount,
            username : $(`#username-field-${sourceAccount}`).text(),
            password : $(`#password-field-${sourceAccount}`).text(),
        };

        $.ajax({
            url : "{{ route('setting.municipal.account.update') }}",
            method : 'POST',
            data : data,
            success: function (response) {
                if(response.success) {
                    $(`#password-field-${sourceAccount}`).text('************************************************************');
                    swal("Good job!", "Account successfully update.", "success");
                }
            },
            error : function (response) {
                if(response.status === 422) {
                     // this is a Node object    
                    let errorElement = document.createElement("span");

                    Object.keys(response.responseJSON.errors).forEach((key) => {
                        errorElement.innerHTML += `<p class='text-danger'>${response.responseJSON.errors[key][0]}</p>`;
                    })
                        
                    swal({
                        title: "Opps!", 
                        icon: "error",
                        content: errorElement,
                    });
                }
            }

        });
    });
</script>

@endpush
@endsection
