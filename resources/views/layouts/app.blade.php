<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/>
    <title>{{ config('seo.title')  }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="{{ config('seo.description') }}"/>
    <meta name="author" content="{{ config('seo.author')  }}"/>
    <link rel="canonical" href="{{ request()->fullUrl() }}"/>

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

    <link rel="preconnect" href="https://cdn.fontlint.com">
    <link href="https://cdn.fontlint.com/wizardcompass/mozilla-headline.css" rel="stylesheet">
    <link href="https://cdn.fontlint.com/wizardcompass/inter.css" rel="stylesheet">

        <script defer data-domain="wizardcompass.com"
                src="https://plausible.io/js/script.file-downloads.hash.outbound-links.tagged-events.js"></script>
    @vite(["resources/js/app.js", "resources/css/app.css"])
</head>
<body class="min-h-screen overflow-auto">
@yield("content")
</body>
</html>
