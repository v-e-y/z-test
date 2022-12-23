<?php

declare(strict_types=1);

namespace App\Http\Controllers\Deals;

use Illuminate\View\View;
use Asciisd\Zoho\ZohoManager;
use App\Http\Controllers\Accounts\AccountController;
use App\Http\Controllers\Contacts\ContactController;
use App\Http\Requests\StoreDeal;
use App\Services\ZohoCRMV3\Contracts\ZohoModuleEntityInterface;
use App\Services\ZohoCRMV3\Contracts\ZohoModuleGetRecordsInterface;
use Illuminate\Http\Request;

/**
 * Deal Name | Account Name | Contact Name | Closing Date | Stage | ?Type = potential
 */
final class DealController implements ZohoModuleEntityInterface, ZohoModuleGetRecordsInterface
{
    /**
     * @var string Zoho module name 
     */
    public const ZOHO_MODULE_NAME = 'Deals';

    /**
     * @var \Asciisd\Zoho\ZohoManager Zoho module instance
     */
    private ZohoManager $zohoModule;

    public function __construct()
    {
        $this->zohoModule = ZohoManager::useModule(self::ZOHO_MODULE_NAME);
    }

    /**
     * Show form for create zoho Deal
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view(
            'deals.add', 
            [
                'meta_title' => '',
                'meta_description' => '',
                'title' => 'Add deal',
                'accountRecords' => (new AccountController())->getRecords(1, 200) ?? null,
                'contacts' => (new ContactController())->getRecords(1, 200)
            ]    
        );
    }

    public function store(StoreDeal $request)
    {
        dd($request->validated());
    }

    /**
     * Get Accounts records
     * @param integer $page
     * @param integer $perPage
     * @return array<int,com\zoho\crm\api\record\Record>
     */
    public function getRecords(int $page, int $perPage): array
    {
        return $this->zohoModule()->getRecords(...func_get_args());
    }

    /**
     * Get Zoho module entity
     * @return \Asciisd\Zoho\ZohoManager
     */
    public function zohoModule(): ZohoManager
    {
        return $this->zohoModule;
    }
}
