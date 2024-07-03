<!-- Preview Modal -->
<div class="modal fade" id="modalPreviewPost" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">Preview Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <div class="nav-align-top">
                <ul class="nav nav-tabs" role="tablist">
                  @foreach($languages as $index => $language)
                    <li class="nav-item">
                        <button
                            style="font-size: 13px; padding: 8px 11px;"
                            type="button"
                            class="nav-link @if($index == $defaultIndex) active @endif"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#preview-tab-content-{{ $index }}"
                            aria-controls="preview-tab-content-{{ $index }}"
                            aria-selected="{{ $index == $defaultIndex ? 'true' : 'false' }}"
                        >
                            <img src="{{ asset($language['flag_path']) }}" alt="{{ $language['name'] }} flag" width="15" height="15" class="mr-1" style="margin-right: 4px;"/>
                            <span>{{ $language['name'] }}</span>
                        </button>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="tab-content p-0 scrollable-content">
                @foreach($languages as $index => $language)
                  <div class="tab-pane fade @if($index == $defaultIndex) show active @endif" id="preview-tab-content-{{ $index }}" role="tabpanel">
                      <div class="mt-3">
                          <h2 id="previewTitle_{{ $language['iso_code'] }}"></h2>
                          <p id="previewSummary_{{ $language['iso_code'] }}" style="font-style: italic; background-color: #dcdcdc30; padding: 10px; border-radius: 6px;"></p>
                          <hr/>
                          <div id="previewBody_{{ $language['iso_code'] }}"></div>
                      </div>
                  </div>
                @endforeach
              </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>
