<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg mb-3 py-5 w-100 bg-secondary">
        <div class="container">
            <div class="d-flex">
                <div class="navbar-logo display-6 fw-semibold">
                    <a href="#" class="text-black">
                        TJ-SPEAK
                    </a>
                </div>
            </div>
            <div class="d-flex">
                <a href="#" id="#" class="text-black">
                    <span class="icon d-flex align-items-center justify-content-center rounded-0">
                        Link 1
                    </span>
                </a>
                <a href="#" id="#" class="text-black">
                    <span class="icon d-flex align-items-center justify-content-center rounded-0">
                        Link 1
                    </span>
                </a>
                <a href="#" id="#" class="text-black">
                    <span class="icon d-flex align-items-center justify-content-center rounded-0">
                        Link 1
                    </span>
                </a>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@stack('scripts')

</html>