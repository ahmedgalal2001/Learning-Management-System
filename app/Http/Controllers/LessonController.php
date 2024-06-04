<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404, "Course not found");
        }
        $lessons = $course->lessons()->paginate(5);
        return view('lessons.index', ['course' => $course, 'lessons' => $lessons]);
    }

    /**
     * Show My Lessons
     *
     */
    public function myLessons(string $id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404, "Course not found");
        }
        $lessons = $course->lessons()->paginate(5);
        return view('lessons.myLessons', ['lessons' => $lessons]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id = null)
    {
        $courses = Course::all();
        return view('lessons.create', ['courses' => $courses, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'course_id' => ['required', 'numeric'],
        ]);
        try {
            $lesson = new Lesson();
            $lesson->title = $validator['title'];
            $lesson->description = $validator['description'];
            $lesson->course_id = $validator['course_id'];
            $lesson->save();
            return redirect()->route('lesson.index', ['id' => $validator['course_id']])->with('success', 'Lesson created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            abort(404, "Lesson not found");
        }
        return view('lessons.edit', ['lesson' => $lesson, 'courses' => Course::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'course_id' => ['required', 'numeric'],
        ]);
        $lesson = Lesson::find($id);
        if (!$lesson) {
            abort(404, "Lesson not found");
        }
        try {
            $lesson->title = $validator['title'];
            $lesson->description = $validator['description'];
            $lesson->course_id = $validator['course_id'];
            $lesson->save();
            return redirect()->route('lesson.index', ['id' => $validator['course_id']])->with('success', 'Lesson updated successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            abort(404, "Lesson not found");
        }
        $lesson->delete();
        return redirect()->route('lesson.index', ['id' => $lesson->course_id])->with('success', 'Lesson deleted successfully');
    }
}
