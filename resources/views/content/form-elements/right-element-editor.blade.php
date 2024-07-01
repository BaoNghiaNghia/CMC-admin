<div class="accordion" id="accordionWithIcon">
  <div class="accordion-item active">
      <h4 class="accordion-header d-flex align-items-center">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-1" aria-expanded="true">
              <i class="mdi mdi-chart-bar me-2"></i>
              <span style="font-size: 15px;font-weight: 700;">Publish</span>
          </button>
      </h4>

      <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
          <div class="accordion-body">
              <div class="d-flex justify-content-between flex-wrap m-0">
                  <button class="btn btn-xs btn-outline-primary m-0" type="button">Save Draft</button>
                  <button class="btn btn-xs btn-outline-primary m-0" type="button">Preview</button>
              </div>
              <div class="my-2">
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
              <div class="d-grid">
                  <button class="btn btn-sm btn-primary" id="publishButton" type="button" style="font-weight: 700">Publish</button>
              </div>
          </div>
      </div>
  </div>

  <div class="accordion-item">
      <h4 class="accordion-header d-flex align-items-center">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
              data-bs-target="#accordionWithIcon-2" aria-expanded="false">
              <i class="mdi mdi-briefcase me-2"></i>
              <span style="font-size: 15px;font-weight: 700;">Category</span>
          </button>
      </h4>

      <div id="accordionWithIcon-2" class="accordion-collapse collapse show">
          <div class="accordion-body">
            @if(isset($blogCategories) && count($blogCategories) > 0)
              @foreach($blogCategories as $category)
                <div class="form-check">
                  <input name="default-radio-category" class="form-check-input" type="radio" value="{{ $category['id'] }}" id="{{ $category['id'] }}" />
                  <label class="form-check-label" for="{{ $category['id'] }}">
                    {{ $category['name'] }}
                  </label>
                </div>
              @endforeach
            @else
              No category found
            @endif
          </div>
      </div>
  </div>

  <div class="accordion-item">
      <h4 class="accordion-header d-flex align-items-center">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
              data-bs-target="#accordionWithIcon-3" aria-expanded="false">
              <i class="mdi mdi-gift me-2"></i>
              <span style="font-size: 15px;font-weight: 700;">Feature Image</span>
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
