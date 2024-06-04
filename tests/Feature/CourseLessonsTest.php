<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseLessonsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_user_can_see_lessons_in_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->create(['course_id' => $course->id]);

        $this->actingAs($user);

        $response = $this->get(route('lesson.index', ['id' => $course->id]));

        $response->assertStatus(200);
        $response->assertSeeText($lesson->title);
    }
}
