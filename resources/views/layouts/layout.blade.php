<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'UMC School Manager' }}</title>
    
    <!-- Google Fonts: Outfit & Instrument Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-full flex-col font-sans antialiased selection:bg-indigo-500/30">
    <!-- Sleek Navigation Header -->
    <header class="sticky top-0 z-40 border-b border-slate-800 bg-slate-950/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between p-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <!-- Decorative Icon -->
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 shadow-lg shadow-indigo-500/20">
                    <span class="font-outfit text-lg font-bold text-white">U</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-outfit text-lg font-semibold tracking-tight text-white">UMC</span>
                    <span class="text-xs text-slate-400">School Manager</span>
                </div>
            </div>
            
            <nav class="flex items-center gap-6">
                @foreach (Statamic::tag('nav:mored') as $item)
                    @if (empty($item['children']))
                        <a href="{{ $item['url'] }}" class="text-sm font-medium text-slate-300 hover:text-white transition">
                            {{ $item['title'] }}
                        </a>
                    @else
                        <!-- Dropdown Menu for Child Items -->
                        <div class="relative group">
                            <button class="flex items-center gap-1 text-sm font-medium text-slate-300 hover:text-white transition focus:outline-none cursor-pointer">
                                <span>{{ $item['title'] }}</span>
                                <svg class="h-4 w-4 transition duration-150 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu Container (Hover Triggered) -->
                            <div class="absolute left-0 mt-2 w-48 rounded-xl bg-slate-900 border border-slate-800 p-2 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ $child['url'] }}" class="block px-4 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-indigo-600 rounded-lg transition">
                                        {{ $child['title'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                <a href="#" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-indigo-600/15 hover:bg-indigo-500 transition">Apply Now</a>
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Sleek Footer -->
    <footer class="border-t border-slate-800 bg-slate-900/40 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} UMC School Manager. All rights reserved.</p>
            <div class="flex gap-4 text-xs text-slate-400">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <span>&middot;</span>
                <a href="#" class="hover:underline">Contact Us</a>
                <span>&middot;</span>
                <a href="#" class="hover:underline">Admissions</a>
            </div>
        </div>
    </footer>
</body>
</html>
