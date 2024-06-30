<div class="mt-3">
  <div class="form-floating form-floating-outline mb-2">
    <input type="text" id="post_title_{{ $language['iso_code'] }}" class="form-control" placeholder="Type something...." />
    <label for="post_title_{{ $language['iso_code'] }}">Add Title ({{ $language['name'] }})</label>
    <div class="form-text">
      <span style="font-weight: 800">Permalink: </span>
      <span>{{ $fullHostUrl }}</span>
    </div>
  </div>
  <button
    class="btn btn-xs btn-label-primary mb-2"
    onclick="{{ route('api.get-library-images') }}"
    method="GET"
    type="button" id="addMediaButton_{{ $language['iso_code'] }}"
    data-bs-toggle="modal" data-bs-target="#modalAddMedia"
  >
    <i class="mdi mdi-image-filter-black-white pr-2"></i>
    Add Media
  </button>
  <input type="file" id="imageInput_{{ $language['iso_code'] }}" style="display: none;" accept="image/*">
  {{-- Editor tab --}}
  <div id="full-editor-{{ $language['iso_code'] }}"></div>
</div>
