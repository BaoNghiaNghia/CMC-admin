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
  var data = @json($blogCategories);
  var original = @json($languages);
  const languages = Object.values(original).map(language => language.iso_code);
  const tableHead = document.querySelector("table thead tr");

  // // Dynamically create language columns
  // languages.forEach(language => {
  //   const th = document.createElement("th");
  //   th.classList.add("m-0", "p-2");
  //   th.style.fontWeight = "600";
  //   th.textContent = language.toUpperCase();
  //   tableHead.appendChild(th);
  // });

  const tableBody = document.getElementById("data-table-body");

  data.forEach(item => {
    const row = document.createElement("tr");

    // Add the name column
    const nameCell = document.createElement("td");
    nameCell.classList.add("m-0", "p-2");
    nameCell.textContent = item.name;
    row.appendChild(nameCell);

    // Add the alias column
    const aliasCell = document.createElement("td");
    aliasCell.classList.add("m-0", "p-2");
    aliasCell.textContent = item.alias;
    row.appendChild(aliasCell);

    // Add the language-specific columns
    languages.forEach(language => {
      const langCell = document.createElement("td");
      langCell.classList.add("m-0", "p-2");
      langCell.textContent = item.languages[language] ? item.languages[language].Name : "...";
      row.appendChild(langCell);
    });

    tableBody.appendChild(row);
  });
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
        <div class="form-password-toggle">
          <label class="form-label" for="category-section">Section</label>
          <div class="input-group input-group-merge">
            <input type="text" class="form-control" id="category-section" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
          </div>
          <div class="form-text">
            <span style="font-weight: 400">The "alias" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</span>
          </div>
        </div>
        @foreach($languages as $index => $language)
          <div class="form-password-toggle">
            <label class="form-label" for="category-language-{{ $language['iso_code'] }}">{{ $language['name'] }}</label>
            <div class="input-group input-group-merge">
              <input type="text" class="form-control" id="category-language-{{ $language['iso_code'] }}" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
            </div>
          </div>
        @endforeach
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
                  <th class="m-0 p-2" style="font-weight: 600;">alias</th>
                  @foreach($languages as $index => $language)
                    <th class="m-0 p-2" style="font-weight: 600;">{{ $language['name'] }}</th>
                  @endforeach
              </tr>
          </thead>
          <tbody id="data-table-body">
              <!-- Data will be dynamically populated here -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
