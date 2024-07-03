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
  <script>
    function truncate(str, n){
      return (str.length > n) ? str.slice(0, n-1) + '&hellip;' : str;
    };

    function formatDate(dateString) {
      let date = new Date(dateString);

      // Format hours and minutes
      let timeOptions = { hour: '2-digit', minute: '2-digit', hour12: false };
      let timeFormatter = new Intl.DateTimeFormat('en-US', timeOptions);
      let formattedTime = timeFormatter.format(date);

      // Format day and month
      let dateOptions = { day: '2-digit', month: '2-digit' };
      let dateFormatter = new Intl.DateTimeFormat('en-US', dateOptions);
      let formattedDate = dateFormatter.format(date);

      return `${formattedTime}  ${formattedDate}`;
    }

    function checkImageUrl(url) {
        return new Promise((resolve) => {
            const img = new Image();
            img.onload = function() {
                resolve(true);
            };
            img.onerror = function() {
                resolve(false);
            };
            img.src = url;
        });
    }

    $(document).ready(function() {
      const listNews = @json($listNews);
      const defaultThumbnail = asset('assets/img/id_ID.png'); // Replace with your default image URL

      listNews.forEach(news => {
          checkImageUrl(news.thumbnail).then(isValid => {
              const thumbnail = isValid ? news.thumbnail : defaultThumbnail;
              $('#data-table-body').append(`
                  <tr>
                      <td style="margin: 0px auto;"><img class="m-0 p-0" src="${thumbnail}" style="width: 70px; height: auto; border-radius: 4px;"></td>
                      <td style="font-weight: 600; color: black;">${news.title}</td>
                      <td>${truncate(news.summary, 100)}</td>
                      <td>${news.category ? news.category.name : 'N/A'}</td>
                      <td>${news.alias}</td>
                      <td>${news?.author?.name || 'Chưa có'}</td>
                      <td>${formatDate(news.created_at)}</td>
                      <td>${formatDate(news.update_at)}</td>
                  </tr>
              `);
          });
      });
  });

  </script>
@endsection

@section('content')
<h4 class="">
  <span class="mr-3">
    <span class="text-muted fw-light">Blog /</span> Articles
  </span>
  <button class="btn btn-xs btn-outline-primary" id="publishButton" type="button">Add New Post</button>
</h4>
<table class="table dt-fixedcolumns">
    <thead>
        <tr>
            <th class="m-0 p-2" style="font-weight: 600;">Thumbnail</th>
            <th class="m-0 p-2" style="font-weight: 600;">Title</th>
            <th class="m-0 p-2" style="font-weight: 600;">Summary</th>
            <th class="m-0 p-2" style="font-weight: 600;">Category</th>
            <th class="m-0 p-2" style="font-weight: 600;">Alias</th>
            <th class="m-0 p-2" style="font-weight: 600;">Author</th>
            <th class="m-0 p-2" style="font-weight: 600;">Published</th>
            <th class="m-0 p-2" style="font-weight: 600;">Modified</th>
        </tr>
    </thead>
    <tbody id="data-table-body">
        <!-- Data will be dynamically populated here -->
    </tbody>
</table>
@endsection
