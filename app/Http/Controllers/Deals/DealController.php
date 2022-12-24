<?php

declare(strict_types=1);

namespace App\Http\Controllers\Deals;

use Illuminate\View\View;
use Asciisd\Zoho\ZohoManager;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreDealRequest;
use com\zoho\crm\api\exception\SDKException;
use com\zoho\crm\api\record\SuccessResponse;
use App\Http\Controllers\Accounts\AccountController;
use App\Http\Controllers\Contacts\ContactController;
use App\Services\ZohoCRMV3\Contracts\ZohoModuleEntityInterface;
use App\Services\ZohoCRMV3\Contracts\ZohoModuleGetRecordsInterface;

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

    public function store(StoreDealRequest $request)
    {
        /**
         * @var array<string,mixed> form request data (filtered by null data)
         */
        $validatedData = array_filter($request->validated(), fn($value) => $value !== null);

        /**
         * Build Account record
         */
        //$accountRecord = new Record();
        //$accountRecord->setId($validatedData['Account_Name']);
        //$validatedData['Account_Name'] = $accountRecord;

        /**
         * Build Contact record
         */
        //$contactRecord = new Record();
        //$contactRecord->setId($validatedData['Contact_Name']);
        //$validatedData['Contact_Name'] = $contactRecord;

        try {
            $response = $this->zohoModule()->create($validatedData);
        } catch (SDKException $th) {
            Log::info($th->getMessage() . $th->getLine());
            return redirect()->back()->with('message', 'Deal add error');
        }

        if ($response instanceof SuccessResponse) {
            return redirect(
                route('index'),
                201
            )
            ->with(
                'message', 
                $response->getStatus()->getValue() . ', ' . $response->getMessage()->getValue()
            );
        }
        
        return redirect()->back()->with('message', 'Add contact error');
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
