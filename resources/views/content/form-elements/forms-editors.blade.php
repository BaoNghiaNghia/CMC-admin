@extends('layouts/layoutMaster')

@section('title', 'Editors - Forms')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/forms-editors.js')}}"></script>
@endsection

@section('content')
<h4 class="">
  <span class="text-muted fw-light">Posts /</span> New Post
</h4>

<div class="row">
  <!-- Full Editor -->
  <div class="col-9">
    <div class="card">
      <div class="form-floating form-floating-outline mx-3 mt-4">
        <input type="text" id="username" class="form-control" placeholder="johndoe" />
        <label for="username">Add Title</label>
      </div>
      <div class="card-body">
        <button class="btn btn-sm btn-label-secondary mb-2" type="button">Add Media</button>
        <div id="full-editor">
          <h6>Quill Rich Text Editor</h6>
          <p> Cupcake ipsum dolor sit amet. Halvah cheesecake chocolate bar gummi bears cupcake. Pie macaroon bear claw. Soufflé I love candy canes I love cotton candy I love. </p>
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
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h4 class="accordion-header d-flex align-items-center">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-2" aria-expanded="false">
            <i class="mdi mdi-briefcase me-2"></i>
            Category
          </button>
        </h4>
        <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <div class="form-check custom-option custom-option-basic mb-2">
              <label class="form-check-label custom-option-content" for="customCheckTemp1">
                <input class="form-check-input" type="checkbox" value="" id="customCheckTemp1" checked />
                <span class="custom-option-header">
                  <span class="h6 mb-0">Category 1</span>
                  <span>20%</span>
                </span>
              </label>
            </div>
            <div class="form-check custom-option custom-option-basic mb-2">
              <label class="form-check-label custom-option-content" for="customCheckTemp2">
                <input class="form-check-input" type="checkbox" value="" id="customCheckTemp2" checked />
                <span class="custom-option-header">
                  <span class="h6 mb-0">Category 2</span>
                  <span>20%</span>
                </span>
              </label>
            </div>
            <div class="form-check custom-option custom-option-basic mb-2">
              <label class="form-check-label custom-option-content" for="customCheckTemp3">
                <input class="form-check-input" type="checkbox" value="" id="customCheckTemp3" checked />
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
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-3" aria-expanded="false">
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
