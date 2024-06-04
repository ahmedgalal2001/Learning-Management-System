<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserEnrollmentsListTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_user_can_see_enrolled_courses()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $user->courses()->attach($course->id);

        $this->actingAs($user);

        $response = $this->get(route('course.mycourses'));

        $response->assertStatus(200);
        $response->assertSeeText($course->title);
    }
}
