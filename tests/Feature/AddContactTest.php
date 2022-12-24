<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddContactTest extends TestCase
{
    use WithFaker;

    public function test_create_contact_page_show_form()
    {
        $response = $this->get(
            route('contacts.create')
        );

        $response->assertSeeText('Add contact')
            ->assertSeeText('First name')
            ->assertSeeText('Last name*')
            ->assertSeeText('Create new');
    }

    public function test_create_contact_send_form_good_data_new_account()
    {
        $response = $this->post(
            route('contacts.store'),
            [
                'First_Name' => 'test_create_contact new_account',
                'Last_Name' => '_send_form_good_data',
                'new_account' => 'new acc test string'
            ]
        );

        $response->assertRedirectToRoute('index')->assertStatus(201);
        $response->assertSessionHas('message');
    }

    public function test_create_contact_send_form_good_data_new_contact_created()
    {
        $contactFirstName = $this->faker()->sentence(1);
        $contactLastName = $this->faker()->sentence(1);

        $response = $this->post(
            route('contacts.store'),
            [
                'First_Name' => $contactFirstName,
                'Last_Name' =>  $contactLastName
            ]
        );

        $response->assertRedirectToRoute('index')->assertStatus(201);
        $response->assertSessionHas('message');

        $this->get(
            route('index')
        )->assertSeeText($contactFirstName)->assertSeeText($contactLastName);
    }

    public function test_create_contact_send_form_good_data_existed_account()
    {
        $response = $this->post(
            route('contacts.store'),
            [
                'First_Name' => 'test_create_contact existed_account',
                'Last_Name' => '_send_form_good_data',
                'existed_account' => '534719000000362895',
            ]
        );
        
        $response->assertRedirectToRoute('index')->assertStatus(201);
        $response->assertSessionHas('message');
    }

    public function test_create_contact_send_form_bad_data_bad_last_name()
    {
        $response = $this->post(
            route('contacts.store'),
            [
                'First_Name' => 'end_form_bad_data_no_last_name',
                'Last_Name' => '',
                'new_account' => 'new acc test_create_contact_send_form_bad_data_no_last_name'
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('Last_Name');
    }

    public function test_create_contact_send_form_bad_data_account_conflict()
    {
        $response = $this->post(
            route('contacts.store'),
            [
                'First_Name' => 'end_form_bad_data_no_new_account',
                'Last_Name' => '_send_form_good_data',
                'existed_account' => '534719000000361178',
                'new_account' => 'new acc test_create_contact_send_form_bad_data_no_last_name'
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('new_account');
        $response->assertSessionHasErrors('existed_account');
    }

    public function test_create_contact_send_form_good_data_new_account_created()
    {
        $contactFirstName = $this->faker()->sentence(1);
        $contactLastName = $this->faker()->sentence(1);
        $newAccount = $this->faker()->sentence(2);

        $response = $this->post(
            route('contacts.store'),
            [
                'First_Name' => $contactFirstName,
                'Last_Name' =>  $contactLastName,
                'new_account' => $newAccount
            ]
        );

        $response->assertRedirectToRoute('index')->assertStatus(201);
        $response->assertSessionHas('message');

        $this->get(
            route('index')
        )
        ->assertSeeText($contactFirstName)
        ->assertSeeText($contactLastName)
        ->assertSeeText($newAccount);
    }
}
