@foreach($languages as $language)
  <div class="modal fade" id="modalAddMedia-{{ $language['iso_code'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel4">Add Media ({{ $language['name'] }})</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-visible">
          <div class="nav-align-top">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <button style="font-size: 13px; padding: 5px;" type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-media-library-{{ $language['iso_code'] }}" aria-controls="navs-media-library-{{ $language['iso_code'] }}" aria-selected="true">Media Library</button>
              </li>
            </ul>
          </div>
          <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-media-library-{{ $language['iso_code'] }}" role="tabpanel">
              <div class="row mt-2">
                <div class="col-9 preview-scrolling">
                  <form id="checkboxForm">
                    @isset($imageLibrary)
                      <div class="row no-gutters mb-1">
                        @forelse($imageLibrary as $image)
                          <div class="col-md-2 p-0 m-0">
                            <div class="form-check custom-option custom-option-image custom-option-image-check">
                              <input
                                class="select-image form-check-input"
                                type="checkbox"
                                value="{{ $image['url'] }}"
                                id="customCheckboxImg{{ $image['id'] }}"
                              />
                              <label class="select-image form-check-label custom-option-content" for="customCheckboxImg{{ $image['id'] }}">
                                <span class="custom-option-body">
                                  <img src="{{ $image['url'] }}" alt="{{ $image['name'] }}" class="img-fluid" />
                                </span>
                              </label>
                            </div>
                          </div>
                        @empty
                          <p>No media found.</p>
                        @endforelse
                      </div>
                    @endisset
                  </form>
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
                        <div class="col-12">
                          <div class="form-floating form-floating-outline">
                            <label for="altText" class="form-label">Alt Text</label>
                            <input type="text" id="altText" name="altText" class="form-control form-control-sm" placeholder="..." />
                          </div>
                        </div>
                        <div>
                          <label for="titleImage" class="form-label">Title</label>
                          <input id="titleImage" class="form-control form-control-sm" type="text" placeholder="" />
                        </div>
                        {{-- Uncomment if needed
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
                        --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <span style="font-size: 12px;">Tổng cộng {{ count($imageLibrary) }} hình ảnh</span>
          <button type="reset" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="addIntoPostButton-{{ $language['iso_code'] }}" class="add-into-post btn btn-sm btn-primary me-sm-3 me-1">Add into post ({{ $language['name'] }})</button>
        </div>
      </div>
    </div>
  </div>
@endforeach
