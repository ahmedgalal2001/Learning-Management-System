<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(6);
        return view('courses.index', ['courses' => $courses]);
    }

    /*
    * Show All Courses for User
    * */

    public function allCourses(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255'
        ]);
        $search = $validatedData['search'] ?? '';
        $type  = $validatedData['type'] ?? 'title';
        $courses = Course::where($type, 'like', '%' . $search . '%')->paginate(6);
        $courses_enrolled_ids = Auth::user()->courses()->get()->pluck('id');
        return view('courses.allcourses', ['courses' => $courses, 'courses_enrolled_ids' => $courses_enrolled_ids]);
    }

    /**
     * Display my courses resource.
     * */
    public function myCourses()
    {
        $user = Auth::user();
        $enrolledCourses = $user->courses()->paginate(5);
        return view('courses.enroll_courses', ['courses' => $enrolledCourses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);
        try {
            $course = new Course();
            $course->title = $validator['title'];
            $course->description = $validator['description'];
            $course->save();
            return redirect()->route('course.index')->with('success', 'Course added successfully.');;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    /*
    * Enroll Course
    */
    public function enrollCourse(string $id)
    {
        try {
            $user = Auth::user();
            $user->courses()->attach($id);
            return back()->with('success', 'Course enrolled successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /*
    * Unenroll Course
    */
    public function unenrollCourse(string $id)
    {
        try {
            $user = Auth::user();
            $user->courses()->detach($id);
            return back()->with('success', 'Course unenrolled successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404, "Course not found");
        }
        return view('courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        try {
            $course = Course::find($id);
            $course->update($request->all());
            return redirect()->route('course.index')
                ->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $course = Course::find($id);
            $course->delete();
            return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
