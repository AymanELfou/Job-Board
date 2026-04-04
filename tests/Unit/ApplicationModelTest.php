<?php

namespace Tests\Unit;

use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilJobseeker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_application_has_correct_fillable_fields(): void
    {
        $application = new Application();
        $expected = ['id_jobseeker', 'id_job', 'status', 'resume', 'cover_letter'];
        $this->assertEquals($expected, $application->getFillable());
    }

    /** @test */
    public function test_application_belongs_to_job(): void
    {
        $app = new Application();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $app->job()
        );
    }

    /** @test */
    public function test_application_belongs_to_profil_jobseeker(): void
    {
        $app = new Application();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $app->profilJobseeker()
        );
    }

    /** @test */
    public function test_application_can_be_created_with_factory(): void
    {
        $jobseeker = ProfilJobseeker::factory()->create();
        $job       = Job::factory()->create();

        $application = Application::factory()->create([
            'id_jobseeker' => $jobseeker->id,
            'id_job'       => $job->id,
        ]);

        $this->assertDatabaseHas('applications', [
            'id'           => $application->id,
            'id_jobseeker' => $jobseeker->id,
            'id_job'       => $job->id,
        ]);
    }
}
