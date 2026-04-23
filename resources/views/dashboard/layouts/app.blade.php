<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | StockSystem.</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
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

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const button = e.target.closest('button[onclick="toggleProfileDropdown()"]');

            if (!button && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
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
