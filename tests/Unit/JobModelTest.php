<?php

namespace Tests\Unit;

use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilEmployer;
use App\Models\ProfilJobseeker;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_job_has_correct_fillable_fields(): void
    {
        $job = new Job();
        $expected = ['titre', 'description', 'location', 'job_type', 'salaire', 'categorie', 'type_contrat', 'date_publication', 'company'];
        $this->assertEquals($expected, $job->getFillable());
    }

    /** @test */
    public function test_job_can_be_created_with_factory(): void
    {
        $job = Job::factory()->create();
        $this->assertDatabaseHas('jobs', ['id' => $job->id]);
    }

    /** @test */
    public function test_job_has_many_saved_jobs_relationship(): void
    {
        $job = Job::factory()->create();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            $job->savedJobs()
        );
    }

    /** @test */
    public function test_job_has_many_applications_relationship(): void
    {
        $job = Job::factory()->create();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            $job->Applications()
        );
    }

    /** @test */
    public function test_job_belongs_to_profil_employer_relationship(): void
    {
        $job = Job::factory()->create();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $job->profilEmployer()
        );
    }

    /** @test */
    public function test_is_saved_by_returns_false_when_job_not_saved(): void
    {
        $job  = Job::factory()->create();
        $user = User::factory()->jobseeker()->create();

        $this->assertFalse($job->isSavedBy($user));
    }

    /** @test */
    public function test_is_saved_by_returns_true_when_job_is_saved(): void
    {
        $job  = Job::factory()->create();
        $user = User::factory()->jobseeker()->create();

        SavedJob::forceCreate([
            'job_id'        => $job->id,
            'id_utilisateur'=> $user->id,
        ]);

        $this->assertTrue($job->isSavedBy($user));
    }
}
