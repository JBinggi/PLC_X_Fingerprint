<?php
/**
 * FingerprintTable.php - Fingerprint Table
 *
 * Table Model for Fingerprint
 *
 * @category Model
 * @package Fingerprint
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace JBinggi\Fingerprint\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

class FingerprintTable extends CoreEntityTable {

    /**
     * FingerprintTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'fingerprint-single';
    }

    /**
     * Get Fingerprint Entity
     *
     * @param int $id
     * @param string $sKey
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id,$sKey = 'Fingerprint_ID') {
        # Use core function
        return $this->getSingleEntity($id,$sKey);
    }

    /**
     * Save Fingerprint Entity
     *
     * @param Fingerprint $oFingerprint
     * @return int Fingerprint ID
     * @since 1.0.0
     */
    public function saveSingle(Fingerprint $oFingerprint) {
        $aDefaultData = [
            'label' => $oFingerprint->label,
        ];

        return $this->saveSingleEntity($oFingerprint,'Fingerprint_ID',$aDefaultData);
    }

    /**
     * Generate new single Entity
     *
     * @return Fingerprint
     * @since 1.0.0
     */
    public function generateNew() {
        return new Fingerprint($this->oTableGateway->getAdapter());
    }
}