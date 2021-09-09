@if (Session::has('success'))
    <div class="card bg-success text-white shadow">
        <div class="card-body">
             {{ Session::get('success') }}
        </div>
    </div>
@endif


