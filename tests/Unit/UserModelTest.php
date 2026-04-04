<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\ProfileAdmin;
use App\Models\ProfilJobseeker;
use App\Models\ProfilEmployer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_has_correct_fillable_fields(): void
    {
        $user = new User();
        $expected = ['name', 'email', 'password', 'role', 'profile_id'];
        $this->assertEquals($expected, $user->getFillable());
    }

    /** @test */
    public function test_user_hides_password_and_remember_token(): void
    {
        $user = new User();
        $this->assertContains('password', $user->getHidden());
        $this->assertContains('remember_token', $user->getHidden());
    }

    /** @test */
    public function test_admin_role_is_stored_correctly(): void
    {
        $user = User::factory()->admin()->create();
        $this->assertEquals('admin', $user->role);
    }

    /** @test */
    public function test_employer_role_is_stored_correctly(): void
    {
        $user = User::factory()->employer()->create();
        $this->assertEquals('employer', $user->role);
    }

    /** @test */
    public function test_jobseeker_role_is_stored_correctly(): void
    {
        $user = User::factory()->jobseeker()->create();
        $this->assertEquals('Job Seeker', $user->role);
    }

    /** @test */
    public function test_user_profile_method_returns_null_for_unknown_role(): void
    {
        $user = User::factory()->create(['role' => 'unknown']);
        $this->assertNull($user->profile());
    }
}
