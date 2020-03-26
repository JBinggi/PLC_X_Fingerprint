<?php
/**
 * ApiController.php - Fingerprint Api Controller
 *
 * Main Controller for Fingerprint Api
 *
 * @category Controller
 * @package Application
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace JBinggi\Fingerprint\Controller;

use Application\Controller\CoreApiController;
use JBinggi\Fingerprint\Model\FingerprintTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class ApiController extends CoreApiController {
    protected $sApiName;

    /**
     * ApiController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param FingerprintTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,FingerprintTable $oTableGateway,$oServiceManager) {
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'fingerprint-single';
        $this->sApiName = 'Fingerprint';
    }
}
