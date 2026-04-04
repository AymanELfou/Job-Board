<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilEmployer;
use App\Models\ProfilJobseeker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Feature tests for Employer application management.
 */
class EmployerApplicationTest extends TestCase
{
    use RefreshDatabase;

    private function makeEmployer(): User
    {
        $profil = ProfilEmployer::factory()->create();
        return User::factory()->employer()->create(['profile_id' => $profil->id]);
    }

    private function makeApplication(User $employer): Application
    {
        $seekerProfil = ProfilJobseeker::factory()->create();
        $job          = Job::factory()->create(['id_employeur' => $employer->profile->id]);
        return Application::factory()->create([
            'id_job'       => $job->id,
            'id_jobseeker' => $seekerProfil->id,
            'status'       => 'pending',
        ]);
    }

    /** @test */
    public function test_employer_can_list_applications(): void
    {
        $user = $this->makeEmployer();
        $this->actingAs($user)->get('/employer/applications')->assertStatus(200);
    }

    /** @test */
    public function test_employer_can_view_an_application(): void
    {
        $user        = $this->makeEmployer();
        $application = $this->makeApplication($user);

        $this->actingAs($user)
            ->get("/employer/applications/{$application->id}")
            ->assertStatus(200);
    }

    /** @test */
    public function test_employer_can_delete_an_application(): void
    {
        $user        = $this->makeEmployer();
        $application = $this->makeApplication($user);

        $response = $this->actingAs($user)
            ->delete("/employer/applications/{$application->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('applications', ['id' => $application->id]);
    }

    /** @test */
    public function test_employer_can_update_application_status_to_accepted(): void
    {
        $user        = $this->makeEmployer();
        $application = $this->makeApplication($user);

        $response = $this->actingAs($user)
            ->put("/applications/{$application->id}/status", ['status' => 'accepted']);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'id'     => $application->id,
            'status' => 'accepted',
        ]);
    }

    /** @test */
    public function test_employer_can_update_application_status_to_rejected(): void
    {
        $user        = $this->makeEmployer();
        $application = $this->makeApplication($user);

        $response = $this->actingAs($user)
            ->put("/applications/{$application->id}/status", ['status' => 'rejected']);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'id'     => $application->id,
            'status' => 'rejected',
        ]);
    }
}
