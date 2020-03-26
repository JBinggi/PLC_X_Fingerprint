<?php
/**
 * SearchController.php - Fingerprint Search Controller
 *
 * Main Controller for Fingerprint Search
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

use Application\Controller\CoreSearchController;
use JBinggi\Fingerprint\Model\FingerprintTable;
use Laminas\Db\Sql\Where;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;


class SearchController extends CoreSearchController
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
     * Dump Fingerprint data to desired format
     *
     * @return bool
     * @since 1.0.0
     */
    public function indexAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * fingerprint-search-before (before show search form)
         * fingerprint-search-before-execute (before query)
         * fingerprint-search-after-execute (after query - before show results)
         */
        return $this->generateSearchView('fingerprint');
    }
}