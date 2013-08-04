<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 15:05
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model\Collection;

use Application\Model\UserGroup;
use RBMVC\Core\Model\Collection\AbstractCollection;

class UserGroupCollection extends AbstractCollection {

    /**
     * @return void
     */
    public function findAll() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->orderBy(array('id' => 'DESC'));

        $stmt          = $this->db->execute($query);
        $userGroupData = $stmt->fetchAll();

        if (empty($userGroupData)) {
            return;
        }

        if (array_key_exists('id', $userGroupData)) {
            $userGroup = new UserGroup();
            $userGroup->setId($userGroupData['id'])->init();
            $this->models[] = $userGroup;

            return;
        }

        foreach ($userGroupData as $data) {
            if (!is_array($data)) {
                continue;
            }
            $userGroup = new UserGroup();
            $userGroup->setId($data['id'])->init();
            $this->models[] = $userGroup;
        }
    }

}