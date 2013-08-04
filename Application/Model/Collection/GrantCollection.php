<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:30
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model\Collection;

use RBMVC\Core\Model\Collection\AbstractCollection;
use Application\Model\Grant;

class GrantCollection extends AbstractCollection {

    /**
     * @return void
     */
    public function findAll() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->orderBy(array('id' => 'DESC'));

        $stmt = $this->db->execute($query);
        $grantData = $stmt->fetchAll();
        if (empty($grantData)) {
            return;
        }

        if (array_key_exists('id', $grantData)) {
            $grant = new Grant();
            $grant->setId($grantData['id'])->init();
            $this->models[] = $grant;
            return;
        }

        foreach ($grantData as $data) {
            if (!is_array($data)) {
                continue;
            }
            $grant = new Grant();
            $grant->setId($data['id'])->init();
            $this->models[] = $grant;
        }
    }

}