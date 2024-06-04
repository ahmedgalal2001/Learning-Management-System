<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserEnrollmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */ use RefreshDatabase;

    public function test_user_can_enroll_in_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('course.enrollCourse', ['id' => $course->id]));

        $response->assertStatus(302);
        $this->assertDatabaseHas('enrollments', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }
}
