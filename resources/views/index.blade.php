<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'ZOHO Crm'}}</title>
        @include('components.head.css')
    </head>
    <body class="container">
        <header>
            
        </header>
        <main class="pt-5 pb-5">
            <article>
                <h1>Zoho CRM</h1>
                <div class="row">
                    <div class="col-12 col-md-6">
                        @include('contacts.add')
                    </div>
                    <div class="col-12 col-md-6">
                        @include('deals.add')
                    </div>
                </div>
            </article>
        </main>
        <footer>

        </footer>
        @include('components.footer.js')
    </body>
</html>
