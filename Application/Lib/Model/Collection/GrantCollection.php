<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:30
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Model\Collection;

use Application\Lib\Model\Grant;
use RBMVC\Core\Model\Collection\AbstractCollection;

/**
 * Class GrantCollection
 * @package Application\Lib\Model\Collection
 */
class GrantCollection extends AbstractCollection {

    /**
     * @param array|int $types
     */
    public function findByType($types) {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->where(array('type' => $types));
        $query->orderBy(array('id' => 'DESC'));

        error_log(__METHOD__ . '::> ' . print_r($query, 1));

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