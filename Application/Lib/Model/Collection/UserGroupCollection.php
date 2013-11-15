<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 15:05
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Model\Collection;

use Application\Lib\Model\UserGroup;
use RBMVC\Core\Model\Collection\AbstractCollection;

/**
 * Class UserGroupCollection
 * @package Application\Lib\Model\Collection
 */
class UserGroupCollection extends AbstractCollection {

    /**
     * @param $userId
     *
     * @return void
     */
    public function findByUserId($userId) {
        $query = $this->db->getQuery($this->dbTable);
        //TODO query erweiter für inner joins und da sql entsprechend abändern.
        $query->setSql('SELECT user_group_id AS id FROM `user_group_assign` WHERE user_id = ' . $userId);
        $this->fetch($query);
    }

    /**
     * @param array $result
     *
     * @return void
     */
    protected function fill(array $result) {
        if (array_key_exists('id', $result)) {
            $userGroup = new UserGroup();
            $userGroup->setId($result['id'])->init();
            $this->models[] = $userGroup;

            return;
        }

        foreach ($result as $data) {
            if (!is_array($data)) {
                continue;
            }
            $userGroup = new UserGroup();
            $userGroup->setId($data['id'])->init();
            $this->models[] = $userGroup;
        }
    }

}