@extends('layouts/layoutMaster')

@section('title', 'Selects and tags - Forms')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/blog-tags.js')}}"></script>
  <script src="{{asset('assets/js/forms-tagify.js')}}"></script>
  <script src="{{asset('assets/js/forms-typeahead.js')}}"></script>
  <script>
    $(document).ready(function() {
      const tags = @json($listTags);

      console.log('--- list tags nè ----', tags);

      tags.forEach(tagItem => {
        $('#data-table-body').append(`
          <tr>
            <td>${tagItem?.name}</td>
            <td>${tagItem?.alias}</td>
          </tr>
        `);
      });
    });
  </script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Blog /</span> Tags
</h4>
<div class="row">
  <div class="col-6">
    <div class="card mb-4">
      <h6 class="card-header mb-3 pb-0" class="font-weight: 600;">Add New Tag</h6>
      <div class="card-body mt-0 pt-0">
        <div class="form-password-toggle">
          <label class="form-label" for="tag-name">Name</label>
          <div class="input-group input-group-merge">
            <input type="text" class="form-control" id="tag-name" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
          </div>
          <div class="form-text">
            <span style="font-weight: 400">The name is how it appears on your site.</span>
          </div>
        </div>
        <div class="form-password-toggle">
          <label class="form-label" for="tag-alias">Alias</label>
          <div class="input-group input-group-merge">
            <input type="text" class="form-control" id="tag-alias" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
          </div>
          <div class="form-text">
            <span style="font-weight: 400">The "alias" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card mb-4">
      <h6 class="card-header mb-3 pb-0" class="font-weight: 600;">All Tags</h6>
      <div class="card-body mt-0 pt-0">
        <table class="table dt-fixedcolumns">
          <thead>
              <tr>
                  <th class="m-0" style="font-weight: 600;">Name</th>
                  <th class="m-0" style="font-weight: 600;">Alias</th>
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
