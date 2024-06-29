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
    document.getElementById('addMediaButton').addEventListener('click', function() {
      fetch('{{ route('api.get-library-images') }}')
        .then(response => response.json())
        .then(data => {
          // Assuming 'media' is the key in the returned JSON
          const media = data.media;
          console.log('--- data nè -----', media);
          // Update the media library section dynamically
        })
        .catch(error => {
            console.error('Error fetching media:', error);
        });
    });
  </script>
@endsection

@section('content')
    <h4 class="">
        <span class="text-muted fw-light">Posts /</span> New Post
    </h4>

    <!-- Extra Large Modal -->
    <div class="modal fade" id="modalAddMedia" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel4">Add Media</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-hidden" id="vertical-example">
                  @include('content.form-elements.body-insert-media')
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-sm btn-primary">Insert into post</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <div class="form-floating form-floating-outline mb-2">
              <input type="text" id="username" class="form-control" placeholder="johndoe" />
              <label for="username">Add Title</label>
            </div>
            {{-- <div class="card">
              <div class="card-body">
              </div>
            </div> --}}
            <div class="nav-align-top">
              <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $language)
                  <li class="nav-item">
                      <button style="font-size: 13px; padding: 5px;" type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-media-library" aria-controls="navs-media-library" aria-selected="true">{{ $language['name'] }}</button>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="tab-content p-0">
              <div class="tab-pane fade show active" id="navs-media-library" role="tabpanel">
                @include('content.form-elements.multilang-editor')
              </div>
            </div>
          </div>
        <div class="col-3">
            <div class="accordion" id="accordionWithIcon">
                <div class="accordion-item active">
                    <h4 class="accordion-header d-flex align-items-center">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
                            <i class="mdi mdi-chart-bar me-2"></i>
                            Publish
                        </button>
                    </h4>

                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <button class="btn btn-xs btn-outline-primary" type="button">Save Draft</button>
                                <button class="btn btn-xs btn-outline-primary" type="button">Preview</button>
                            </div>
                            <div class="my-3">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex align-items-center" style="font-size: 13px; padding: 5px;">
                                        <i class="mdi mdi-television me-2"></i>
                                        Status: <strong> Draft</strong>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center" style="font-size: 13px; padding: 5px;">
                                        <i class="mdi mdi-bell-outline me-2"></i>
                                        Visibility: <strong> Public</strong>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center" style="font-size: 13px; padding: 5px;">
                                        <i class="mdi mdi-headphones me-2"></i>
                                        Publish <strong> Immediately</strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="row float-end">
                                <div class="col-12">
                                    <button class="btn btn-xs btn-primary" type="button">Publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h4 class="accordion-header d-flex align-items-center">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-2" aria-expanded="false">
                            <i class="mdi mdi-briefcase me-2"></i>
                            Language
                        </button>
                    </h4>
                    <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                          @foreach($languages as $language)
                            <div class="form-check custom-option custom-option-basic mb-2 p-0">
                              <label class="form-check-label custom-option-content" for={{ $language['iso_code'] }} style="padding-top: 5px; padding-bottom: 5px;">
                                  <input class="form-check-input" type="checkbox" value="" id={{ $language['iso_code'] }}
                                      checked />
                                  <span class="custom-option-header">
                                      <span class="h6 mb-0">{{ $language['name'] }}</span>
                                      <span>{{ $language['iso_code'] }}</span>
                                  </span>
                              </label>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h4 class="accordion-header d-flex align-items-center">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-2" aria-expanded="false">
                            <i class="mdi mdi-briefcase me-2"></i>
                            Category
                        </button>
                    </h4>
                    <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="form-check custom-option custom-option-basic mb-2 p-0">
                                <label class="form-check-label custom-option-content" for="customCheckTemp1" style="padding-top: 5px; padding-bottom: 5px;">
                                    <input class="form-check-input" type="checkbox" value="" id="customCheckTemp1"
                                        checked />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Category 1</span>
                                        <span>20%</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check custom-option custom-option-basic mb-2">
                                <label class="form-check-label custom-option-content" for="customCheckTemp2"  style="padding-top: 5px; padding-bottom: 5px;">
                                    <input class="form-check-input" type="checkbox" value="" id="customCheckTemp2"
                                        checked />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Category 2</span>
                                        <span>20%</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check custom-option custom-option-basic mb-2">
                                <label class="form-check-label custom-option-content" for="customCheckTemp3" style="padding-top: 5px; padding-bottom: 5px;">
                                    <input class="form-check-input" type="checkbox" value="" id="customCheckTemp3"
                                        checked />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Category 3</span>
                                        <span>20%</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h4 class="accordion-header d-flex align-items-center">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-3" aria-expanded="false">
                            <i class="mdi mdi-gift me-2"></i>
                            Feature Image
                        </button>
                    </h4>
                    <div id="accordionWithIcon-3" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <form action="/upload" class="dropzone needsclick" id="dropzone-basic">
                                <div class="dz-message needsclick">
                                    Import feature image
                                    <span class="note needsclick">.png or .jpg</span>
                                </div>
                                <div class="fallback">
                                    <input name="file" type="file" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
