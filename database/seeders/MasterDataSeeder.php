<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skills
        $skills = [
            ['name' => 'PHP', 'category' => 'IT'],
            ['name' => 'Laravel', 'category' => 'IT'],
            ['name' => 'React', 'category' => 'IT'],
            ['name' => 'HTML/CSS', 'category' => 'IT'],
            ['name' => 'JavaScript', 'category' => 'IT'],
            ['name' => 'Java', 'category' => 'IT'],
            ['name' => 'Python', 'category' => 'IT'],
            ['name' => 'SQL', 'category' => 'IT'],
            ['name' => 'Communication', 'category' => 'Soft Skills'],
            ['name' => 'Teamwork', 'category' => 'Soft Skills'],
            ['name' => 'Project Management', 'category' => 'Management'],
            ['name' => 'Sales', 'category' => 'Business'],
            ['name' => 'Marketing', 'category' => 'Business'],
            ['name' => 'Accounting', 'category' => 'Finance'],
        ];

        foreach ($skills as $skill) {
            \App\Models\Skill::firstOrCreate(['name' => $skill['name']], $skill);
        }

        // Education
        $courses = [
            ['name' => 'B.Tech', 'type' => 'Degree'],
            ['name' => 'M.Tech', 'type' => 'Degree'],
            ['name' => 'BCA', 'type' => 'Degree'],
            ['name' => 'MCA', 'type' => 'Degree'],
            ['name' => 'B.Sc', 'type' => 'Degree'],
            ['name' => 'M.Sc', 'type' => 'Degree'],
            ['name' => 'MBA', 'type' => 'Degree'],
            ['name' => 'BBA', 'type' => 'Degree'],
            ['name' => 'Diploma in Engineering', 'type' => 'Diploma'],
            ['name' => 'Certification in Digital Marketing', 'type' => 'Certification'],
        ];

        foreach ($courses as $course) {
            \App\Models\EducationCourse::firstOrCreate(['name' => $course['name']], $course);
        }
    }
}
