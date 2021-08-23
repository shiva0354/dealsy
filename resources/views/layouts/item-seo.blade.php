@php
$seo_url = url()->current();
@endphp
<meta name="og:url" content="{{ $seo_url }}">
<meta name="og:description" content="{{ $post->title ?? config('seo.og_description') }}">
<meta property="og:image" content="{{ config('seo.og_image') }}" />
<meta property="og:site_name" content="{{ config('seo.og_sitename') }}" />
<meta property="fb:admins" content="{{ config('seo.fb_admins') }}" />
<meta property="fb:app_id" content="{{ config('seo.fb_app_id') }}" />
<meta property="og:type" content="{{ config('seo.og_type') }}" />
<meta property="og:publisher" content="{{ config('seo.og_publisher') }}" />

<meta name="twitter:title" content="{{ $post->title ?? config('seo.twitter_title') }}">
<meta name="twitter:description" content="{{ $post->title ?? config('seo.twitter_description') }}">
<meta name="twitter:card" content="{{ config('seo.twitter_card') }}" />
<meta name="twitter:site" content="{{ config('seo.twitter_site') }}" />
<meta name="twitter:creator" content="{{ config('seo.twitter_creator') }}" />
<meta name="robots" content="noindex, noimageindex, nofollow, nosnippet">

<meta name="canonical_url" content="{{ $seo_url }}">

<meta name="description" content="{{ $post->title ?? config('seo.meta_description') }}">
<title>{{ $post->title ?? config('seo.meta_title') }}</title>
