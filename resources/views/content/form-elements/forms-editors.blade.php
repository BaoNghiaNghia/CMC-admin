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
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <button style="font-size: 13px; padding: 5px;" type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">Media Library</button>
                            </li>
                            <li class="nav-item">
                                <button style="font-size: 13px; padding: 5px;" type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Upload files</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                            <div class="row mt-3">
                                <div class="col-9">
                                    @for($row = 1; $row <= 15; $row++)
                                        <div class="row mb-0 no-gutters">
                                            @for($column = 1; $column <= 2; $column++)
                                                <div class="col-md-2" style="margin: 0px; padding: 2px;">
                                                    <div class="form-check custom-option custom-option-image custom-option-image-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="customCheckboxImg4" checked />
                                                        <label class="form-check-label custom-option-content" for="customCheckboxImg4">
                                                            <span class="custom-option-body">
                                                                <img src="{{ asset('assets/img/backgrounds/5.jpg') }}" alt="cbImg" />
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="margin: 0px; padding: 2px;">
                                                    <div class="form-check custom-option custom-option-image custom-option-image-check">
                                                        <input class="form-check-input " type="checkbox" value="" id="customCheckboxImg2" />
                                                        <label class="form-check-label custom-option-content" for="customCheckboxImg2">
                                                            <span class="custom-option-body">
                                                                <img src="{{ asset('assets/img/backgrounds/16.jpg') }}" alt="cbImg" />
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="margin: 0px; padding: 2px;">
                                                    <div class="form-check custom-option custom-option-image custom-option-image-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="customCheckboxImg53" />
                                                        <label class="form-check-label custom-option-content" for="customCheckboxImg53">
                                                            <span class="custom-option-body">
                                                                <img src="{{ asset('assets/img/backgrounds/15.jpg') }}" alt="cbImg" />
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    @endfor
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <h6 class="card-header" style="margin: 0px; padding: 10px; font-size: 12px;">ATTACHMENT DETAILS</h6>
                                        <div class="card-body" style="margin: 0px; padding: 10px;">
                                            <div class="form-check custom-option custom-option-image custom-option-image-check" style="margin: 0px; padding: 0px;">
                                                <label class="form-check-label custom-option-content" for="customCheckboxImg0">
                                                    <span class="custom-option-body">
                                                        <img src="{{ asset('assets/img/backgrounds/8.jpg') }}" alt="cbImg" />
                                                    </span>
                                                </label>
                                            </div>
                                            <div style="font-size: 13px;">MeoTwitter_Logo.png</div>
                                            <div style="font-size: 13px;">June 27, 2024</div>
                                            <div style="font-size: 13px;">498 KB</div>
                                            <div style="font-size: 13px;">1792 x 1024 pixels</div>
                                            <hr>
                                            <div class="mt-2">
                                                <div class="">
                                                    <label for="altText" class="form-label">Alt Text</label>
                                                    <textarea id="altText" class="form-control form-control-sm" type="text" placeholder=""></textarea>
                                                </div>
                                                <div>
                                                    <label for="titleImage" class="form-label">Title</label>
                                                    <input id="titleImage" class="form-control form-control-sm" type="text" placeholder="" />
                                                </div>
                                                <div>
                                                    <label for="captionImage" class="form-label">Caption</label>
                                                    <textarea id="captionImage" class="form-control form-control-sm" type="text" placeholder=""></textarea>
                                                </div>
                                                <div>
                                                    <label for="descriptionImage" class="form-label">Description</label>
                                                    <textarea id="descriptionImage" class="form-control form-control-sm" type="text" placeholder=""></textarea>
                                                </div>
                                                <div>
                                                    <label for="smallInput" class="form-label">File URL</label>
                                                    <input id="smallInput" class="form-control form-control-sm" type="text" placeholder="" />
                                                </div>
                                                <button type="button" class="btn btn-xs btn-label-secondary mt-2 mb-2">Copy to Clipboard</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary">Insert into post</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="form-floating form-floating-outline mx-3 mt-4">
                    <input type="text" id="username" class="form-control" placeholder="johndoe" />
                    <label for="username">Add Title</label>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-label-primary mb-2" type="button" data-bs-toggle="modal"
                        data-bs-target="#modalAddMedia">
                        <i class="mdi mdi-image-filter-black-white pr-2"></i>
                        Add Media
                    </button>
                    <div id="full-editor">
                        <h6>Quill Rich Text Editor</h6>
                        <p> Cupcake ipsum dolor sit amet. Halvah cheesecake chocolate bar gummi bears cupcake. Pie macaroon
                            bear claw. Soufflé I love candy canes I love cotton candy I love. </p>
                    </div>
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
                            Category
                        </button>
                    </h4>
                    <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="form-check custom-option custom-option-basic mb-2 p-0">
                                <label class="form-check-label custom-option-content" for="customCheckTemp1">
                                    <input class="form-check-input" type="checkbox" value="" id="customCheckTemp1"
                                        checked />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Category 1</span>
                                        <span>20%</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check custom-option custom-option-basic mb-2">
                                <label class="form-check-label custom-option-content" for="customCheckTemp2">
                                    <input class="form-check-input" type="checkbox" value="" id="customCheckTemp2"
                                        checked />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Category 2</span>
                                        <span>20%</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check custom-option custom-option-basic mb-2">
                                <label class="form-check-label custom-option-content" for="customCheckTemp3">
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
