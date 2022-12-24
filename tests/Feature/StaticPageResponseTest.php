<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StaticPageResponseTest extends TestCase
{
    /**
     * Is index page response 200
     * @return void
     */
    public function test_index_page()
    {
        $this->get(
            route('index')
        )->assertStatus(200);
    }

    /**
     * Is Contact create page response 200
     * @return void
     */
    public function test_add_contact_page()
    {
        $this->get(
            route('contacts.create')
        )->assertStatus(200);
    }

    /**
     * Is Contact store page response 200
     * @return void
     */
    public function test_get_store_contact_page_not_allowed()
    {
        $this->get(
            route('contacts.store')
        )->assertStatus(405);
    }

    /**
     * Is Deal create page response 200
     * @return void
     */
    public function test_add_deal_page()
    {
        $this->get(
            route('deals.create')
        )->assertStatus(200);
    }

    /**
     * Is Contact store page response 200
     * @return void
     */
    public function test_get_store_deal_page_not_allowed()
    {
        $this->get(
            route('deals.store')
        )->assertStatus(405);
    }
}
