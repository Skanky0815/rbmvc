<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:30
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model\Collection;

use Application\Model\Grant;
use RBMVC\Core\Model\Collection\AbstractCollection;

class GrantCollection extends AbstractCollection {

    /**
     * @param array|int $types
     */
    public function findByType($types) {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->where(array('type' => $types));
        $query->orderBy(array('id' => 'DESC'));
        $this->fetch($query);
    }

    /**
     * @param array $result
     *
     * @return void
     */
    protected function fill(array $result) {
        if (array_key_exists('id', $result)) {
            $grant = new Grant();
            $grant->setId($result['id'])->init();
            $this->models[] = $grant;

            return;
        }

        foreach ($result as $data) {
            if (!is_array($data)) {
                continue;
            }
            $grant = new Grant();
            $grant->setId($data['id'])->init();
            $this->models[] = $grant;
        }
    }

}