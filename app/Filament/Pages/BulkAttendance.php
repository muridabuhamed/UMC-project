<?php

namespace App\Filament\Pages;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Attendance;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;

class BulkAttendance extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-check-badge';
    protected static \UnitEnum|string|null $navigationGroup = 'Academic';
    protected string $view = 'filament.pages.bulk-attendance';

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'teacher']);
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'date' => now()->toDateString(),
        ]);
    }

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->schema([
                Section::make('Step 1: Select Course & Date')
                    ->columns(2)
                    ->schema([
                        Select::make('course_id')
                            ->label('Course')
                            ->options(function () {
                                $query = Course::query();
                                if (auth()->user()->isTeacher()) {
                                    $query->where('teacher_id', auth()->user()->teacher?->id);
                                }
                                return $query->pluck('name', 'id');
                            })
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn ($state, $set) => $this->loadStudents($state, $set)),
                        DatePicker::make('date')
                            ->default(now())
                            ->required(),
                    ]),

                Section::make('Step 2: Mark Attendance')
                    ->schema([
                        Repeater::make('students')
                            ->schema([
                                TextInput::make('student_name')
                                    ->label('Student')
                                    ->disabled()
                                    ->dehydrated(false),
                                Hidden::make('enrollment_id')
                                    ->required(),
                                ToggleButtons::make('status')
                                    ->options([
                                        'present' => 'Present',
                                        'absent' => 'Absent',
                                        'late' => 'Late',
                                        'excused' => 'Excused',
                                    ])
                                    ->colors([
                                        'present' => 'success',
                                        'absent' => 'danger',
                                        'late' => 'warning',
                                        'excused' => 'info',
                                    ])
                                    ->icons([
                                        'present' => 'heroicon-o-check-circle',
                                        'absent' => 'heroicon-o-x-circle',
                                        'late' => 'heroicon-o-clock',
                                        'excused' => 'heroicon-o-envelope',
                                    ])
                                    ->inline()
                                    ->default('present')
                                    ->required(),
                            ])
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->columns(2)
                    ])->visible(fn ($get) => $get('course_id')),
            ])
            ->statePath('data');
    }

    protected function loadStudents($courseId, $set): void
    {
        if (! $courseId) {
            $set('students', []);
            return;
        }

        $enrollments = Enrollment::where('course_id', $courseId)
            ->with('student')
            ->get();

        $studentsData = $enrollments->map(function ($enrollment) {
            return [
                'enrollment_id' => $enrollment->id,
                'student_name' => $enrollment->student?->name ?? 'Unknown',
                'status' => 'present',
            ];
        })->toArray();

        $set('students', $studentsData);
    }

    public function saveAction(): Action
    {
        return Action::make('save')
            ->label('Save Attendance')
            ->action(fn () => $this->save())
            ->color('success')
            ->size('xl');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (!isset($data['students']) || !is_array($data['students'])) {
            return;
        }

        foreach ($data['students'] as $studentData) {
            if (!isset($studentData['enrollment_id'])) {
                continue;
            }

            Attendance::updateOrCreate(
                [
                    'enrollment_id' => $studentData['enrollment_id'],
                    'date' => $data['date'],
                ],
                [
                    'status' => $studentData['status'],
                ]
            );
        }

        Notification::make()
            ->title('Attendance saved successfully')
            ->success()
            ->send();

        $this->form->fill([
            'date' => $data['date'],
        ]);
    }
}
