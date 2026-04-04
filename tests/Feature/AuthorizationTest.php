<?php

namespace Tests\Feature;

use App\Models\ProfilEmployer;
use App\Models\ProfilJobseeker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests that role-based middleware correctly blocks unauthorized access.
 * Each test verifies a user with the wrong role cannot access a route.
 */
class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    // ─── Guest access ─────────────────────────────────────────────────────────

    /** @test */
    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function test_guest_is_redirected_from_employer_dashboard(): void
    {
        $this->get('/employer/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function test_guest_is_redirected_from_jobseeker_dashboard(): void
    {
        $this->get('/jobseeker/dashboard')->assertRedirect('/login');
    }

    // ─── Wrong-role access ────────────────────────────────────────────────────

    /** @test */
    public function test_jobseeker_cannot_access_admin_dashboard(): void
    {
        $profil = ProfilJobseeker::factory()->create();
        $user   = User::factory()->jobseeker()->create(['profile_id' => $profil->id]);

        $this->actingAs($user)->get('/dashboard')->assertStatus(403);
    }

    /** @test */
    public function test_employer_cannot_access_admin_dashboard(): void
    {
        $profil = ProfilEmployer::factory()->create();
        $user   = User::factory()->employer()->create(['profile_id' => $profil->id]);

        $this->actingAs($user)->get('/dashboard')->assertStatus(403);
    }

    /** @test */
    public function test_admin_cannot_access_employer_dashboard(): void
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin)->get('/employer/dashboard')->assertStatus(403);
    }

    /** @test */
    public function test_admin_cannot_access_jobseeker_dashboard(): void
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin)->get('/jobseeker/dashboard')->assertStatus(403);
    }

    /** @test */
    public function test_employer_cannot_access_jobseeker_jobs_page(): void
    {
        $profil = ProfilEmployer::factory()->create();
        $user   = User::factory()->employer()->create(['profile_id' => $profil->id]);

        $this->actingAs($user)->get('/jobseeker/jobs')->assertStatus(403);
    }

    /** @test */
    public function test_jobseeker_cannot_access_employer_jobs_page(): void
    {
        $profil = ProfilJobseeker::factory()->create();
        $user   = User::factory()->jobseeker()->create(['profile_id' => $profil->id]);

        $this->actingAs($user)->get('/employer/jobs')->assertStatus(403);
    }

    /** @test */
    public function test_jobseeker_cannot_post_a_job(): void
    {
        $profil = ProfilJobseeker::factory()->create();
        $user   = User::factory()->jobseeker()->create(['profile_id' => $profil->id]);

        $this->actingAs($user)->post('/employer/jobs', [
            'titre'            => 'Hacked Job',
            'description'      => 'This should not be created.',
            'location'         => 'Nowhere',
            'job_type'         => 'Full-time',
            'date_publication' => '2026-04-01',
        ])->assertStatus(403);
    }
}
