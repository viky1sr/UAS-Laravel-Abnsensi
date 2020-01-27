<main class="py-4">
    <div class="container">
        @if (session('success'))
            <div  class="toast" role="alert" aria-live="assertive" aria-atomic="true"  data-delay='2000'>
                <div  class="toast-body bg-success text-white font-weight-bold">
                    {{session('success')}}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true"  data-delay='2000'>
                <div class="toast-body bg-danger text-white font-weight-bold">
                    {{session('error')}}
                </div>
            </div>
        @endif
        @yield('content')
    </div>
</main>
