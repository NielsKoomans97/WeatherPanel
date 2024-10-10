<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $documentTitle }}</title>
    <script src="js/app.js" type="module" defer></script>
    <link rel="stylesheet" href="/font/bootstrap-icons.min.css">

    @vite('resources\sass\_app.scss')
</head>

<body>
    <header>
        <img class="banner" src="/assets/img/banner.jpg">
        <svg class="header-cutout">
            <clipPath id="curve" clipPathUnits="objectBoundingBox">
                <path d="M 0 0 H 1 v 1 C 0.7 1 0.5 0.5 0 0.4 V 0"></path>
            </clipPath>
        </svg>
        <x-nav />
    </header>
