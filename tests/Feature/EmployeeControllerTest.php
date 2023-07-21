<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\UserLogin;
Use App\Models\Company;



class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_index_page_is_accessible()
    {
        $response = $this->get(route('employee.index'));

        // Check if the response is a redirect (status code 302)
        $response->assertStatus(302);

        // Follow the redirect and check if the redirected page is the correct one (status code 200)
        $response = $this->followRedirects($response);

        $response->assertStatus(200);
    }
    public function testStoreMethod()
    {
        $company = Company::factory()->create();
        // Generate random data for the request
        $data = [
            'selectCompany' => $company->id, // Replace with a valid company_id
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'emailAddress' => $this->faker->unique()->safeEmail,
            'phone' => null,
        ];

        // Send a POST request to the store method
        $response = $this->post(route('employee.store'), $data);

        // Assert that the response is a redirect back
        $response->assertRedirect();
    }

    public function testUpdateMethod()
    {
        $employee = Employee::factory()->create();
            $company = Company::factory()->create();
            $data = [
                'selectCompany' => $company->id,
                'lastname' => $this->faker->lastName,
                'firstname' => $this->faker->firstName,
                'emailAddress' => $this->faker->unique()->safeEmail,
                'phone' => $this->faker->phoneNumber,
            ];
        $response = $this->put(route('employee.update', ['employee' => $employee->id]), $data);
        $response->assertRedirect();

    }

    public function testDestroyMethod(){
        $employee = Employee::factory()->create();
        $response = $this->delete(route('employee.destroy', ['employee' => $employee->id]));
        $response->assertRedirect();
    }
}
