<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'web']);
        
        $permissions = [
            'ViewAny:Student', 'View:Student',
            'ViewAny:Attendance', 'View:Attendance', 'Create:Attendance', 'Update:Attendance',
            'View:BulkAttendance',
            'ViewAny:Grade', 'View:Grade', 'Create:Grade', 'Update:Grade',
            'ViewAny:Course', 'View:Course',
            'ViewAny:Schedule', 'View:Schedule',
            'View:WeeklyScheduleWidget'
        ];

        $teacher->syncPermissions($permissions);
    }
}
