<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('student_number')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('year')
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('department')
                    ->relationship('department', 'name'),
            ])
            ->headerActions([
                \Filament\Actions\ExportAction::make()
                    ->exporter(\App\Filament\Exports\StudentExporter::class),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('log_contact')
                    ->label('Log Contact')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->form([
                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            \Filament\Forms\Components\DateTimePicker::make('contact_date')
                                ->default(now())
                                ->required(),
                            \Filament\Forms\Components\Select::make('contact_type')
                                ->options([
                                    'Call' => 'Phone Call',
                                    'Email' => 'Email',
                                    'Meeting' => 'In-Person Meeting',
                                    'Message' => 'WhatsApp/SMS',
                                ])
                                ->required(),
                        ]),
                        \Filament\Forms\Components\TextInput::make('subject')
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('notes')
                            ->rows(3),
                        \Filament\Forms\Components\Select::make('mood')
                            ->options([
                                'positive' => '🟢 Positive',
                                'neutral' => '🟡 Neutral',
                                'negative' => '🔴 Negative',
                            ])
                            ->default('neutral')
                            ->required(),
                    ])
                    ->action(function ($record, $data) {
                        \App\Models\CommunicationLog::create([
                            'student_id' => $record->id,
                            'user_id' => auth()->id(),
                            'contact_date' => $data['contact_date'],
                            'contact_type' => $data['contact_type'],
                            'subject' => $data['subject'],
                            'notes' => $data['notes'],
                            'mood' => $data['mood'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Contact Logged')
                            ->success()
                            ->send();
                    }),
                \Filament\Actions\Action::make('ai_pathway')
                    ->label('AI Pathway')
                    ->icon('heroicon-o-academic-cap')
                    ->color('info')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $grades = $record->grades()->with('enrollment.course')->get();
                        $allCourses = \App\Models\Course::with('department')->get();
                        
                        $context = "STUDENT DATA:\nName: {$record->name}\nAcademic Record: " . $grades->map(fn($g) => "{$g->enrollment->course->name}: {$g->score}%")->join(', ') . "\n\nAVAILABLE COURSES:\n" . $allCourses->map(fn($c) => "- {$c->name}")->join("\n");
                        
                        $prompt = "Provide a CONCISE summary using 3 bullet points: Learning Style, 2 Recommended Electives, and 1 Support Strategy. Use Markdown.";

                        try {
                            $result = \Gemini\Laravel\Facades\Gemini::generativeModel('gemini-flash-latest')->generateContent($prompt . "\n\n" . $context);
                            $record->update(['recommendations' => $result->text()]);
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Pathway Generated')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Failed')->danger()->send();
                        }
                    }),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
