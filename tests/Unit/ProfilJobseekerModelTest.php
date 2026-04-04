<?php

namespace Tests\Unit;

use App\Models\ProfilJobseeker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilJobseekerModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_profil_jobseeker_has_correct_fillable_fields(): void
    {
        $profil = new ProfilJobseeker();
        $expected = ['resume', 'competences', 'experience', 'education', 'fullName', 'contact_information'];
        $this->assertEquals($expected, $profil->getFillable());
    }

    /** @test */
    public function test_profil_jobseeker_has_many_applications(): void
    {
        $profil = new ProfilJobseeker();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            $profil->Applications()
        );
    }

    /** @test */
    public function test_profil_jobseeker_belongs_to_user(): void
    {
        $profil = new ProfilJobseeker();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $profil->user()
        );
    }

    /** @test */
    public function test_profil_jobseeker_can_be_created_with_factory(): void
    {
        $profil = ProfilJobseeker::factory()->create();
        $this->assertDatabaseHas('profil_jobseekers', ['id' => $profil->id]);
    }
}
