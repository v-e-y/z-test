<?php

declare(strict_types=1);

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Asciisd\Zoho\ZohoManager;

final class AccountController extends Controller
{
    /**
     * @var string Zoho module name 
     */
    public const ZOHO_MODULE_NAME = 'Accounts';

    /**
     * @var \Asciisd\Zoho\ZohoManager Zoho module instance
     */
    private ZohoManager $zohoModule;

    public function __construct()
    {
        $this->zohoModule = ZohoManager::useModule(self::ZOHO_MODULE_NAME);
    }

    public function getRecords()
    {
        return $this->zohoModule->getRecords();

        //[
        //    'per_page' => 200,
        //    'fealds' => 'id,Campaign_Name'
        //]
    }
}