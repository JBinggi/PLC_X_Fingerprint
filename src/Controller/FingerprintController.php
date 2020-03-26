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

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use JBinggi\Fingerprint\Model\Fingerprint;
use JBinggi\Fingerprint\Model\FingerprintTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class FingerprintController extends CoreEntityController {
    /**
     * Fingerprint Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * FingerprintController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param FingerprintTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,FingerprintTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'fingerprint-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    /**
     * Fingerprint Index
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function indexAction() {
        # You can just use the default function and customize it via hooks
        # or replace the entire function if you need more customization
        return $this->generateIndexView('fingerprint');
    }

    /**
     * Fingerprint Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * fingerprint-add-before (before show add form)
         * fingerprint-add-before-save (before save)
         * fingerprint-add-after-save (after save)
         */
        return $this->generateAddView('fingerprint');
    }

    /**
     * Fingerprint Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * fingerprint-edit-before (before show edit form)
         * fingerprint-edit-before-save (before save)
         * fingerprint-edit-after-save (after save)
         */
        return $this->generateEditView('fingerprint');
    }

    /**
     * Fingerprint View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * fingerprint-view-before
         */
        return $this->generateViewView('fingerprint');
    }
}
