@extends('layouts/layoutMaster')

@section('title', 'Articles')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <!-- Flat Picker -->
  <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
@endsection

@section('page-script')
  {{-- <script src="{{asset('assets/js/tables-datatables-advanced.js')}}"></script> --}}
  <script>
    function formatDate(dateString) {
      let date = new Date(dateString);

      // Format hours and minutes
      let timeOptions = { hour: '2-digit', minute: '2-digit', hour12: false };
      let timeFormatter = new Intl.DateTimeFormat('en-GB', timeOptions);
      let formattedTime = timeFormatter.format(date);

      // Format day and month
      let dateOptions = { day: '2-digit', month: '2-digit' };
      let dateFormatter = new Intl.DateTimeFormat('en-GB', dateOptions);
      let formattedDate = dateFormatter.format(date);

      return `${formattedTime}  ${formattedDate}`;
    }

    $(document).ready(function() {
      const listNews = @json($listNews);

      listNews.forEach(news => {
        $('#data-table-body').append(`
          <tr>
            <td><img src="${news.thumbnail}" alt="${news.title}" style="width: 100px; height: auto;"></td>
            <td>${news.title}</td>
            <td>${news.summary}</td>
            <td>${news.category ? news.category.name : 'N/A'}</td>
            <td>${news.alias}</td>
            <td>${news.author}</td>
            <td>${formatDate(news.created_at)}</td>
            <td>${formatDate(news.update_at)}</td>
          </tr>
        `);
      });
    });
  </script>
@endsection

@section('content')
<h4 class="">
  <span class="text-muted fw-light">Blog /</span> Articles
</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="m-0 p-2" style="font-weight: 600;">Thumbnail</th>
            <th class="m-0 p-2" style="font-weight: 600;">Title</th>
            <th class="m-0 p-2" style="font-weight: 600;">Summary</th>
            <th class="m-0 p-2" style="font-weight: 600;">Category</th>
            <th class="m-0 p-2" style="font-weight: 600;">Alias</th>
            <th class="m-0 p-2" style="font-weight: 600;">Author</th>
            <th class="m-0 p-2" style="font-weight: 600;">Created</th>
            <th class="m-0 p-2" style="font-weight: 600;">Updated</th>
        </tr>
    </thead>
    <tbody id="data-table-body">
        <!-- Data will be dynamically populated here -->
    </tbody>
</table>
@endsection
