<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Accounts\AccountController;
use Illuminate\View\View;
use Asciisd\Zoho\ZohoManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreContactRequest;
use App\Services\ZohoCRMV3\ContactModuleService;
use com\zoho\crm\api\record\SuccessResponse;

class ContactController extends Controller
{
    /**
     * @var string Zoho module name 
     */
    public const ZOHO_MODULE_NAME = 'Contacts';

    /**
     * @var \Asciisd\Zoho\ZohoManager Zoho module manager
     */
    private ZohoManager $zohoModule;

    public function __construct()
    {
        $this->zohoModule = ZohoManager::useModule(self::ZOHO_MODULE_NAME);
    }

    public function index()
    {
        $leads = ZohoManager::make('Contacts');

        dd(
            $leads,
            $leads->getRecords()
        );
    }

    public function create(): View
    {
        //dd((new AccountController())->getRecords());
        return view(
            'contacts.add', 
            [
                'meta_title' => '',
                'meta_description' => '',
                'title' => 'Add contact',
                'account_record' => (new AccountController())->getRecords()
            ]    
        );
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        // TODO Maybe should add create job...
        
        // $response = $this->zohoModule->create($request->validated());

        $response = (new ContactModuleService())->create($request->validated());

        dd($response);

        //SDKException

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
}
