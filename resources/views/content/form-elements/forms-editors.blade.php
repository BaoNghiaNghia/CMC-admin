@extends('layouts/layoutMaster')

@section('title', 'Blog - Add New Post')

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
                    <div class="row">
                        <div class="col-9">
                            @for($row = 1; $row <= 10; $row++)
                                <div class="row mb-3">
                                    @for($column = 1; $column <= 2; $column++)
                                        <div class="col-md-2">
                                            <div class="form-check custom-option custom-option-image custom-option-image-check">
                                                <input class="form-check-input" type="checkbox" value="" id="customCheckboxImg4" checked />
                                                <label class="form-check-label custom-option-content" for="customCheckboxImg4">
                                                    <span class="custom-option-body">
                                                        <img src="{{ asset('assets/img/backgrounds/5.jpg') }}" alt="cbImg" />
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check custom-option custom-option-image custom-option-image-check">
                                                <input class="form-check-input " type="checkbox" value="" id="customCheckboxImg2" />
                                                <label class="form-check-label custom-option-content" for="customCheckboxImg2">
                                                    <span class="custom-option-body">
                                                        <img src="{{ asset('assets/img/backgrounds/16.jpg') }}" alt="cbImg" />
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
                                <h6 class="card-header" style="">ATTACHMENT DETAILS</h6>
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <div
                                                class="form-check custom-option custom-option-image custom-option-image-check">
                                                <label class="form-check-label custom-option-content"
                                                    for="customCheckboxImg0">
                                                    <span class="custom-option-body">
                                                        <img src="{{ asset('assets/img/backgrounds/8.jpg') }}"
                                                            alt="cbImg" />
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-sm-start">MeoTwitter_Logo.png</p>
                                            <p>June 27, 2024</p>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <p>498 KB</p>
                                        </div>
                                        <div class="col-6">
                                            <p>1792 x 1024 pixels</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <label for="smallInput" class="form-label">Alt Text</label>
                                            <input id="smallInput" class="form-control form-control-sm" type="text" placeholder="" />
                                        </div>
                                        <div>
                                            <label for="smallInput" class="form-label">Title</label>
                                            <input id="smallInput" class="form-control form-control-sm" type="text" placeholder="" />
                                        </div>
                                        <div>
                                            <label for="smallInput" class="form-label">Caption</label>
                                            <input id="smallInput" class="form-control form-control-sm" type="text" placeholder="" />
                                        </div>
                                        <div>
                                            <label for="smallInput" class="form-label">Description</label>
                                            <input id="smallInput" class="form-control form-control-sm" type="text" placeholder="" />
                                        </div>
                                        <div>
                                            <label for="smallInput" class="form-label">File URL</label>
                                            <input id="smallInput" class="form-control form-control-sm" type="text" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-outline-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-xs btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Full Editor -->
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
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-1" aria-expanded="true">
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
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="mdi mdi-television me-2"></i>
                                        Status: <strong>Draft</strong>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="mdi mdi-bell-outline me-2"></i>
                                        Visibility: <strong>Public</strong>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="mdi mdi-headphones me-2"></i>
                                        Publish <strong>immediately</strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-12  text-right">
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
                            <div class="form-check custom-option custom-option-basic mb-2">
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
        <!-- /Full Editor -->
    </div>
@endsection
