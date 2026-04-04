<?php

namespace Tests\Unit;

use App\Models\ProfilEmployer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilEmployerModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_profil_employer_has_correct_fillable_fields(): void
    {
        $profil = new ProfilEmployer();
        $expected = ['nom_entreprise', 'adresse', 'description', 'telephone', 'secteur_activite'];
        $this->assertEquals($expected, $profil->getFillable());
    }

    /** @test */
    public function test_profil_employer_has_many_jobs(): void
    {
        $profil = new ProfilEmployer();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            $profil->jobs()
        );
    }

    /** @test */
    public function test_profil_employer_belongs_to_user(): void
    {
        $profil = new ProfilEmployer();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $profil->user()
        );
    }

    /** @test */
    public function test_profil_employer_can_be_created_with_factory(): void
    {
        $profil = ProfilEmployer::factory()->create();
        $this->assertDatabaseHas('profil_employers', ['id' => $profil->id]);
    }
}
