<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Graveth Technology',
            'email' => 'gtechnoproject22@gmail.com',
            'password' => bcrypt('Echomike12@#'),
        ]);

        // Dummy Settings
        $settings = [
            'name' => 'John Doe',
            'tagline' => 'Professional Full-Stack Developer',
            'about' => 'I am a highly skilled developer with expertise in building scalable enterprise applications using modern web technologies like Laravel, Vue, and Tailwind CSS. I love turning complex problems into simple, beautiful, and intuitive designs.',
            'contact_email' => 'john.doe@example.com',
            'phone' => '+1 234 567 8900'
        ];

        foreach ($settings as $key => $value) {
            \App\Models\Setting::create(['key' => $key, 'value' => $value]);
        }

        // Dummy Services
        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Building responsive, fast, and scalable web applications tailored to your business needs.',
                'icon' => '<i class="fas fa-laptop-code"></i>',
                'is_active' => true
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Creating seamless mobile experiences for iOS and Android using cross-platform frameworks.',
                'icon' => '<i class="fas fa-mobile-alt"></i>',
                'is_active' => true
            ],
            [
                'title' => 'Enterprise Solutions',
                'description' => 'Architecting robust enterprise systems designed for high performance and security.',
                'icon' => '<i class="fas fa-building"></i>',
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
