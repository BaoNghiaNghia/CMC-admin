@extends('layouts/layoutMaster')

@section('title', 'Blog - Add New Post')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
  <script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
  <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/forms-file-upload.js')}}"></script>
  <script src="{{asset('assets/js/forms-editors.js')}}"></script>
  <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
  <script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/js/ui-toasts.js')}}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      @if(session('status'))
        Toastify({
          text: "{{ session('status')['message'] }}",
          duration: 3000,
          close: true,
          gravity: "bottom", // `top` or `bottom`
          position: "center", // `left`, `center` or `right`
          backgroundColor: "{{ session('status')['success'] ? 'green' : 'red' }}",
        }).showToast();
      @endif

      document.getElementById('insert-button').addEventListener('click', function() {
        // Get all checkboxes
        let checkboxes = document.querySelectorAll('.select-image.form-check-input:checked');
        let selectedImages = [];

        // Iterate over checked checkboxes
        checkboxes.forEach(function(checkbox) {
          selectedImages.push(checkbox.value);
        });

        // Log the selected images to the console
        console.log(selectedImages);
      });
  </script>
@endsection

@php
  $parsedUrl = parse_url(request()->url());
  $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : 'https://';
  $host = $parsedUrl['host'] ?? '';
  $fullHostUrl = $scheme . $host;
@endphp


@section('content')
    <h4 class="">
        <span class="text-muted fw-light">Posts /</span> New Post
    </h4>

    <!-- Extra Large Modal -->
    @include('content.form-elements.body-insert-media')

    <div class="row">
        <div class="col-9">
          <div class="form-floating form-floating-outline mb-2">
            <input type="text" id="username" class="form-control" placeholder="johndoe" />
            <label for="username">Add Title</label>
            <div class="form-text">
              <span style="font-weight: 800">Permalink: </span>
              <span>{{ $fullHostUrl }}</span>
            </div>
          </div>
          @if(isset($languages) && count($languages) > 0)
            <div class="nav-align-top">
              <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $language)
                  <li class="nav-item">
                    <button
                      style="font-size: 13px; padding: 8px 11px;"
                      type="button"
                      class="nav-link active"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-media-library"
                      aria-controls="navs-media-library"
                      aria-selected="true"
                    >
                      <img src="{{asset($language['flag_path'])}}" alt="google home" width="15" heigh="15" class="mr-1" style="margin-right: 4px;"/>
                      <span>{{ $language['name'] }}</span>
                    </button>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="tab-content p-0">
              <div class="tab-pane fade show active" id="navs-media-library" role="tabpanel">
                @include('content.form-elements.multilang-editor')
              </div>
            </div>
          @else
            No languages found
          @endif
        </div>
        <div class="col-3">
          @include('content.form-elements.right-element-editor')
        </div>
    </div>
@endsection
