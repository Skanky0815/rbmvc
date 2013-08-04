<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 22:02
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model\Collection;

use Application\Model\User;
use RBMVC\Core\Model\Collection\AbstractCollection;

class UserCollection extends AbstractCollection {

    /**
     * @param array $result
     *
     * @return void
     */
    protected function fill(array $result) {
        if (array_key_exists('id', $result)) {
            $user = new User();
            $user->setId($result['id'])->init();
            $this->models[] = $user;

            return;
        }

        foreach ($result as $data) {
            if (!is_array($data)) {
                continue;
            }
            $user = new User();
            $user->setId($data['id'])->init();
            $this->models[] = $user;
        }
    }

}