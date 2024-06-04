<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_admin_can_create_course()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $response = $this->post(route('course.store'), [
            'title' => 'Test Course',
            'description' => 'Course description',
        ]);

        $response->assertStatus(302); // Assuming redirection after creation
        $this->assertDatabaseHas('courses', [
            'title' => 'Test Course',
        ]);
    }

    public function test_non_admin_cannot_create_course()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('course.store'), [
            'title' => 'Test Course',
            'description' => 'Course description',
        ]);

        $response->assertStatus(403); // Forbidden
    }
}
