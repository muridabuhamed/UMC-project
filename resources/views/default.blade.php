@extends('layouts.layout')

@section('content')
<div class="relative overflow-hidden bg-slate-950 text-slate-100 pb-20 lg:pb-32">
    <!-- Glowing Accent Circles -->
    <div class="absolute -top-40 -left-40 h-[600px] w-[600px] rounded-full bg-indigo-500/10 blur-[120px] pointer-events-none"></div>
    <div class="absolute top-1/3 right-0 h-[500px] w-[500px] rounded-full bg-violet-500/5 blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 h-[600px] w-[600px] rounded-full bg-blue-500/5 blur-[150px] pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <!-- Hero Section -->
        <div class="relative pt-12 pb-20 text-center lg:pt-20">
            <div class="mx-auto max-w-3xl">
                <!-- Status Tag -->
                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/5 px-3.5 py-1.5 text-xs text-indigo-400 font-medium">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-indigo-500"></span>
                    </span>
                    Enrollment Academic Year 2026/2027 Open
                </div>
                
                <h1 class="mt-8 font-outfit text-5xl font-extrabold tracking-tight sm:text-7xl text-white leading-none">
                    Empowering Minds,<br>
                    <span class="bg-gradient-to-r from-indigo-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                        Shaping Futures
                    </span>
                </h1>
                
                <p class="mt-6 text-lg leading-relaxed text-slate-400 max-w-2xl mx-auto font-sans">
                    Welcome to UMC School Manager. A state-of-the-art educational facility dedicated to academic excellence, digital learning, and personal growth.
                </p>

                <div class="mt-10 flex flex-wrap justify-center gap-4">
                    <a href="#departments" class="rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 hover:bg-indigo-500 hover:-translate-y-0.5 transition duration-200">
                        Explore Departments
                    </a>
                    <a href="#about" class="rounded-xl border border-slate-700 bg-slate-900/55 px-6 py-3.5 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-900 hover:border-slate-600 hover:-translate-y-0.5 transition duration-200">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Statamic CMS Dynamically Managed Block -->
        @if(!empty($content) || !empty($title))
        <div class="relative my-16">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-violet-500/5 rounded-3xl blur-md"></div>
            <div class="relative rounded-3xl border border-slate-800 bg-slate-900/40 p-8 md:p-12 backdrop-blur-sm">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-4">
                        <span class="text-xs font-bold text-indigo-400 uppercase tracking-widest">Featured Spotlight</span>
                        <h2 class="mt-2 text-3xl font-extrabold text-white font-outfit leading-tight">
                            {{ $title ?? 'Welcome Message' }}
                        </h2>
                        <div class="mt-4 h-1 w-12 bg-indigo-500 rounded-full"></div>
                    </div>
                    <div class="lg:col-span-8 text-slate-300 leading-relaxed font-sans prose prose-invert max-w-none">
                        @if(!empty($content))
                            {!! $content !!}
                        @else
                            <p class="italic text-slate-500">Log into the Statamic Control Panel to author and display dynamic announcements or introductory messages here.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Academic Features Grid -->
        <div class="mt-20">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl font-bold font-outfit text-white">Our Educational Ecosystem</h2>
                <p class="text-sm text-slate-400 mt-2">Engineered to support digital learning workflows and top-tier administration</p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1: Digital Portal -->
                <div class="group relative rounded-2xl border border-slate-800 bg-slate-900/30 p-8 backdrop-blur-sm transition-all duration-300 hover:border-slate-700 hover:bg-slate-900/60 hover:-translate-y-1">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-400 transition-colors group-hover:bg-indigo-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="mt-6 font-outfit text-xl font-bold text-white">Modern Curriculum</h3>
                    <p class="mt-3 text-sm text-slate-400 leading-relaxed">Structured learning plans leveraging state-of-the-art software systems, science labs, and physical resources.</p>
                </div>

                <!-- Feature 2: Attendance Tracking -->
                <div class="group relative rounded-2xl border border-slate-800 bg-slate-900/30 p-8 backdrop-blur-sm transition-all duration-300 hover:border-slate-700 hover:bg-slate-900/60 hover:-translate-y-1">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-500/10 text-violet-400 transition-colors group-hover:bg-violet-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 font-outfit text-xl font-bold text-white">Interactive Portals</h3>
                    <p class="mt-3 text-sm text-slate-400 leading-relaxed">Students and parents can log in to view real-time attendances, communication logs, schedules, and scores.</p>
                </div>

                <!-- Feature 3: Academic Reports -->
                <div class="group relative rounded-2xl border border-slate-800 bg-slate-900/30 p-8 backdrop-blur-sm transition-all duration-300 hover:border-slate-700 hover:bg-slate-900/60 hover:-translate-y-1">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400 transition-colors group-hover:bg-emerald-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 font-outfit text-xl font-bold text-white">Verified Analytics</h3>
                    <p class="mt-3 text-sm text-slate-400 leading-relaxed">Real-time grading system with dynamic statistics outputs that ensure students are monitored for high-level success.</p>
                </div>
            </div>
        </div>

        <!-- Academic Departments Showcase -->
        <div class="mt-28">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold font-outfit text-white">Academic Departments</h2>
                    <p class="text-sm text-slate-400 mt-2">Top tier education pathways specialized in global growth areas</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="text-xs text-slate-500">Current Academic Departments: <strong class="text-indigo-400">{{ \App\Models\Department::count() }}</strong></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Dept 1 -->
                <div class="group border border-slate-800 bg-slate-900/20 hover:border-indigo-500/20 p-6 rounded-2xl flex items-center justify-between transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 bg-indigo-500/10 text-indigo-400 flex items-center justify-center rounded-xl font-bold font-outfit">ST</div>
                        <div>
                            <h4 class="text-base font-bold text-white font-outfit">Science & Technology</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Computer Science, Mathematics, Physics, Chemistry</p>
                        </div>
                    </div>
                    <span class="text-xs text-indigo-400 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Explore &rarr;</span>
                </div>

                <!-- Dept 2 -->
                <div class="group border border-slate-800 bg-slate-900/20 hover:border-violet-500/20 p-6 rounded-2xl flex items-center justify-between transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 bg-violet-500/10 text-violet-400 flex items-center justify-center rounded-xl font-bold font-outfit">LA</div>
                        <div>
                            <h4 class="text-base font-bold text-white font-outfit">Liberal Arts & Humanities</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Literature, History, Sociology, Languages</p>
                        </div>
                    </div>
                    <span class="text-xs text-violet-400 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Explore &rarr;</span>
                </div>

                <!-- Dept 3 -->
                <div class="group border border-slate-800 bg-slate-900/20 hover:border-emerald-500/20 p-6 rounded-2xl flex items-center justify-between transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 bg-emerald-500/10 text-emerald-400 flex items-center justify-center rounded-xl font-bold font-outfit">BM</div>
                        <div>
                            <h4 class="text-base font-bold text-white font-outfit">Business Management</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Economics, Finance, Entrepreneurship, Accounting</p>
                        </div>
                    </div>
                    <span class="text-xs text-emerald-400 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Explore &rarr;</span>
                </div>

                <!-- Dept 4 -->
                <div class="group border border-slate-800 bg-slate-900/20 hover:border-amber-500/20 p-6 rounded-2xl flex items-center justify-between transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 bg-amber-500/10 text-amber-400 flex items-center justify-center rounded-xl font-bold font-outfit">FA</div>
                        <div>
                            <h4 class="text-base font-bold text-white font-outfit">Fine Arts & Design</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Visual Arts, Digital Design, Music, Performance</p>
                        </div>
                    </div>
                    <span class="text-xs text-amber-400 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Explore &rarr;</span>
                </div>
            </div>
        </div>

        <!-- Institutional statistics dynamic summaries banner -->
        <div class="mt-28 relative rounded-3xl bg-gradient-to-r from-indigo-950 via-slate-900 to-violet-950 border border-indigo-900/30 p-8 md:p-12 overflow-hidden">
            <div class="absolute -right-20 -bottom-20 h-60 w-60 rounded-full bg-indigo-500/10 blur-[80px]"></div>
            <div class="relative grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <span class="block text-4xl font-extrabold text-white font-outfit">{{ \App\Models\Student::count() }}</span>
                    <span class="block text-xs text-slate-400 mt-1 uppercase tracking-wider font-semibold">Students</span>
                </div>
                <div>
                    <span class="block text-4xl font-extrabold text-white font-outfit">{{ \App\Models\Teacher::count() }}</span>
                    <span class="block text-xs text-slate-400 mt-1 uppercase tracking-wider font-semibold">Educators</span>
                </div>
                <div>
                    <span class="block text-4xl font-extrabold text-white font-outfit">{{ \App\Models\Course::count() }}</span>
                    <span class="block text-xs text-slate-400 mt-1 uppercase tracking-wider font-semibold">Courses</span>
                </div>
                <div>
                    <span class="block text-4xl font-extrabold text-white font-outfit">{{ \App\Models\Department::count() }}</span>
                    <span class="block text-xs text-slate-400 mt-1 uppercase tracking-wider font-semibold">Departments</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
