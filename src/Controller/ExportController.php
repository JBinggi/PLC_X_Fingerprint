<?php
/**
 * ExportController.php - Fingerprint Export Controller
 *
 * Main Controller for Fingerprint Export
 *
 * @category Controller
 * @package Fingerprint
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace JBinggi\Fingerprint\Controller;

use Application\Controller\CoreController;
use Application\Controller\CoreExportController;
use JBinggi\Fingerprint\Model\FingerprintTable;
use Laminas\Db\Sql\Where;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\View\Model\ViewModel;


class ExportController extends CoreExportController
{
    /**
     * ApiController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param FingerprintTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,FingerprintTable $oTableGateway,$oServiceManager) {
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);
    }


    /**
     * Dump Fingerprints to excel file
     *
     * @return ViewModel
     * @since 1.0.0
     */
    public function dumpAction() {
        $this->layout('layout/json');

        # Use Default export function
        $aViewData = $this->exportData('Fingerprints','fingerprint');

        # return data to view (popup)
        return new ViewModel($aViewData);
    }
}