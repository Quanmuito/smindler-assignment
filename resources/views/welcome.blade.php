<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Smindler Assignment</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="container">
    <br />
    <h1>Job assignment</h1>
    <br />

    <h2>Assignment</h2>
    <ol id="l1">
        <li>
            <p>
                Create a simple dockerized Laravel app (e.g.
                <a href="https://laravel.com/docs/11.x/installation#docker-installation-using-sail" target="_blank">
                    https://laravel.com/docs/11.x/installation#docker-installation-using-sail
                </a>)
            </p>
        </li>
        <li>
            <p>The application should run with: <b>docker compose up -d</b>.</p>
        </li>
        <li>
            <p>Push the final project to a public GitHub repository.</p>
        </li>
    </ol>
    <br />

    <h2>Requirements</h2>
    <ol>
        <li>
            <p>Endpoint that receives an order payload detailed below.</p>
        </li>
        <li>
            <p>Request is validated and the order is saved to database.</p>
        </li>
        <li>
            <p>
                If there is a subscription included in the basket, this item needs to be sent to a very slow third party
                endpoint:
                <a href="https://very-slow-api.com/orders" target="_blank">https://very-slow-api.com/orders</a> and
                needs
                to be async.
            </p>
        </li>
    </ol>
    <br />

    <h2>Incoming payload</h2>
    <pre style="background-color: rgb(230, 230, 230)"><code>
    {
        "first_name": "Alan",
        "last_name": "Turing",
        "address": "123 Enigma Ave, Bletchley Park, UK",
        "basket": [
            {
                "name": "Smindle ElePHPant plushie",
                "type": "unit",
                "price": 295.45
            },
            {
                "name": "Syntax & Chill",
                "type": "subscription",
                "price": 175.00
            }
        ]
    }
    </code></pre>
    <br />

    <h2>Third party endpoint expected payload format</h2>
    <pre style="background-color: rgb(230, 230, 230)"><code>
    {
        "ProductName": string,
        "Price": float,
        "Timestamp": datetime
    }
    </code></pre>
    <br />

    <footer class="text-center">
        <p>QuanMuiTo@2025</p>
        <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </footer>
</body>

</html>
