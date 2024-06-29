<div class="nav-align-top">
  <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
          <button style="font-size: 13px; padding: 5px;" type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-media-library" aria-controls="navs-media-library" aria-selected="true">Media Library</button>
      </li>
      <li class="nav-item">
          <button style="font-size: 13px; padding: 5px;" type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-upload-files" aria-controls="navs-upload-files" aria-selected="false">Upload files</button>
      </li>
  </ul>
</div>
<div class="tab-content p-0">
  <div class="tab-pane fade show active" id="navs-media-library" role="tabpanel">
      <div class="row mt-2">
          <div class="col-9">
            <div class="row" data-masonry='{"percentPosition": true }'>
              @isset($imageLibrary)
                @forelse($imageLibrary as $image)
                  <div class="col-md-2" style="margin: 0px; padding: 0px;">
                      <div class="form-check custom-option custom-option-image custom-option-image-check">
                          <input class="form-check-input" type="checkbox" value="" id="customCheckboxImg{{ $image['id'] }}" />
                          <label class="form-check-label custom-option-content" for="customCheckboxImg{{ $image['id'] }}">
                              <span class="custom-option-body">
                                  <img src="{{ $image['url'] }}" alt="{{ $image['name'] }}" />
                              </span>
                          </label>
                      </div>
                  </div>
                @empty
                    <p>No media found.</p>
                @endforelse
              @endisset
            </div>
          </div>
          <div class="col-3">
              <div class="card">
                  <h6 class="card-header" style="margin: 0px; padding: 10px; font-size: 12px;">ATTACHMENT DETAILS</h6>
                  <div class="card-body" style="margin: 0px; padding: 10px;">
                      <div class="form-check custom-option custom-option-image custom-option-image-check" style="margin: 0px; padding: 0px;">
                          <label class="form-check-label custom-option-content" for="customCheckboxImg0" >
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
  <div class="tab-pane fade" id="navs-upload-files" role="tabpanel">
    <form action="/upload" class="dropzone needsclick mt-1" id="dropzone-basic">
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
