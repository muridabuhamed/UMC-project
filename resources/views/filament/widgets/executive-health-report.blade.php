<x-filament-widgets::widget>
    <style>
        .ai-exec-container {
            font-family: 'Outfit', sans-serif;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .ai-exec-header-bar {
            background: #f8fafc;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
        }
        .ai-exec-title-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .ai-exec-icon-box {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 6px;
            border-radius: 8px;
            color: white;
        }
        .ai-exec-main-title {
            font-size: 14px;
            font-weight: 800;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .ai-exec-report-body {
            padding: 24px;
            max-height: 500px;
            overflow-y: auto;
        }
        .ai-memo-header {
            border-left: 4px solid #6366f1;
            padding-left: 16px;
            margin-bottom: 24px;
            background: #f1f5f9;
            padding: 16px;
            border-radius: 0 12px 12px 0;
        }
        .ai-memo-header p {
            margin: 2px 0;
            font-size: 13px;
            color: #475569;
        }
        .ai-memo-header strong {
            color: #1e293b;
            width: 60px;
            display: inline-block;
        }
        .ai-report-content {
            font-size: 14px;
            line-height: 1.6;
            color: #334155;
        }
        .ai-report-content h1, .ai-report-content h2, .ai-report-content h3 {
            color: #1e293b;
            font-weight: 800;
            margin-top: 24px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 4px;
        }
        .ai-report-content ul {
            list-style: none;
            padding: 0;
        }
        .ai-report-content li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 8px;
        }
        .ai-report-content li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: #6366f1;
            font-weight: bold;
        }
        .ai-exec-footer {
            background: #f8fafc;
            padding: 10px 20px;
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #e2e8f0;
        }
        .ai-refresh-pill {
            background: white;
            border: 1px solid #cbd5e1;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
        }
        .ai-refresh-pill:hover {
            border-color: #6366f1;
            color: #6366f1;
        }
    </style>

    <div class="ai-exec-container">
        <div class="ai-exec-header-bar">
            <div class="ai-exec-title-group">
                <div class="ai-exec-icon-box">
                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <span class="ai-exec-main-title">Executive Briefing</span>
            </div>
            <button wire:click="generateReport" class="ai-refresh-pill" wire:loading.attr="disabled">
                <span wire:loading.remove>Update Analysis</span>
                <span wire:loading>Processing...</span>
            </button>
        </div>

        <div class="ai-exec-report-body">
            @if($report)
                <div class="ai-memo-header">
                    <p><strong>TO:</strong> School Administration</p>
                    <p><strong>FROM:</strong> Senior Educational AI Analyst</p>
                    <p><strong>DATE:</strong> {{ now()->format('F d, Y') }}</p>
                    <p><strong>SUBJ:</strong> Institutional Performance & Strategic Outlook</p>
                </div>
                <div class="ai-report-content">
                    {!! \Illuminate\Support\Str::markdown($report) !!}
                </div>
            @else
                <div style="text-align: center; padding: 40px 0;">
                    <div style="width: 48px; height: 48px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                        <svg style="width: 24px; height: 24px; color: #94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <p style="font-size: 13px; font-weight: 700; color: #64748b;">No active briefing generated.</p>
                    <button wire:click="generateReport" style="margin-top: 12px; font-size: 12px; color: #6366f1; font-weight: 700; background: none; border: none; cursor: pointer; text-decoration: underline;">Analyze School Pulse Now</button>
                </div>
            @endif
        </div>

        <div class="ai-exec-footer">
            <span>CONFIDENTIAL - INTERNAL ONLY</span>
            <span>UMC INTELLIGENCE v1.3</span>
        </div>
    </div>
</x-filament-widgets::widget>
