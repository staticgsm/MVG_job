<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\EducationCourse;

class MasterDataController extends Controller
{
    public function index()
    {
        $skills = Skill::latest()->paginate(10, ['*'], 'skills_page');
        $courses = EducationCourse::latest()->paginate(10, ['*'], 'courses_page');
        return view('admin.master_data.index', compact('skills', 'courses'));
    }

    public function storeSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:skills,name',
            'category' => 'nullable|string'
        ]);

        Skill::create($request->except('_token'));

        return redirect()->back()->with('success', 'Skill added successfully.');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return redirect()->back()->with('success', 'Skill deleted successfully.');
    }

    public function storeEducation(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:education_courses,name',
            'type' => 'nullable|string'
        ]);

        EducationCourse::create($request->except('_token'));

        return redirect()->back()->with('success', 'Education course added successfully.');
    }

    public function destroyEducation(EducationCourse $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Education course deleted successfully.');
    }
}
