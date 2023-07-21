<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UserLogin;
Use App\Models\Company;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    public function test_index_page_is_accessible()
    {
        $response = $this->get(route('company.index'));

        // Check if the response is a redirect (status code 302)
        $response->assertStatus(302);

        // Follow the redirect and check if the redirected page is the correct one (status code 200)
        $response = $this->followRedirects($response);

        $response->assertStatus(200);
    }


    public function testStoreWithoutLogo()
    {
        $formData = [
            'companyName' => 'Test Company',
            'companyEmail' => 'test@example.com',
        ];

        // Make a POST request to the store method
        $response = $this->post(route('company.store'), $formData);

        // Assert that the response is a redirect (back to the previous page)
        $response->assertStatus(302);
    }


    public function testUpdateWithoutLogo()
    {
        // Create a test company in the database
        $company = Company::factory()->create();

        $formData = [
            'companyName' => 'Updated Company',
            'companyEmail' => 'updated@example.com',
        ];

        // Make a PUT request to the update method
        $response = $this->put(route('company.update', ['company' => $company->id]), $formData);

        // Assert that the response is a redirect (back to the previous page)
        $response->assertStatus(302);

        // Assert that the logo field is unchanged (null or empty)
        $this->assertNull($company->fresh()->logo);
    }
    public function testDestroyMethod()
    {
        $company = Company::factory()->create();

        $response = $this->delete(route('company.destroy', ['company' => $company->id]));

        $response->assertRedirect();
    }
}
