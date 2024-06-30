<div class="mt-3">
  <button
    class="btn btn-xs btn-label-primary mb-2"
    onclick="{{ route('api.get-library-images') }}"
    method="GET"
    type="button" id="addMediaButton"
    data-bs-toggle="modal" data-bs-target="#modalAddMedia"
  >
    <i class="mdi mdi-image-filter-black-white pr-2"></i>
    Add Media
  </button>
  <input type="file" id="imageInput" style="display: none;" accept="image/*">
  {{-- Editor tab --}}
  <div id="full-editor"></div>
</div>
