<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilJobseeker;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Feature tests for Job Seeker job browsing, applying, and saving jobs.
 */
class JobseekerJobTest extends TestCase
{
    use RefreshDatabase;

    // ─── helpers ──────────────────────────────────────────────────────────────

    private function makeJobseeker(): User
    {
        $profil = ProfilJobseeker::factory()->create();
        return User::factory()->jobseeker()->create(['profile_id' => $profil->id]);
    }

    // ─── Dashboard ────────────────────────────────────────────────────────────

    /** @test */
    public function test_jobseeker_can_access_dashboard(): void
    {
        $user = $this->makeJobseeker();
        $this->actingAs($user)->get('/jobseeker/dashboard')->assertStatus(200);
    }

    /** @test */
    public function test_guest_cannot_access_jobseeker_dashboard(): void
    {
        $this->get('/jobseeker/dashboard')->assertRedirect('/login');
    }

    // ─── Browse & Search ──────────────────────────────────────────────────────

    /** @test */
    public function test_jobseeker_can_browse_available_jobs(): void
    {
        Job::factory()->count(3)->create();
        $user = $this->makeJobseeker();

        $this->actingAs($user)->get('/jobseeker/jobs')->assertStatus(200);
    }

    /** @test */
    public function test_jobseeker_can_search_jobs_by_category(): void
    {
        $user = $this->makeJobseeker();
        Job::factory()->create(['categorie' => 'IT']);

        $response = $this->actingAs($user)
            ->get('/jobseeker/search?categorie=IT');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_jobseeker_can_search_jobs_by_location(): void
    {
        $user = $this->makeJobseeker();
        Job::factory()->create(['location' => 'Paris']);

        $response = $this->actingAs($user)
            ->get('/jobseeker/search?location=Paris');
        $response->assertStatus(200);
    }

    // ─── Save / Unsave Jobs ───────────────────────────────────────────────────

    /** @test */
    public function test_jobseeker_can_save_a_job(): void
    {
        $user = $this->makeJobseeker();
        $job  = Job::factory()->create();

        $response = $this->actingAs($user)->post("/jobs/{$job->id}/save");

        $response->assertRedirect();
        $this->assertDatabaseHas('saved_jobs', [
            'id_utilisateur' => $user->id,
            'job_id'         => $job->id,
        ]);
    }

    /** @test */
    public function test_jobseeker_can_unsave_a_previously_saved_job(): void
    {
        $user = $this->makeJobseeker();
        $job  = Job::factory()->create();

        // Save it first
        SavedJob::forceCreate([
            'id_utilisateur' => $user->id,
            'job_id'         => $job->id,
        ]);

        // Second call toggles: should delete
        $response = $this->actingAs($user)->post("/jobs/{$job->id}/save");

        $response->assertRedirect();
        $this->assertDatabaseMissing('saved_jobs', [
            'id_utilisateur' => $user->id,
            'job_id'         => $job->id,
        ]);
    }

    /** @test */
    public function test_jobseeker_can_view_saved_jobs_list(): void
    {
        $user = $this->makeJobseeker();
        $this->actingAs($user)->get('/saved-jobs')->assertStatus(200);
    }

    // ─── Apply ────────────────────────────────────────────────────────────────

    /** @test */
    public function test_jobseeker_can_apply_to_a_job(): void
    {
        Mail::fake();
        Storage::fake('public');

        $user = $this->makeJobseeker();
        $job  = Job::factory()->create();

        $response = $this->actingAs($user)->post("/jobs/{$job->id}/apply", [
            'cover_letter' => 'I am very interested in this position.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'id_job'       => $job->id,
            'id_jobseeker' => $user->profile->id,
        ]);
    }

    /** @test */
    public function test_application_requires_cover_letter(): void
    {
        $user = $this->makeJobseeker();
        $job  = Job::factory()->create();

        $response = $this->actingAs($user)->post("/jobs/{$job->id}/apply", [
            'cover_letter' => '',
        ]);

        $response->assertSessionHasErrors(['cover_letter']);
    }

    /** @test */
    public function test_jobseeker_can_apply_with_resume_file(): void
    {
        Mail::fake();
        Storage::fake('public');

        $user = $this->makeJobseeker();
        $job  = Job::factory()->create();

        $response = $this->actingAs($user)->post("/jobs/{$job->id}/apply", [
            'cover_letter' => 'Motivated candidate.',
            'resume'       => UploadedFile::fake()->create('cv.pdf', 200, 'application/pdf'),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('applications', [
            'id_job'       => $job->id,
            'id_jobseeker' => $user->profile->id,
        ]);
    }
}
