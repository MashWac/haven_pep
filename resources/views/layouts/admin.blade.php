<!DOCTYPE html>

<html class="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Admin: Add Books</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Noto+Sans:wght@400;500;700&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
      <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#f8e8c9",
            "background-light": "#f8f7f6",
            "background-dark": "#211c11",
          },
          fontFamily: {
            "display": ["Manrope"]
          },
          borderRadius: {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
          },
        },
      },
    }
  </script>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#171511] font-display overflow-hidden">
  <div class="flex h-screen w-full">
    <!-- Sidebar -->
    <aside class="flex w-64 flex-col bg-white dark:bg-[#1a160e] border-r border-[#e5e2dc] dark:border-[#362f22] h-full overflow-y-auto shrink-0 z-10 hidden md:flex">
      <div class="flex flex-col h-full justify-between p-4">
        <div class="flex flex-col gap-4">
          <div class="flex gap-3 items-center mb-6 px-2">
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Abstract wellness logo with soft gradients" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBXnDqPDjRc4zgEWm3ooskMsxiAn92iMWMJSiKvfJO0NuMOVo2gRWa4WnMcKQWIF8HfBdK7csA9M0AWSilxOS9R4OKvn1ec_gHDWcs8Be8P1zd8hdV3EUocJBLqnGLZoHyUiBWS0utkHo-EcFzY4iiYLY32K3twT37uCofyhIwgc0zBSI8HbbjiZVzF-WtQzG3DUph3xepHIMolTaYForkmS3e9RKJNQ-K2leC4q3DPhdTg6JHq5KcoMF15o3t7zjhbAm0Fgbr3qNU");'></div>
            <div class="flex flex-col">
              <h1 class="text-[#171511] dark:text-white text-base font-bold leading-normal">Admin Panel</h1>
              <p class="text-[#877b64] text-xs font-normal leading-normal">Wellness Platform</p>
            </div>
          </div>
          <div class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-background-light dark:hover:bg-[#2c261a] transition-colors group" href="{{url('/admin_dashboard')}}">
              <span class="material-symbols-outlined text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white">dashboard</span>
              <p class="text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white text-sm font-medium leading-normal">Dashboard</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-background-light dark:hover:bg-[#2c261a] transition-colors group" href="{{url('/admin_sales')}}">
              <span class="material-symbols-outlined text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white">money_bag</span>
              <p class="text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white text-sm font-medium leading-normal">Sales</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-background-light dark:hover:bg-[#2c261a] transition-colors group" href="{{url('/admin_profile')}}">
              <span class="material-symbols-outlined text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white">person</span>
              <p class="text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white text-sm font-medium leading-normal">My Profile</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary" href="{{url('/admin_books')}}">
              <span class="material-symbols-outlined text-[#171511]">book_2</span>
              <p class="text-[#171511] text-sm font-medium leading-normal">Books</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary" href="{{url('/admin_courses')}}">
              <span class="material-symbols-outlined text-[#171511]">book</span>
              <p class="text-[#171511] text-sm font-medium leading-normal">Courses</p>
            </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary" href="{{url('/admin_authors')}}">
              <span class="material-symbols-outlined text-[#171511]">article_person</span>
              <p class="text-[#171511] text-sm font-medium leading-normal">Authors</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-background-light dark:hover:bg-[#2c261a] transition-colors group" href="{{url('/admin_users')}}">
              <span class="material-symbols-outlined text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white">group</span>
              <p class="text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white text-sm font-medium leading-normal">Users</p>
            </a>

            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-background-light dark:hover:bg-[#2c261a] transition-colors group" href="{{url('/admin_settings')}}">
              <span class="material-symbols-outlined text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white">settings</span>
              <p class="text-[#877b64] group-hover:text-[#171511] dark:group-hover:text-white text-sm font-medium leading-normal">Settings</p>
            </a>
          </div>
        </div>
        <div class="flex items-center gap-3 px-3 py-2 mt-auto cursor-pointer hover:bg-background-light dark:hover:bg-[#2c261a] rounded-lg">
          <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" data-alt="Admin user profile picture" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuApNg4zpd2tBtCUjN-D4mH7Vy6jzxQxFuesrUt0V5k6hQWDJw3ccoiRd3aTGepJdwFM6qlsiWzmr5iXnzRv12aetWafrn44mGGWetdp2RM9wNHNjWN5dsz4HY6T7fIdzr6V5kNTOKJZHKH0NqsnZJtFFPmsQoBZNZWmUirTyifogfklrHwejfjRi97tNlhRtqA4d3aGCGAO6mJcNVp7vHiEk8mY9q81KEn0LSvu1Vs5q2Zss2m0jix0njh6hqvyajUsVOXscCFvlpg");'></div>
          <div class="flex flex-col">
            <p class="text-[#171511] dark:text-white text-sm font-medium">Jane Admin</p>
            <p class="text-[#877b64] text-xs">Sign out</p>
          </div>
        </div>
      </div>
    </aside>
    <!-- Main Content -->
    @yield('content')
  </div>
  @yield('scripts')
  <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.adminTables').DataTable({
        "pagingType": "full_numbers",
        "paging": true,
        "lengthMenu": [10, 25, 50, 75, 100]
      });
    });
  </script>
  <script src="https://cdn.tiny.cloud/1/kssr4fuqfumvhklu1ppthrz6l42rwe99sw91ntfumeihua3h/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '.text_area_admin',
      skin: "oxide-dark",
      content_css: "dark",
      plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
      menubar: 'file edit view insert format tools table help',
      toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
      toolbar_sticky: true,
      autosave_ask_before_unload: true,
      autosave_interval: '30s',
      autosave_prefix: '{path}{query}-{id}-',
      autosave_restore_when_empty: false,
      autosave_retention: '2m',
      image_advtab: true,
      link_list: [{
          title: 'My page 1',
          value: 'https://www.codexworld.com'
        },
        {
          title: 'My page 2',
          value: 'http://www.codexqa.com'
        }
      ],
      image_list: [{
          title: 'My page 1',
          value: 'https://www.codexworld.com'
        },
        {
          title: 'My page 2',
          value: 'http://www.codexqa.com'
        }
      ],
      image_class_list: [{
          title: 'None',
          value: ''
        },
        {
          title: 'Some class',
          value: 'class-name'
        }
      ],
      importcss_append: true,
      file_picker_callback: (callback, value, meta) => {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
          callback('https://www.google.com/logos/google.jpg', {
            text: 'My text'
          });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
          callback('https://www.google.com/logos/google.jpg', {
            alt: 'My alt text'
          });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
          callback('movie.mp4', {
            source2: 'alt.ogg',
            poster: 'https://www.google.com/logos/google.jpg'
          });
        }
      },
      templates: [{
          title: 'New Table',
          description: 'creates a new table',
          content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
        },
        {
          title: 'Starting my story',
          description: 'A cure for writers block',
          content: 'Once upon a time...'
        },
        {
          title: 'New list with dates',
          description: 'New List with dates',
          content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
        }
      ],
      template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
      template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
      height: 400,
      image_caption: true,
      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
      noneditable_class: 'mceNonEditable',
      toolbar_mode: 'sliding',
      contextmenu: 'link image table',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
  </script>
  <script>
    $('.show_confirm').click(function(event) {
      var form = $(this).closest("form");
      event.preventDefault();
      Swal.fire({
          title: `Are you sure you want to delete this record?`,
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((isConfirm) => {
          if (isConfirm) {
            form.submit();
          }
        });
    });
  </script>
  <script>
    const fileInput1 = document.getElementById('dropzone-file');
    const previewWrapper = document.getElementById('image-preview-wrapper');
    const previewImage = document.getElementById('image-preview');
    const currentImage = document.getElementById('current-image');

    fileInput1.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;

      // Validate image
      if (!file.type.startsWith('image/')) {
        alert('Please select a valid image file.');
        fileInput.value = '';
        return;
      }

      const reader = new FileReader();

      reader.onload = function(event) {
        previewImage.src = event.target.result;
        previewWrapper.classList.remove('hidden');

        // Hide current image if exists
        if (currentImage) {
          currentImage.classList.add('hidden');
        }
      };

      reader.readAsDataURL(file);
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.select_multiple_options').select2({
        placeholder: "e.g. Jane Doe",
        allowClear: true,
        width: '100%'
      });
    });
  </script>

</body>

</html>