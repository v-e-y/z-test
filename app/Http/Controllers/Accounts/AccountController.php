<?php

declare(strict_types=1);

namespace App\Http\Controllers\Accounts;

use Asciisd\Zoho\ZohoManager;
use App\Http\Controllers\Controller;
use App\Services\ZohoCRMV3\Contracts\ZohoModuleEntityInterface;
use App\Services\ZohoCRMV3\Contracts\ZohoModuleGetRecordsInterface;

final class AccountController extends Controller implements ZohoModuleEntityInterface, ZohoModuleGetRecordsInterface
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