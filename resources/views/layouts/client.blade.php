<!-- Book Summary -->
<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Book Summary - Wellness Reads</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#DA70D6",
                        "secondary": "#40B5AD",
                        "tertiary": "#F8E9CA",
                        "background-light": "#f8f6f8",
                        "background-dark": "#1f131f",
                        "surface-dark": "#2d242d",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.375rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }
    </style>
    @yield('headers')
      <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>

</head>
@yield('content')
@yield('scripts')
@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            confirmButtonColor: '#16a34a'
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            confirmButtonColor: '#dc2626'
        });
    </script>
@endif

@if (session()->has('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "{{ session('warning') }}",
            confirmButtonColor: '#f59e0b'
        });
    </script>
@endif

@if (session()->has('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: "{{ session('info') }}",
            confirmButtonColor: '#2563eb'
        });
    </script>
@endif

<script>
    $(document).ready(function() {
    $('.add-to-cart-btn').on('click', function(e) {
        e.preventDefault();

        let button = $(this);
        let id = button.data('id');
        let type = button.data('type');
        
        // Optional: Change button state to show loading
        let originalText = button.html();
        button.prop('disabled', true).html('<span class="animate-spin">⏳</span> Adding...');

        $.ajax({
            url: "{{ url('/cart/add') }}", // The route we defined earlier
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}", // Required for Laravel security
                id: id,
                type: type
            },
            success: function(response) {
                // 1. Reset button
                button.prop('disabled', false).html(originalText);

                // 2. Optional: Show a toast/alert (Using a simple alert or custom UI)
                alert(type.charAt(0).toUpperCase() + type.slice(1) + " added to cart successfully!");

                // 3. Update the cart count in the header dynamically
                updateCartCount();
            },
            error: function(xhr) {
                button.prop('disabled', false).html(originalText);
                console.error("Error adding to cart:", xhr.responseText);
                alert("Something went wrong. Please try again.");
            }
        });
    });

    // Function to update the number on the cart icon without refreshing
    function updateCartCount() {
        // You can either refresh the page or create a small endpoint 
        // that returns the current cart count. 
        // For now, a simple page reload is the most reliable:
        window.location.reload(); 
    }
});
</script>

</html>