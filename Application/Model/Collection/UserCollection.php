<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 22:02
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model\Collection;

use RBMVC\Core\Model\Collection\AbstractCollection;
use Application\Model\User;

class UserCollection extends AbstractCollection {

    public function findAll() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->orderBy(array('id' => 'DESC'));

        $stmt = $this->db->execute($query);
        $userData = $stmt->fetchAll();

        if (empty($userData)) {
            return;
        }

        if (array_key_exists('id', $userData)) {
            $user = new User();
            $user->setId($userData['id'])->init();
            $this->models[] = $user;
            return;
        }

        foreach ($userData as $data) {
            if (!is_array($data)) {
                continue;
            }
            $user = new User();
            $user->setId($data['id'])->init();
            $this->models[] = $user;
        }
    }

}