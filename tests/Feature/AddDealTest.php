<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Support\Str;

class AddDealTest extends TestCase
{
    private string $Stage;
    private string $Closing_Date;
    private string $Contact_Name;
    private string $Account_Name;

    protected function setUp(): void
    {
        parent::setUp();
        $this->Stage = 'Needs Analysis';
        $this->Closing_Date = Carbon::now()->addMonth()->format('Y-m-d');
        $this->Contact_Name = '534719000000360159';
        $this->Account_Name = '534719000000362895';
    }

    public function test_create_deal_page_show_form()
    {
        $response = $this->get(
            route('deals.create')
        );

        $response->assertSeeText('Add deal')
            ->assertSeeText('Deal name*')
            ->assertSeeText('Closing Date*')
            ->assertSeeText('Select stage*')
            ->assertSeeText('Deal account*')
            ->assertSeeText('Deal contact*');
    }

    public function test_create_deal_send_form_good_data()
    {
        $Deal_Name = Str::random(12);
        
        $response = $this->post(
            route('deals.store'),
            [
                'Deal_Name' => $Deal_Name,
                'Closing_Date' => $this->Closing_Date,
                'Stage' => $this->Stage,
                'Account_Name' => $this->Account_Name,
                'Contact_Name' => $this->Contact_Name
            ]
        );

        $this->get(
            route('index')
        )->assertSeeText($Deal_Name);
    }

    public function test_create_deal_send_form_bad_data_deal_name()
    {
        $response = $this->post(
            route('deals.store'),
            [
                'Deal_Name' => '',
                'Stage' => $this->Stage,
                'Closing_Date' => $this->Closing_Date,
                'Account_Name' => $this->Account_Name,
                'Contact_Name' => $this->Contact_Name
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('Deal_Name');
    }

    public function test_create_deal_send_form_bad_data_stage()
    {
        $Deal_Name = Str::random(12);
        
        $response = $this->post(
            route('deals.store'),
            [
                'Deal_Name' => $Deal_Name,
                'Stage' => '',
                'Closing_Date' => $this->Closing_Date,
                'Account_Name' => $this->Account_Name,
                'Contact_Name' => $this->Contact_Name
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('Stage');
    }

    public function test_create_deal_send_form_bad_data_account()
    {
        $Deal_Name = Str::random(12);
        
        $response = $this->post(
            route('deals.store'),
            [
                'Deal_Name' => $Deal_Name,
                'Stage' => $this->Stage,
                'Closing_Date' => $this->Closing_Date,
                'Account_Name' => '',
                'Contact_Name' => $this->Contact_Name
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('Account_Name');
    }

    public function test_create_deal_send_form_bad_data_contact()
    {
        $Deal_Name = Str::random(12);
        
        $response = $this->post(
            route('deals.store'),
            [
                'Deal_Name' => $Deal_Name,
                'Stage' => $this->Stage,
                'Closing_Date' => $this->Closing_Date,
                'Account_Name' => $this->Account_Name,
                'Contact_Name' => ''
            ]
        );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('Contact_Name');
    }
}
