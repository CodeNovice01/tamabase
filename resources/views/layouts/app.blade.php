<!DOCTYPE html>
<html lang="en">

<head>
    <!-- PWA manifest -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1e40af">

    <!-- iOS向け -->
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(() => console.log('✅ Service worker registered!'))
                .catch(err => console.error('SW registration failed:', err));
        }
    </script>

</head>

<body>
    <h1>Hello Livewire</h1>
    <div>@yield('content')</div>
</body>

</html>
