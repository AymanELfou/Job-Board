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
 * Test suite for all Admin-protected routes.
 * Admin uses the 'role:admin' middleware check.
 */
class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    // ─── helpers ──────────────────────────────────────────────────────────────

    private function adminUser(): User
    {
        return User::factory()->admin()->create();
    }

    // ─── Dashboard ────────────────────────────────────────────────────────────

    /** @test */
    public function test_admin_can_access_dashboard(): void
    {
        $response = $this->actingAs($this->adminUser())->get('/dashboard');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function test_non_admin_cannot_access_dashboard(): void
    {
        $jobseeker = User::factory()->jobseeker()->create();
        $this->actingAs($jobseeker)->get('/dashboard')->assertStatus(403);
    }

    // ─── Jobs ─────────────────────────────────────────────────────────────────

    /** @test */
    public function test_admin_can_list_all_jobs(): void
    {
        Job::factory()->count(2)->create();
        $response = $this->actingAs($this->adminUser())->get('/jobs');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_admin_can_search_jobs(): void
    {
        $response = $this->actingAs($this->adminUser())
            ->get('/jobs/search?keyword=developer');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_admin_can_delete_a_job(): void
    {
        $job = Job::factory()->create();
        $response = $this->actingAs($this->adminUser())
            ->delete("/jobs/{$job->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('jobs', ['id' => $job->id]);
    }

    // ─── Jobseekers ───────────────────────────────────────────────────────────

    /** @test */
    public function test_admin_can_list_all_jobseekers(): void
    {
        $response = $this->actingAs($this->adminUser())->get('/jobseekers');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_admin_can_search_jobseekers(): void
    {
        $response = $this->actingAs($this->adminUser())
            ->get('/jobseekers/search?keyword=john');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_admin_can_delete_a_jobseeker(): void
    {
        $profil = ProfilJobseeker::factory()->create();
        $response = $this->actingAs($this->adminUser())
            ->delete("/jobseekers/{$profil->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('profil_jobseekers', ['id' => $profil->id]);
    }

    // ─── Employers ────────────────────────────────────────────────────────────

    /** @test */
    public function test_admin_can_list_all_employers(): void
    {
        $response = $this->actingAs($this->adminUser())->get('/employers');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_admin_can_delete_an_employer(): void
    {
        $employer = ProfilEmployer::factory()->create();
        $response = $this->actingAs($this->adminUser())
            ->delete("/employers/{$employer->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('profil_employers', ['id' => $employer->id]);
    }

    // ─── Applications ─────────────────────────────────────────────────────────

    /** @test */
    public function test_admin_can_list_all_applications(): void
    {
        $response = $this->actingAs($this->adminUser())->get('/applications');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_admin_can_delete_an_application(): void
    {
        $jobseeker = ProfilJobseeker::factory()->create();
        $job       = Job::factory()->create();
        $application = Application::factory()->create([
            'id_jobseeker' => $jobseeker->id,
            'id_job'       => $job->id,
        ]);

        $response = $this->actingAs($this->adminUser())
            ->delete("/applications/{$application->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('applications', ['id' => $application->id]);
    }

    /** @test */
    public function test_admin_can_update_application_status(): void
    {
        $jobseeker = ProfilJobseeker::factory()->create();
        $job       = Job::factory()->create();
        $application = Application::factory()->create([
            'id_jobseeker' => $jobseeker->id,
            'id_job'       => $job->id,
            'status'       => 'pending',
        ]);

        // Route: PUT /application/{application}/status (named: updateStatus)
        $response = $this->actingAs($this->adminUser())
            ->put("/application/{$application->id}/status", ['status' => 'accepted']);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'id'     => $application->id,
            'status' => 'accepted',
        ]);
    }

}
