<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
</head>

<body>
    <section class="parent">
        <!-- Navbar -->
        @include('layouts.navbar')
        <main class="body">
            <!-- Sidebar -->
            @include('layouts.sidebar')
            <!-- Content -->
            @include('layouts.content')
        </main>
        <!-- Footer -->
        @include('layouts.footer')
    </section>
</body>

</html>
