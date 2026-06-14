<div class="h-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 p-6 backdrop-blur-md transition-all duration-300 hover:shadow-xl hover:border-slate-300 dark:hover:border-slate-700 flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800/80">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white font-outfit">Quick Navigation Portal</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Direct access to core panels and administrative resources</p>
            </div>
            <span class="inline-flex items-center rounded-md bg-indigo-50 dark:bg-indigo-500/10 px-2 py-1 text-xs font-medium text-indigo-700 dark:text-indigo-400">
                SSO Active
            </span>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
            <!-- Link 1: Filament Admin -->
            <a href="/admin" class="group flex flex-col justify-between rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/30 p-4 transition-all duration-200 hover:border-indigo-500/20 hover:bg-indigo-50/10 dark:hover:bg-indigo-500/5 hover:-translate-y-0.5">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">Filament Admin</span>
                </div>
                <p class="mt-2 text-xs text-slate-400 leading-normal">Manage student records, grades, class schedules, and system registers.</p>
            </a>

            <!-- Link 2: Statamic Pages -->
            <a href="/cp/collections/pages" class="group flex flex-col justify-between rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/30 p-4 transition-all duration-200 hover:border-violet-500/20 hover:bg-violet-50/10 dark:hover:bg-violet-500/5 hover:-translate-y-0.5">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-100 dark:bg-violet-500/10 text-violet-600 dark:text-violet-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-violet-600 dark:group-hover:text-violet-400 transition-colors">Edit Web Pages</span>
                </div>
                <p class="mt-2 text-xs text-slate-400 leading-normal">Write articles, design collections, and update the marketing pages of the school.</p>
            </a>

            <!-- Link 3: School Homepage -->
            <a href="/" target="_blank" class="group flex flex-col justify-between rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/30 p-4 transition-all duration-200 hover:border-emerald-500/20 hover:bg-emerald-50/10 dark:hover:bg-emerald-500/5 hover:-translate-y-0.5">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">School Site &rarr;</span>
                </div>
                <p class="mt-2 text-xs text-slate-400 leading-normal">Open the public-facing homepage in a new tab to see your published changes live.</p>
            </a>

            <!-- Link 4: CP Users -->
            <a href="/cp/users" class="group flex flex-col justify-between rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/30 p-4 transition-all duration-200 hover:border-amber-500/20 hover:bg-amber-50/10 dark:hover:bg-amber-500/5 hover:-translate-y-0.5">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-100 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">Users & Access</span>
                </div>
                <p class="mt-2 text-xs text-slate-400 leading-normal">Manage administrators, staff roles, permissions, and single sign-on settings.</p>
            </a>
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs text-slate-400">
        <span>Framework version: Laravel 12 &bull; Statamic 6</span>
        <span class="text-indigo-500 dark:text-indigo-400">v1.2.0</span>
    </div>
</div>
