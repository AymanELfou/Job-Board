<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilJobseeker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Feature tests for Job Seeker application management.
 */
class JobseekerApplicationTest extends TestCase
{
    use RefreshDatabase;

    private function makeJobseeker(): User
    {
        $profil = ProfilJobseeker::factory()->create();
        return User::factory()->jobseeker()->create(['profile_id' => $profil->id]);
    }

    /** @test */
    public function test_jobseeker_can_list_own_applications(): void
    {
        $user = $this->makeJobseeker();
        $this->actingAs($user)->get('/jobseeker/applications')->assertStatus(200);
    }

    /** @test */
    public function test_guest_cannot_list_applications(): void
    {
        $this->get('/jobseeker/applications')->assertRedirect('/login');
    }

    /** @test */
    public function test_jobseeker_can_view_a_specific_application(): void
    {
        $user = $this->makeJobseeker();
        $job  = Job::factory()->create();
        $application = Application::factory()->create([
            'id_jobseeker' => $user->profile->id,
            'id_job'       => $job->id,
        ]);

        $this->actingAs($user)
            ->get("/jobseeker/applications/{$application->id}")
            ->assertStatus(200);
    }

    /** @test */
    public function test_jobseeker_can_delete_own_application(): void
    {
        $user = $this->makeJobseeker();
        $job  = Job::factory()->create();
        $application = Application::factory()->create([
            'id_jobseeker' => $user->profile->id,
            'id_job'       => $job->id,
        ]);

        $response = $this->actingAs($user)
            ->delete("/jobseeker/applications/{$application->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('applications', ['id' => $application->id]);
    }
}
