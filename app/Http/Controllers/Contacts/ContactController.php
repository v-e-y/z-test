<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use Asciisd\Zoho\ZohoManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index()
    {
        $leads = ZohoManager::make('Contacts');

        dd(
            $leads->getRecords()
        );
    }

    public function create(): View
    {
        return view(
            'contacts.add', 
            [
                'meta_title' => '',
                'meta_description' => '',
                'title' => 'Add contact'
            ]    
        );
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        dd($request->validated());
    }
}
