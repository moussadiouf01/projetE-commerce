<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">Admin E-commerce</a>
            @auth('admin')
            <div class="position-relative">
                <a href="{{ route('admin.notifications') }}" class="btn position-relative">
                    <span class="fs-4">🔔</span>
                    @php $count = auth('admin')->user()->unreadNotifications()->count(); @endphp
                    @if($count > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $count }}
                        </span>
                    @endif
                </a>
            </div>
            @endauth
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html> 