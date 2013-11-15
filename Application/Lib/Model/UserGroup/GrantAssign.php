<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 14.11.13
 * Time: 11:52
 */

namespace Application\Lib\Model\UserGroup;

use Application\Lib\Model\Collection\GrantCollection;

class GrantAssign extends GrantCollection {

    /**
     * @param int $userGroupId
     *
     * @return void
     */
    public function findByUserGroupId($userGroupId) {
        $query = $this->db->getQuery($this->dbTable);
        //TODO query erweiter für inner joins und da sql entsprechend abändern.
        $query->setSql('SELECT grant_id AS id FROM `user_group_grant_assign` WHERE user_group_id = ' . $userGroupId);
        $this->fetch($query);
    }

    /**
     * @param int $userGroupId
     *
     * @return void
     */
    public function deleteAllByUserGroupId($userGroupId) {
        $query = $this->db->getQuery($this->dbTable);
        //TODO query erweiter für inner joins und da sql entsprechend abändern.
        $query->setSql('DELETE FROM `user_group_grant_assign` WHERE user_group_id = ' . $userGroupId);
        $this->fetch($query);
        $this->result = [];
    }

    public function save($userGroupId, array $grants) {
        foreach ($grants as $id) {
            if (empty($id)) {
                continue;
            }

            $query = $this->db->getQuery($this->dbTable);
            //TODO query erweiter für inner joins und da sql entsprechend abändern.
            $query->setSql('INSERT INTO `user_group_grant_assign` (user_group_id, grant_id) VALUES (' . $userGroupId . ', ' . $id . ')');
            $this->fetch($query);
        }
    }

} 