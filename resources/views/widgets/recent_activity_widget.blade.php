<div x-data="{ tab: 'logs' }" class="h-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/60 p-6 backdrop-blur-md transition-all duration-300 hover:shadow-xl hover:border-slate-300 dark:hover:border-slate-700 flex flex-col justify-between">
    <div>
        <!-- Widget Header -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800/80">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white font-outfit">Recent Activity</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Real-time updates from school registry and logs</p>
            </div>
            
            <!-- Beautiful Tab Toggle Switch -->
            <div class="flex rounded-lg bg-slate-100 dark:bg-slate-950/50 p-1">
                <button @click="tab = 'logs'" :class="tab === 'logs' ? 'bg-white dark:bg-slate-800 text-indigo-600 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'" class="rounded-md px-3 py-1.5 text-xs font-semibold transition-all">
                    Logs ({{ $recentLogs->count() }})
                </button>
                <button @click="tab = 'payments'" :class="tab === 'payments' ? 'bg-white dark:bg-slate-800 text-indigo-600 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'" class="rounded-md px-3 py-1.5 text-xs font-semibold transition-all ml-1">
                    Payments ({{ $recentPayments->count() }})
                </button>
            </div>
        </div>

        <!-- Tab 1: Logs -->
        <div x-show="tab === 'logs'" class="mt-4 space-y-3">
            @forelse($recentLogs as $log)
                <div class="flex items-start gap-3 rounded-xl border border-slate-100 dark:border-slate-800/50 bg-slate-50/40 dark:bg-slate-950/20 p-3 hover:bg-slate-50 dark:hover:bg-slate-950/30 transition-all duration-200">
                    <!-- Icon based on contact type -->
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400">
                        @if(strtolower($log->contact_type) === 'email')
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        @elseif(strtolower($log->contact_type) === 'call')
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        @else
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">{{ $log->student?->name ?? 'Unknown Student' }}</span>
                            <span class="text-[10px] text-slate-400 shrink-0">
                                {{ $log->contact_date ? \Carbon\Carbon::parse($log->contact_date)->diffForHumans() : $log->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-300 mt-0.5 truncate">{{ $log->subject }}</p>
                        <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5 line-clamp-1 leading-normal">{{ $log->notes }}</p>
                    </div>

                    <!-- Mood Badge -->
                    <div class="shrink-0 text-sm" title="Student Mood: {{ ucfirst($log->mood ?? 'neutral') }}">
                        @if(strtolower($log->mood) === 'happy' || strtolower($log->mood) === 'good')
                            😊
                        @elseif(strtolower($log->mood) === 'sad' || strtolower($log->mood) === 'bad')
                            😢
                        @elseif(strtolower($log->mood) === 'concerned' || strtolower($log->mood) === 'stressed')
                            😟
                        @else
                            😐
                        @endif
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <div class="rounded-full bg-slate-50 dark:bg-slate-950 p-3 text-slate-400 mb-2">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500">No recent communication logs</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">Logs will appear here once recorded in the admin portal.</p>
                </div>
            @endforelse
        </div>

        <!-- Tab 2: Payments -->
        <div x-show="tab === 'payments'" class="mt-4 space-y-3" style="display: none;">
            @forelse($recentPayments as $payment)
                <div class="flex items-center gap-3 rounded-xl border border-slate-100 dark:border-slate-800/50 bg-slate-50/40 dark:bg-slate-950/20 p-3 hover:bg-slate-50 dark:hover:bg-slate-950/30 transition-all duration-200">
                    <!-- Icon based on status -->
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">{{ $payment->student?->name ?? 'Unknown Student' }}</span>
                            <span class="text-[10px] text-slate-400 shrink-0">
                                {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->diffForHumans() : $payment->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400 font-mono">${{ number_format($payment->amount, 2) }}</span>
                            <span class="text-[10px] text-slate-400">• {{ strtoupper($payment->payment_method ?? 'Unknown') }}</span>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="shrink-0">
                        @if(strtolower($payment->status) === 'paid' || strtolower($payment->status) === 'completed' || strtolower($payment->status) === 'success')
                            <span class="inline-flex items-center rounded-full bg-emerald-50 dark:bg-emerald-500/10 px-1.5 py-0.5 text-[10px] font-medium text-emerald-700 dark:text-emerald-400">Paid</span>
                        @elseif(strtolower($payment->status) === 'pending')
                            <span class="inline-flex items-center rounded-full bg-amber-50 dark:bg-amber-500/10 px-1.5 py-0.5 text-[10px] font-medium text-amber-700 dark:text-amber-400">Pending</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-rose-50 dark:bg-rose-500/10 px-1.5 py-0.5 text-[10px] font-medium text-rose-700 dark:text-rose-400">{{ ucfirst($payment->status ?? 'Failed') }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <div class="rounded-full bg-slate-50 dark:bg-slate-950 p-3 text-slate-400 mb-2">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500">No recent payments recorded</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">Payments will appear here once registered in Filament.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-[10px] text-slate-400">
        <span>Updates in real-time</span>
        <a href="/admin/communication-logs" class="hover:underline text-indigo-500 dark:text-indigo-400 font-semibold flex items-center gap-0.5">
            Go to Filament Logs &rarr;
        </a>
    </div>
</div>
