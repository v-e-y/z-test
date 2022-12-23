<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\View\View;
use Asciisd\Zoho\ZohoManager;
use com\zoho\crm\api\exception\SDKException;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreContactRequest;
use com\zoho\crm\api\record\SuccessResponse;
use App\Http\Controllers\Accounts\AccountController;
use App\Services\ZohoCRMV3\Contracts\ZohoModuleEntityInterface;
use com\zoho\crm\api\record\Record;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller implements ZohoModuleEntityInterface
{
    /**
     * @var string Zoho module name 
     */
    public const ZOHO_MODULE_NAME = 'Contacts';

    /**
     * @var ZohoManager Zoho module instance
     */
    private ZohoManager $zohoModule;

    public function __construct()
    {
        $this->zohoModule = ZohoManager::useModule(self::ZOHO_MODULE_NAME);
    }

    public function index()
    {
        dd(
            $this->zohoModule()->getRecords()
        );
    }

    /**
     * Show form for create zoho Contact (optional zoho Account)
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view(
            'contacts.add', 
            [
                'meta_title' => '',
                'meta_description' => '',
                'title' => 'Add contact',
                'accountRecords' => (new AccountController())->getRecords(1, 200) ?? null
            ]    
        );
    }

    /**
     * Store/create Zoho Contact
     * @param \App\Http\Requests\StoreContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @TODO Maybe should add create job...
     */
    public function store(StoreContactRequest $request): RedirectResponse
    {
        /**
         * @var array<string,mixed> form request data (filtered by null data)
         */
        $validatedData = array_filter($request->validated(), fn($value) => $value !== null);

        if (array_key_exists('new_account', $validatedData)) {
            /**
             * @var AccountController For create and update Account
             */
            $accountController = new AccountController();

            try {
                /**
                 * @var SuccessResponse zoho Accounts create response
                 */
                $accountEntity = $accountController->zohoModule()->create(
                    ['Account_Name' => $validatedData['new_account']]
                );
            } catch (SDKException $th) {
                Log::info($th->getMessage() . $th->getLine());
            }

            if ($accountEntity instanceof SuccessResponse) {
                $record = new Record();
                $record->setId($accountEntity->getDetails()['id']);
                $validatedData['Account_Name'] = $record;
            }

            unset($validatedData['new_account']);
            // TODO add log write
        }

        if (array_key_exists('existed_account', $validatedData) ) {
            $record = new Record();
            $record->setId($validatedData['existed_account']);
            $validatedData['Account_Name'] = $record;
        }
        
        /**
         * @var SuccessResponse zoho Contacts create response
         */
        try {
            $response = $this->zohoModule()->create($validatedData);
        } catch (SDKException $th) {
            Log::info($th->getMessage() . $th->getLine());

            return redirect()->back()->with('message', 'test error');
        }
        
        if ($response instanceof SuccessResponse) {
            return redirect(
                route('index')
            )
            ->with(
                'message', 
                $response->getStatus()->getValue() . ', ' . $response->getMessage()->getValue()
            );
        }

        return redirect()->back()->with('message', 'test error');
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
