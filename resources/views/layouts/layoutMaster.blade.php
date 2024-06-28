@isset($pageConfigs)
  {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
  <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
  <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
  <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
  <script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
@endsection

@php
  $configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'layouts.horizontalLayout' :
  (( $configData["layout"] === 'blank') ? 'layouts.blankLayout' :
  (($configData["layout"] === 'front') ? 'layouts.layoutFront' : 'layouts.contentNavbarLayout') )))
@endisset
