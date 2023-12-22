<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/common.css">
    @yield('css')

    <style>
        body {
            height: 100vh;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content__left">
            <p class="header__title">
                Atte
            </p>
        </div>
        @yield('header')
    </header>

    <main class="main">
        @yield('main')
    </main>

    <footer class="footer">
        <small class="copyright">Atte,inc.</small>
    </footer>
</body>
</html>