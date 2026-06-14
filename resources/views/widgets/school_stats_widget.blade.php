<div class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Card 1: Students -->
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-indigo-500/5 hover:border-indigo-500/30 dark:hover:border-indigo-500/30">
        <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-indigo-500/10 dark:bg-indigo-500/5 blur-xl transition-all duration-300 group-hover:scale-150"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold tracking-wider text-slate-500 dark:text-slate-400 uppercase">Total Students</p>
                <h3 class="mt-2 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $studentsCount }}</h3>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 shadow-inner">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-xs text-indigo-600 dark:text-indigo-400">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
            Active Enrolled Students
        </div>
    </div>

    <!-- Card 2: Teachers -->
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-violet-500/5 hover:border-violet-500/30 dark:hover:border-violet-500/30">
        <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-violet-500/10 dark:bg-violet-500/5 blur-xl transition-all duration-300 group-hover:scale-150"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold tracking-wider text-slate-500 dark:text-slate-400 uppercase">Active Faculty</p>
                <h3 class="mt-2 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $teachersCount }}</h3>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 dark:bg-violet-500/10 text-violet-600 dark:text-violet-400 shadow-inner">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-xs text-violet-600 dark:text-violet-400">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-violet-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-violet-500"></span>
            </span>
            Professional Educators
        </div>
    </div>

    <!-- Card 3: Courses -->
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-500/5 hover:border-emerald-500/30 dark:hover:border-emerald-500/30">
        <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-emerald-500/10 dark:bg-emerald-500/5 blur-xl transition-all duration-300 group-hover:scale-150"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold tracking-wider text-slate-500 dark:text-slate-400 uppercase">Total Courses</p>
                <h3 class="mt-2 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $coursesCount }}</h3>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 shadow-inner">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-xs text-emerald-600 dark:text-emerald-400">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            Available Academic Courses
        </div>
    </div>

    <!-- Card 4: Departments -->
    <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-500/5 hover:border-amber-500/30 dark:hover:border-amber-500/30">
        <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-amber-500/10 dark:bg-amber-500/5 blur-xl transition-all duration-300 group-hover:scale-150"></div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold tracking-wider text-slate-500 dark:text-slate-400 uppercase">Departments</p>
                <h3 class="mt-2 text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $departmentsCount }}</h3>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 shadow-inner">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1.5 text-xs text-amber-600 dark:text-amber-400">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
            </span>
            School Departments
        </div>
    </div>
</div>
