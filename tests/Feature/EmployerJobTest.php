<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\ProfilEmployer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Feature tests for Employer job management routes.
 */
class EmployerJobTest extends TestCase
{
    use RefreshDatabase;

    // ─── helpers ──────────────────────────────────────────────────────────────

    /** Create an employer user wired to a ProfilEmployer record. */
    private function makeEmployer(): User
    {
        $profil  = ProfilEmployer::factory()->create();
        $user    = User::factory()->employer()->create(['profile_id' => $profil->id]);
        return $user;
    }

    // ─── Dashboard ────────────────────────────────────────────────────────────

    /** @test */
    public function test_employer_can_access_dashboard(): void
    {
        $user = $this->makeEmployer();
        $this->actingAs($user)->get('/employer/dashboard')->assertStatus(200);
    }

    /** @test */
    public function test_guest_cannot_access_employer_dashboard(): void
    {
        $this->get('/employer/dashboard')->assertRedirect('/login');
    }

    // ─── Jobs CRUD ────────────────────────────────────────────────────────────

    /** @test */
    public function test_employer_can_list_own_jobs(): void
    {
        $user = $this->makeEmployer();
        Job::factory()->count(2)->create(['id_employeur' => $user->profile->id]);

        $this->actingAs($user)->get('/employer/jobs')->assertStatus(200);
    }

    /** @test */
    public function test_employer_can_view_create_job_page(): void
    {
        $user = $this->makeEmployer();
        $this->actingAs($user)->get('/employer/jobs/create')->assertStatus(200);
    }

    /** @test */
    public function test_employer_can_create_a_job(): void
    {
        $user = $this->makeEmployer();

        $response = $this->actingAs($user)->post('/employer/jobs', [
            'titre'            => 'Laravel Developer',
            'description'      => 'Build amazing things with Laravel.',
            'location'         => 'Paris',
            'job_type'         => 'Full-time',
            'categorie'        => 'IT',
            'salaire'          => 5000,
            'type_contrat'     => 'CDI',
            'date_publication' => '2026-04-01',
        ]);

        $response->assertRedirect(route('employer.jobs.index'));
        $this->assertDatabaseHas('jobs', ['titre' => 'Laravel Developer']);
    }

    /** @test */
    public function test_employer_job_creation_requires_mandatory_fields(): void
    {
        $user = $this->makeEmployer();

        $response = $this->actingAs($user)->post('/employer/jobs', []);

        $response->assertSessionHasErrors(['titre', 'description', 'location', 'job_type', 'date_publication']);
    }

    /** @test */
    public function test_employer_can_view_edit_job_page(): void
    {
        $user = $this->makeEmployer();
        $job  = Job::factory()->create(['id_employeur' => $user->profile->id]);

        $this->actingAs($user)->get("/employer/jobs/{$job->id}/edit")->assertStatus(200);
    }

    /** @test */
    public function test_employer_can_update_a_job(): void
    {
        $user = $this->makeEmployer();
        $job  = Job::factory()->create(['id_employeur' => $user->profile->id]);

        $response = $this->actingAs($user)->put("/employer/jobs/{$job->id}", [
            'titre'            => 'Updated Title',
            'description'      => $job->description,
            'location'         => $job->location,
            'job_type'         => $job->job_type,
            'date_publication' => $job->date_publication,
        ]);

        $response->assertRedirect(route('employer.jobs.index'));
        $this->assertDatabaseHas('jobs', ['id' => $job->id, 'titre' => 'Updated Title']);
    }

    /** @test */
    public function test_employer_can_delete_a_job(): void
    {
        $user = $this->makeEmployer();
        $job  = Job::factory()->create(['id_employeur' => $user->profile->id]);

        $response = $this->actingAs($user)->delete("/employer/jobs/{$job->id}");
        $response->assertRedirect(route('employer.jobs.index'));
        $this->assertDatabaseMissing('jobs', ['id' => $job->id]);
    }

    /** @test */
    public function test_employer_can_search_jobs(): void
    {
        $user = $this->makeEmployer();
        $this->actingAs($user)->get('/search?keyword=laravel')->assertStatus(200);
    }
}
