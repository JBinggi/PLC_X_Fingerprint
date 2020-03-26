<?php
/**
 * FingerprintController.php - Main Controller
 *
 * Main Controller Fingerprint Module
 *
 * @category Controller
 * @package Fingerprint
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace JBinggi\Fingerprint\Controller;

use Application\Controller\CoreUpdateController;
use Application\Model\CoreEntityModel;
use JBinggi\Fingerprint\Model\FingerprintTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;

class InstallController extends CoreUpdateController {
    /**
     * FingerprintController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param FingerprintTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter, FingerprintTable $oTableGateway, $oServiceManager)
    {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'fingerprint-single';
        parent::__construct($oDbAdapter, $oTableGateway, $oServiceManager);

        if ($oTableGateway) {
            # Attach TableGateway to Entity Models
            if (! isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    public function checkdbAction()
    {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('fingerprint');

        $oRequest = $this->getRequest();

        if(! $oRequest->isPost()) {

            $bTableExists = false;

            try {
                $this->oTableGateway->fetchAll(false);
                $bTableExists = true;
            } catch (\RuntimeException $e) {

            }

            return new ViewModel([
                'bTableExists' => $bTableExists,
                'sVendor' => 'jbinggi',
                'sModule' => 'oneplace-fingerprint',
            ]);
        } else {
            $sSetupConfig = $oRequest->getPost('plc_module_setup_config');

            $sSetupFile = 'vendor/jbinggi/oneplace-fingerprint/data/install.sql';
            if(file_exists($sSetupFile)) {
                echo 'got install file..';
                $this->parseSQLInstallFile($sSetupFile,CoreUpdateController::$oDbAdapter);
            }

            if($sSetupConfig != '') {
                $sConfigStruct = 'vendor/jbinggi/oneplace-fingerprint/data/structure_'.$sSetupConfig.'.sql';
                if(file_exists($sConfigStruct)) {
                    echo 'got struct file for config '.$sSetupConfig;
                    $this->parseSQLInstallFile($sConfigStruct,CoreUpdateController::$oDbAdapter);
                }
                $sConfigData = 'vendor/jbinggi/oneplace-fingerprint/data/data_'.$sSetupConfig.'.sql';
                if(file_exists($sConfigData)) {
                    echo 'got data file for config '.$sSetupConfig;
                    $this->parseSQLInstallFile($sConfigData,CoreUpdateController::$oDbAdapter);
                }
            }

            $oModTbl = new TableGateway('core_module', CoreUpdateController::$oDbAdapter);
            $oModTbl->insert([
                'module_key'=>'oneplace-fingerprint',
                'type'=>'module',
                'version'=>\JBinggi\Fingerprint\Module::VERSION,
                'label'=>'onePlace Fingerprint',
                'vendor'=>'jbinggi',
            ]);

            try {
                $this->oTableGateway->fetchAll(false);
                $bTableExists = true;
            } catch (\RuntimeException $e) {

            }
            $bTableExists = false;

            $this->flashMessenger()->addSuccessMessage('Fingerprint DB Update successful');
            $this->redirect()->toRoute('application', ['action' => 'checkforupdates']);
        }
    }
}
