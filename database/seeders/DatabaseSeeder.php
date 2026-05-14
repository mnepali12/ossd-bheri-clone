<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Admin', 'description' => 'Administrator']);
        $staffRole = Role::create(['name' => 'Staff', 'description' => 'Staff Member']);
        $studentRole = Role::create(['name' => 'Student', 'description' => 'Student']);
        $guestRole = Role::create(['name' => 'Guest', 'description' => 'Guest User']);

        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@ossd.com',
            'password' => Hash::make('password123'),
            'phone' => '9841234567',
            'address' => 'Kathmandu, Nepal',
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        // Create staff user
        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@ossd.com',
            'password' => Hash::make('password123'),
            'phone' => '9842345678',
            'address' => 'Kathmandu, Nepal',
            'role_id' => $staffRole->id,
            'is_active' => true,
        ]);

        // Create student users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Student $i",
                'email' => "student{$i}@ossd.com",
                'password' => Hash::make('password123'),
                'phone' => '984' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'address' => 'Kathmandu, Nepal',
                'role_id' => $studentRole->id,
                'is_active' => true,
            ]);
        }

        // Create sample announcements
        $admin = User::where('email', 'admin@ossd.com')->first();
        for ($i = 1; $i <= 5; $i++) {
            Announcement::create([
                'title' => "Important Announcement $i",
                'content' => "This is announcement content number $i. Please read carefully.",
                'category' => 'General',
                'is_featured' => $i === 1,
                'is_published' => true,
                'published_at' => now()->subDays($i),
                'created_by' => $admin->id,
            ]);
        }

        // Create sample events
        for ($i = 1; $i <= 4; $i++) {
            Event::create([
                'title' => "Academic Event $i",
                'description' => "This is event number $i",
                'event_date' => now()->addDays($i * 5),
                'location' => 'School Campus',
                'category' => 'Academic',
                'is_published' => true,
            ]);
        }
    }
}
