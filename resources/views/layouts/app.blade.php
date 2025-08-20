<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/>
    <title>{{ config('seo.title')  }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="{{ config('seo.description') }}"/>
    <meta name="author" content="{{ config('seo.author')  }}"/>
    <link rel="canonical" href="{{ config('seo.canonical') }}"/>

    <script type="application/ld+json">@json(config('seo.schema'))</script>

@foreach(config('seo.opengraph') as $property => $content)
    <meta property="og:{{$property}}" content="{{ is_callable($content) ? $content() : $content  }}"/>
@endforeach

@foreach(config('seo.twitter') as $property => $content)
    <meta property="twitter:{{$property}}" content="{{ is_callable($content) ? $content() : $content  }}"/>
@endforeach

@foreach(config('seo.icons') as $icon)
    <link {!! collect($icon)->map(fn($value, $key) => $key . '="'.( is_callable($value) ? $value() : $value ).'"')->join(' ') !!} />
@endforeach

@foreach(config('seo.meta') as $property => $content)
    <meta property="{{$property}}" content="{{$content}}"/>
@endforeach

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&family=Mozilla+Headline:wght@200..700&display=swap"
        rel="stylesheet">

    @vite(["resources/js/app.js", "resources/css/app.css"])
</head>
<body class="min-h-screen overflow-auto">
@yield("content")
</body>
</html>
