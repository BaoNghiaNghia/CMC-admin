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
<script src="{{asset('assets/js/forms-pickers.js')}}"></script>
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
      langCell.textContent = item.languages[language] ? item.languages[language].Name : "";
      row.appendChild(langCell);
    });

    tableBody.appendChild(row);
  });
</script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Posts /</span> Category
</h4>
<table class="table table-bordered">
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
@endsection
