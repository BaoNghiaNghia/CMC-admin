@extends('layouts/layoutMaster')

@php
  $parsedUrl = parse_url(request()->url());
  $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : 'https://';
  $host = $parsedUrl['host'] ?? '';
  $fullHostUrl = $scheme . $host;
@endphp

@section('title', 'Blog - Add New Post')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />

  <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
  <script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
  <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>

  <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>

  <script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/quill-image-drop-module@1.0.3/image-drop.min.js"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/blog-articles.js')}}"></script>
  <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
  <script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/js/ui-toasts.js')}}"></script>

  {{-- <script src="{{asset('assets/js/blog-tags.js')}}"></script> --}}
  {{-- <script src="{{asset('assets/js/forms-tagify.js')}}"></script> --}}

  <script>
    // Full Toolbar
    // --------------------------------------------------------------------
    const fullToolbar = [
      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
      ['blockquote', 'code-block'],

      [{ 'header': 1 }, { 'header': 2 }],               // custom button values
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
      [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
      [{ 'direction': 'rtl' }],                         // text direction

      [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
      [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

      [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
      [{ 'font': [] }],
      [{ 'align': [] }],

      ['link', 'image', 'video'],                       // link and media
      ['clean']                                         // remove formatting button
    ];

    // Store the active editor for each language
    var editors = {};

    const TagPostSelect = document.querySelector('#TagPostSelect');

    var allTagsArr = @json($listTags);

    let TagifyCustomInlineSuggestion = new Tagify(TagPostSelect, {
      whitelist: allTagsArr.map(childTag => childTag.name),
      maxTags: 10,
      dropdown: {
        maxItems: 20,
        classname: 'tags-inline',
        enabled: 0,
        closeOnSelect: false
      }
    });

    // Listen for 'add' and 'remove' tag events
    TagifyCustomInlineSuggestion.on('add', handleSelectedTags);
    TagifyCustomInlineSuggestion.on('remove', handleSelectedTags);

    var listSelectedTags = [];

    // Function to handle selected tags
    function handleSelectedTags(e) {
      var selectedTags = TagifyCustomInlineSuggestion.value; // Get all selected tags

      // Find and return the corresponding childTag object
      var selectedTagObjects = selectedTags.map(tag => allTagsArr.find(childTag => childTag.name === tag.value));
      var arrTagID = selectedTagObjects.map(child=>child.id);

      listSelectedTags = arrTagID;
      return arrTagID;
    }

    // Image handler function to manage image uploads
    function imageHandler() {
      const language = this.quill.root.dataset.language;
      const input = document.getElementById('imageInput_' + language);
      input.click();

      input.onchange = () => {
        const file = input.files[0];
        if (file) {
          const formData = new FormData();
          formData.append('file', file);

          fetch('/forms/upload-single-image', {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
          .then(response => response.json())
          .then(data => {
            try {
              const imageUrl = data.url; // Ensure this is the URL of the uploaded image
              const range = this.quill.getSelection();
              if (range) {
                this.quill.insertEmbed(range.index, 'image', imageUrl);
              } else {
                console.log('No selection to insert image');
              }
            } catch (error) {
              console.error('Error parsing JSON:', error);
            }
          })
          .catch(error => {
            console.log('Error uploading image:', error);
          });
        }
      };
    }

    function showToast(title, message, type = 'info', options = {}) {
      var defaultOptions = {
        maxOpened: 1,
        autoDismiss: true,
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: 'toast-top-right',
        preventDuplicates: true,
        onclick: null,
        rtl: $('html').attr('dir') === 'rtl'
      };

      // Merge user options with default options
      var toastOptions = $.extend({}, defaultOptions, options);

      toastr.options = toastOptions;

      var title = title || 'Thông báo';
      var msg = message || "Don't be pushed around by the fears in your mind.";

      var $toast = toastr[type](msg, title);

      if ($toast && $toast.find('.clear').length) {
        $toast.delegate('.clear', 'click', function () {
          toastr.clear($toast, { force: true });
        });
      }
    }

    function previewContent(index, languageCode) {
        // Get values from the form inputs
        const title = document.getElementById(`post_title_${languageCode}`).value;
        const summary = document.getElementById(`post_summary_${languageCode}`).value;
        // const body = document.getElementById(`full-editor-${languageCode}`).innerHTML;

        const body = editors[languageCode].root.innerHTML;
        console.log('---- preview -----', body);

        if (!title || !body || !summary || body === "<p><br></p>") {
          showToast('Warning', 'Missing input title, content or summary with english', 'warning');
          return;
        }

        // Set values in the modal
        document.getElementById(`previewTitle_${languageCode}`).innerText = title;
        document.getElementById(`previewSummary_${languageCode}`).innerText = summary;
        document.getElementById(`previewBody_${languageCode}`).innerHTML = body;

        // Show the modal
        const previewModal = new bootstrap.Modal(document.getElementById('modalPreviewPost'));
        previewModal.show();
    }

    document.addEventListener('DOMContentLoaded', (event) => {
      // Initialize Quill editors for each language
      @foreach($languages as $language)
      var editorId = 'full-editor-{{ $language["iso_code"] }}';
      var placeholderText = 'Type something in {{ $language["name"] }}...';
      var editor = new Quill('#' + editorId, {
          bounds: '#' + editorId,
          placeholder: placeholderText,
          modules: {
              formula: true,
              toolbar: {
                  container: fullToolbar,
                  handlers: {
                      'image': imageHandler
                  }
              },
              imageResize: {
                  modules: ['Resize', 'DisplaySize', 'Toolbar'],
                  displaySize: true
              },
              imageDrop: true
          },
          theme: 'snow'
      });

      // Store the editor in the editors object
      editors['{{ $language["iso_code"] }}'] = editor;

      // Associate the editor with the language for the image handler
      editor.root.dataset.language = '{{ $language["iso_code"] }}';

      // Add event listener for the language-specific "Add into post" button
      document.getElementById('addIntoPostButton-{{ $language["iso_code"] }}').addEventListener('click', function() {
          // Get all checkboxes that are selected within this modal
          var checkboxes = document.querySelectorAll('#modalAddMedia-{{ $language["iso_code"] }} input[type="checkbox"]:checked');
          var selectedValues = Array.from(checkboxes).map(function(cb) { return cb.value; });

          // Filter out any falsy values
          var filteredImageList = selectedValues.filter(function(cb) { return cb; });

          if (filteredImageList.length > 0) {
              filteredImageList.forEach(function(currentImage) {
                  // Find the corresponding editor
                  var editor = editors['{{ $language["iso_code"] }}'];

                  if (editor) {
                      var range = editor.getSelection();
                      var index = range ? range.index : editor.getLength();
                      editor.insertEmbed(index, 'image', currentImage);
                  }
              });
          }

          // Clear all selected checkboxes
          // checkboxes.forEach(function(checkbox) { checkbox.checked = false; });
          // Clear all selected checkboxes of all languages
          @foreach($languages as $lang)
            var allCheckboxes = document.querySelectorAll('#modalAddMedia-{{ $lang["iso_code"] }} input[type="checkbox"]');
            allCheckboxes.forEach(function(checkbox) { checkbox.checked = false; });
          @endforeach

          // Close the modal
          var modal = document.getElementById('modalAddMedia-{{ $language["iso_code"] }}');
          if (modal) {
              var modalInstance = bootstrap.Modal.getInstance(modal); // Get the instance of the modal
              if (modalInstance) {
                  modalInstance.hide(); // Hide the modal
              }
          }
      });
      @endforeach

      // Register the image resize module
      Quill.register('modules/imageResize', ImageResize);

      // Function to get the selected radio button value
      function getSelectedCategory() {
        // Query the selected radio button within the category section
        var selectedRadio = document.querySelector('input[name="default-radio-category"]:checked');
        // Check if a radio button is selected
        if (selectedRadio) {
          // Return the ID and value of the selected radio button
          return selectedRadio.id;
        } else {
          // Return null if no radio button is selected
          return null;
        }
      }

      // Function to get the selected radio button value
      function getSelectedAuthor() {
        // Query the selected radio button within the category section
        var selectedRadio = document.querySelector('input[name="default-radio-author"]:checked');
        // Check if a radio button is selected
        if (selectedRadio) {
          // Return the ID and value of the selected radio button
          return selectedRadio.id;
        } else {
          // Return null if no radio button is selected
          return null;
        }
      }

      // Add event listener for the "Publish" button
      document.getElementById('publishButton').addEventListener('click', function() {
        var defaultLang = 'en';

        var defaultTitle = document.getElementById('post_title_' + defaultLang).value;
        var defaultSummary = document.getElementById('post_summary_' + defaultLang).value;
        var defaultEditorContentHtml = editors[defaultLang].root.innerHTML;

        if (!defaultTitle || !defaultEditorContentHtml || !defaultSummary) {
          showToast('Warning', 'Missing input title, content or summary with english', 'warning');
          return;
        }

        var selectedCategory = getSelectedCategory();
        if (!selectedCategory) {
          showToast('Warning', 'No category selected', 'warning');
          return;
        }

        var selectedAuthor = getSelectedAuthor();
        if (!selectedAuthor) {
          showToast('Warning', 'No author selected', 'warning');
          return;
        }

        var postData = {
          category_id: selectedCategory,
          author_id: selectedAuthor,
          title: defaultTitle,
          content: defaultEditorContentHtml,
          summary: defaultSummary,
          thumbnail_id: "667fa694815e2336a944b12b",
          tag_ids: listSelectedTags,
          languages: {}
        };

        @foreach($languages as $language)
          var languageCode = '{{ $language["iso_code"] }}';
          var title = document.getElementById('post_title_' + languageCode).value;
          var summary = document.getElementById('post_summary_' + languageCode).value;
          var editorContentHtml = editors[languageCode].root.innerHTML;

          postData.languages[languageCode] = {
              title: title,
              summary: summary,
              content: editorContentHtml
          };
        @endforeach

        var formData = new FormData();
        formData.append('post', JSON.stringify(postData));

        fetch('/forms/publish-multilang-post', {
          method: 'POST',
          body: JSON.stringify(postData),
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.error_code === 0) {
            window.location.href = '/forms/file-upload'; // Redirect to file-upload page

            showToast('Published', `Publish post successfully!. Post title: ${data?.data?.title}`, 'success');
          } else {
            showToast('Something wrong', data?.message, 'error');
          }
          console.log('-- response nè ---', data);
        })
        .catch(error => {
          showToast('Something wrong', error, 'error');
          console.log('Error uploading image:', error);
        });
      });
    });
  </script>
@endsection

@section('content')
<style>
  .scrollable-content {
      max-height: 80%; /* Adjust the height as needed */
      overflow-y: auto;
  }
</style>
<h4 class="">
    <span class="text-muted fw-light">Blog /</span> New Post
</h4>

<div class="row">
  @csrf
  {{-- Editor --}}
  <div class="col-9">
    {{-- Title --}}
    <form id="newsForm">
      @csrf
      {{-- Check if languages are set and available --}}
      @if(isset($languages) && count($languages) > 0)
          {{-- Modal --}}
          @include('content.form-elements.modal-insert-media', ['languages' => $languages])

          @php
            $defaultLanguage = 'en';
            $defaultIndex = 0;
            foreach ($languages as $index => $language) {
              if ($language['iso_code'] == $defaultLanguage) {
                $defaultIndex = $index;
                break;
              }
            }
          @endphp

          {{-- Navigation tabs --}}
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
                              data-bs-target="#tab-content-{{ $index }}"
                              aria-controls="tab-content-{{ $index }}"
                              aria-selected="{{ $index == $defaultIndex ? 'true' : 'false' }}"
                          >
                              <img src="{{ asset($language['flag_path']) }}" alt="{{ $language['name'] }} flag" width="15" height="15" class="mr-1" style="margin-right: 4px;"/>
                              <span>{{ $language['name'] }}</span>
                          </button>
                      </li>
                  @endforeach
              </ul>
          </div>

          {{-- Tab content --}}
          <div class="tab-content p-0">
              @foreach($languages as $index => $language)
                  <div class="tab-pane fade @if($index == $defaultIndex) show active @endif" id="tab-content-{{ $index }}" role="tabpanel">
                      <div class="mt-3">
                          {{-- Title Input --}}
                          <div class="form-floating form-floating-outline mb-2">
                              <input type="text" name="post_title_{{ $language['iso_code'] }}" id="post_title_{{ $language['iso_code'] }}" class="form-control" placeholder="Type something...." />
                              <label for="post_title_{{ $language['iso_code'] }}">Add Title ({{ $language['name'] }})</label>
                              <div class="form-text">
                                  <span style="font-weight: 800">Permalink: </span>
                                  <span>{{ $fullHostUrl }}</span>
                              </div>
                          </div>

                          {{-- Summary Input --}}
                          <div class="form-floating form-floating-outline mb-2">
                              <textarea rows="7" style="height:100%;" type="text" name="post_summary_{{ $language['iso_code'] }}" id="post_summary_{{ $language['iso_code'] }}" class="form-control" placeholder="Type something...."></textarea>
                              <label for="post_summary_{{ $language['iso_code'] }}">Summary ({{ $language['name'] }})</label>
                          </div>

                          {{-- Add Media Button --}}
                          <button
                              class="btn btn-xs btn-label-primary mb-2 mt-4"
                              type="button" id="addMediaButton_{{ $language['iso_code'] }}"
                              data-bs-toggle="modal" data-bs-target="#modalAddMedia-{{ $language['iso_code'] }}"
                          >
                              <i class="mdi mdi-image-filter-black-white pr-2"></i>
                              Add Media
                          </button>
                          <button
                            class="btn btn-xs btn-label-secondary mb-2 mt-4 ml-2"
                            type="button" id="previewPost"
                            {{-- data-bs-toggle="modal" data-bs-target="#modalPreviewPost" --}}
                            onclick="previewContent('{{ $index }}', '{{ $language['iso_code'] }}')"
                          >
                            <i class="mdi mdi-image-filter-black-white pr-2"></i>
                            Preview
                          </button>
                          <input type="file" id="imageInput_{{ $language['iso_code'] }}" style="display: none;" accept="image/*">

                          {{-- Editor Tab --}}
                          <div id="full-editor-{{ $language['iso_code'] }}" class="editor-container"></div>
                      </div>
                  </div>
              @endforeach
          </div>
      @else
          {{-- Message if no languages found --}}
          <p>No languages found</p>
      @endif
    </form>
  </div>

  {{-- Pubish --}}
  <div class="col-3">
    @include('content.form-elements.right-element-editor')
  </div>

  {{-- Modal Preview --}}
  @include('content.form-elements.modal-preview-post', ['languages' => $languages])
</div>
@endsection
