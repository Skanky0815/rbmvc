<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 05.08.13
 * Time: 21:19
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model;

use Application\Model\Collection\GrantCollection;
use RBMVC\Core\DB\DB;

class LoggedInUser extends User {

    /**
     * @var array
     */
    private $grants = array();

    public function __construct() {
        parent::__construct();

        $this->dbTable = 'user';

        $grantCollection = new GrantCollection();
        $grantCollection->findByType(Grant::TYPE_PUBLIC);
        /** @var \Application\Model\Grant $grant */
        foreach ($grantCollection->getModels() as $grant) {
            $this->grants[] = $grant->getDefinition();
        }

    }

    /**
     * @return array
     */
    public function getGrants() {
        return $this->grants;
    }

    /**
     * @param array $grants
     *
     * @return \Application\Model\User
     */
    public function setGrants(array $grants) {
        $this->grants = $grants;

        return $this;
    }

    /**
     * @return bool
     */
    public function exists() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select();
        $query->where(array('password' => $this->password, 'username' => $this->username));

        $stmt = $this->db->execute($query);
        if (is_null($stmt)) {
            return false;
        }

        $result = $stmt->fetch();

        if (empty($result)) {
            return false;
        }

        $this->fillModelByArray($result);

        return true;
    }

}