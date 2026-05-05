<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name'        => 'Web Development',
                'description' => 'Full-stack web development solutions tailored to your business needs.',
            ],
            [
                'name'        => 'Mobile Apps',
                'description' => 'iOS and Android mobile application development.',
            ],
            [
                'name'        => 'AI/ML Solutions',
                'description' => 'Artificial intelligence and machine learning solutions for modern businesses.',
            ],
            [
                'name'        => 'Blockchain',
                'description' => 'Blockchain development and decentralized application solutions.',
            ],
            [
                'name'        => 'Cloud Services',
                'description' => 'Cloud infrastructure setup, management, and optimization.',
            ],
            [
                'name'        => 'UI/UX Design',
                'description' => 'User interface and user experience design for web and mobile.',
            ],
            [
                'name'        => 'Staff Augmentation',
                'description' => 'Extend your team with skilled developers and professionals.',
            ],
        ];
        foreach($services as $service ){
            Service::create([
                'id'=>Str::uuid(),
                'name' => $service['name'],
                'description' => $service['description']
            ]);
        }
    }
}
