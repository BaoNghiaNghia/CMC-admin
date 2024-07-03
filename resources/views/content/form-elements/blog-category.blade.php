@extends('layouts/layoutMaster')

@section('title', 'Pickers - Forms')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/pickr/pickr.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/blog-category.js')}}"></script>
  <script >
    // Convert PHP data to JSON format
    var dataBlogCategories = @json($blogCategories);
    var original = @json($languages);
    const languages = Object.values(original).map(language => language.iso_code);
    const tableHead = document.querySelector("table thead tr");

    const tableBody = document.getElementById("data-table-body");
    if (dataBlogCategories.length > 0) {
      dataBlogCategories.forEach(dataBlog => {
        $('#data-table-body').append(`
          <tr>
            <td>${dataBlog?.name}</td>
            <td>${dataBlog?.code}</td>
            <td>${dataBlog?.alias}</td>
            <td>${dataBlog?.from}</td>
          </tr>
        `);
      });
    }
  </script>


@endsection

@section('content')
<h4 class="py-1">
  <span class="text-muted fw-light">Posts /</span> Category
</h4>

<div class="row">
  <div class="col-4">
    <div class="card mb-4">
      <h6 class="card-header mb-3 pb-0" class="font-weight: 600;">Add New Category</h6>
      <div class="card-body mt-0 pt-0">
        <div class="form-password-toggle">
          <label class="form-label" for="category-name">Name</label>
          <div class="input-group input-group-merge">
            <input type="text" class="form-control" id="category-name" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
          </div>
          <div class="form-text">
            <span style="font-weight: 400">The name is how it appears on your site.</span>
          </div>
        </div>
        <div class="form-password-toggle mt-0 pt-0">
          <label class="form-label" for="category-section">Section</label>
          <div class="input-group input-group-merge">
            <input type="text" class="form-control" id="category-section" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
          </div>
          <div class="form-text">
            <span style="font-weight: 400">The "alias" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</span>
          </div>
        </div>
        <hr/>
        @foreach($languages as $index => $language)
          <div class="form-password-toggle">
            <label class="form-label" for="category-language-{{ $language['iso_code'] }}">{{ $language['name'] }}</label>
            <div class="input-group input-group-merge">
              <input type="text" class="form-control" id="category-language-{{ $language['iso_code'] }}" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
            </div>
          </div>
        @endforeach
        <button class="btn btn-xs btn-outline-primary mt-3 text-right" id="publishButton" type="button">Add New Category</button>
      </div>
    </div>
  </div>
  <div class="col-8">
    <div class="card mb-4">
      <h6 class="card-header mb-3 pb-0" class="font-weight: 600;">All Category</h6>
      <div class="card-body mt-0 pt-0">
        <table class="table dt-fixedcolumns">
          <thead>
            <tr>
              <th class="m-0 p-2" style="font-weight: 600;">Name</th>
              <th class="m-0 p-2" style="font-weight: 600;">Code</th>
              <th class="m-0 p-2" style="font-weight: 600;">alias</th>
              <th class="m-0 p-2" style="font-weight: 600;">from</th>
            </tr>
          </thead>
          <tbody id="data-table-body">
          </tbody>
        </table>
        @if(isset($blogCategories) && empty($blogCategories))
          <span class="text-center">No Data</span>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
