@extends('templates-2.app')
@section('page-title','List of Barangay')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Barangay
  </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
  <table class="table datatable table--report  display w-full"  id="barangay-table">
      <thead>
        <tr>
          <th class="font-medium">Code</th>
          <th class="font-medium">Province Code</th>
          <th class="font-medium">Municipality Code</th>
          <th class="font-medium">Name</th>
          <th class="font-medium">Urban / Rural (base on 2010 CPH)</th>
          <th class="font-medium text-center">Population</th>
        </tr>
      </thead>
      <tbody></tbody>
  </table>
</div>
<!-- END: Datatable -->
  @push('page-scripts')
  <script>
    const BASE_URL = document.head.querySelector('meta[name="base_url"]').content
    let ROUTE = `${BASE_URL}admin/list/barangay`;

    // By default the template has built-in datatable so we need to 
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#barangay-table').dataTable().fnClearTable();
    $('#barangay-table').dataTable().fnDestroy();
    

    let barangay_table = $('#barangay-table').DataTable({
          serverSide: true,
          ajax: ROUTE,
          columns: [
              { name: 'code' },
              { name: 'province_code' },
              { name: 'city_code' },
              { name: 'name' },
              { name: 'type' },
              { name: 'population' },
          ],
      });

  </script>
  @endpush
@endsection
