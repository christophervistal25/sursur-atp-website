@extends('templates-2.app')
@section('page-title','List of Municipalities')
@prepend('page-css')
@endprepend
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      List of Municipalities
  </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
  <table class="table datatable table--report  display w-full"  id="municipality-table">
      <thead>
        <tr>
          <th class="font-medium">Code</th>
          <th class="font-medium">Name</th>
          <th class="font-medium">Province</th>
          <th class="font-medium">Income Classification</th>
          <th class="font-medium">Population</th>
          <th class="font-medium text-center"># of Barangays</th>
        </tr>
      </thead>
      <tbody></tbody>
  </table>
</div>
<!-- END: Datatable -->
  @push('page-scripts')
  <script>
    const BASE_URL = document.head.querySelector('meta[name="base_url"]').content
    let ROUTE = `${BASE_URL}admin/list/city`;
    // By default the template has built-in datatable so we need to 
    // by destroying the first one then re-initialize the datable to run our customize server-side process for rendering data.
    $('#municipality-table').dataTable().fnClearTable();
    $('#municipality-table').dataTable().fnDestroy();


    let municipality_table = $('#municipality-table').DataTable({
          serverSide: true,
          ajax: ROUTE,
          columns: [
              { name: 'code' },
              { name: 'name' },
              { name: 'municipality_province', orderable : false, searchable : false },
              { name: 'income_classification' },
              { name: 'population' },
              { name: 'municipality_barangay', searchable: false, orderable : false },
          ],
      });

  </script>
  @endpush
@endsection
