<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Bill Splitter')
    </title>

    <meta charset='utf-8'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
    <link href='css/styles.css' rel='stylesheet'>
    <meta charset='utf-8'>

    @stack('head')

</head>
<body>

    <header>
    </header>

    <section>
        @yield('content')
    </section>

    @stack('body')
</body>
</html>
