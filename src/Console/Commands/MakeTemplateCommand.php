<?php

namespace Texuscode\Ui\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeTemplateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'texus:make-template';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Folder and Files in resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Folders
        $layouts = resource_path('views/layouts');
        $pages = resource_path('views/pages');
        $partials = resource_path('views/partials');
        $includes = resource_path('views/includes');

        if (!File::exists($pages)) {
            File::makeDirectory($pages, 755, true);
            $this->info('Folder created: ' . $pages);
        }
        if (!File::exists($partials)) {
            File::makeDirectory($partials, 755, true);
            $this->info('Folder created: ' . $partials);
        }
        if (!File::exists($layouts)) {
            File::makeDirectory($layouts, 755, true);
            $this->info('Folder created: ' . $layouts);
        }
        if (!File::exists($includes)) {
            File::makeDirectory($includes, 755, true);
            $this->info('Folder created: ' . $includes);
        }

        //Files
        $app = $layouts . '/app.blade.php';
        $styles = $layouts . '/styles.blade.php';
        $scripts = $layouts . '/scripts.blade.php';
        $vite = $layouts . '/vite.blade.php';
        $favicon = $layouts . '/favicon.blade.php';
        $seo = $layouts . '/seo.blade.php';
        $home = $pages . '/home.blade.php';

        if (!File::exists($app)) {
            File::put($app, $this->getApp());
            $this->info('File created: ' . $app);
        }
        if (!File::exists($vite)) {
            File::put($vite, $this->getVite());
            $this->info('File created: ' . $vite);
        }
        if (!File::exists($favicon)) {
            File::put($favicon, $this->getFavicon());
            $this->info('File created: ' . $favicon);
        }
        if (!File::exists($styles)) {
            File::put($styles, '');
            $this->info('File created: ' . $styles);
        }
        if (!File::exists($scripts)) {
            File::put($scripts, '');
            $this->info('File created: ' . $scripts);
        }
        if (!File::exists($seo)) {
            File::put($seo, $this->getSeo());
            $this->info('File created: ' . $seo);
        }
        if (!File::exists($home)) {
            File::put($home, $this->getHome());
            $this->info('File created: ' . $home);
        }
    }
    private function getApp()
    {
        return <<<'BLADE'
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? "Texus UI" }}</title>
    @include('layouts.favicon')
    @include('layouts.styles')
    @include('layouts.vite')
    @include('layouts.seo')
    @yield('styles')
</head>

<body>
    <header>
        @yield('header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @yield('footer')
    </footer>
    @yield('scripts')
    @include('layouts.scripts')
</body>

</html>
BLADE;
    }
    private function getVite()
    {
        return <<<'BLADE'
            @vite('resources/css/app.css')
            @vite('resources/js/app.js')
        BLADE;
    }
    private function getFavicon()
    {
        return <<<'BLADE'
        <link rel="icon" type="image/png" sizes="32x32" href="">
        BLADE;
    }
    private function getSeo()
    {
        return <<<'BLADE'
        <meta property="og:type" content="website">
        <meta property="og:title" content="">
        <meta property="og:description" content="">
        <meta property="og:image" content="">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="">
        BLADE;
    }
    private function getHome()
    {
        return <<<'BLADE'
        @extends('layouts.app')
        @section('content')
            {{-- Your contents here --}}
        @endsection
        BLADE;
    }
}
