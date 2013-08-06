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