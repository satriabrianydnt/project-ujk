<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ $appName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border-color: #D1D5DB !important;
            border-radius: 0.75rem !important;
            height: 42px !important;
            background-color: #F9FAFB !important;

        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px !important;
            padding-left: 12px !important;
            color: #111827 !important;
            font-size: 0.875rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }

        .select2-dropdown {
            border-radius: 0.75rem !important;
            border-color: #E5E7EB !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-900">
    @include('sweetalert::alert')

    <div class="flex h-screen overflow-hidden">

        @include('dashboard.partials.sidebar')

        <div class="flex flex-col flex-1 w-full overflow-hidden">

            @include('dashboard.partials.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-6">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleProfileDropdown(event) {
            if (event) {
                event.stopPropagation();
            }

            const dropdown = document.getElementById('profileDropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const button = document.getElementById('profileMenuButton');

            if (dropdown && button) {
                if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            }
        });

        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            const modalContent = document.getElementById(modalID + 'Content');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    if (modalContent) {
                        modalContent.classList.remove('scale-95');
                        modalContent.classList.add('scale-100');
                    }
                }, 10);
            } else {
                modal.classList.add('opacity-0');
                if (modalContent) {
                    modalContent.classList.remove('scale-100');
                    modalContent.classList.add('scale-95');
                }
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }
    </script>
    @stack('scripts')
</body>

</html>
