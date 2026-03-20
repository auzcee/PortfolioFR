<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Job;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Get the test user
        $testUser = User::where('email', 'user@portfolio.ph')->first();
        
        if (!$testUser) {
            return;
        }

        // Create demo jobs
        $jobs = [
            [
                'title' => 'Senior Full Stack Developer',
                'company' => 'RemoteBoss',
                'location' => 'Manila, PH',
                'salary' => '₱150,000 - ₱250,000',
                'description' => 'We are looking for an experienced Full Stack Developer to join our team. You will work on our internal tools and client projects.',
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'title' => 'UI/UX Designer',
                'company' => 'TechStart',
                'location' => 'Quezon City, PH',
                'salary' => '₱100,000 - ₱150,000',
                'description' => 'Create amazing user experiences for our mobile and web applications.',
                'status' => 'active',
                'is_featured' => false,
            ],
            [
                'title' => 'Digital Marketing Manager',
                'company' => 'Growth Marketing Co',
                'location' => 'Makati, PH',
                'salary' => '₱120,000 - ₱180,000',
                'description' => 'Lead our digital marketing campaigns and grow our online presence.',
                'status' => 'active',
                'is_featured' => false,
            ],
        ];

        foreach ($jobs as $jobData) {
            Job::create($jobData);
        }

        $jobs = Job::where('status', 'active')->get();

        // Create demo applications
        foreach ($jobs->take(2) as $job) {
            Application::create([
                'user_id' => $testUser->id,
                'job_id' => $job->id,
                'status' => 'applied',
                'cover_letter' => 'I am very interested in this position as it aligns with my skills and career goals.',
            ]);
        }

        // Create demo portfolio
        Portfolio::create([
            'user_id' => $testUser->id,
            'title' => 'My Amazing Portfolio',
            'description' => 'Showcase of my best projects and work experience',
            'status' => 'pending',
            'skills' => 'Laravel, React, Vue, PHP, JavaScript',
        ]);
    }
}
