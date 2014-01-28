<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.01.14
 * Time: 10:03
 */

namespace Application\Lib\Model\Collection;

use Application\Lib\Model\Language;
use RBMVC\Core\Model\Collection\AbstractCollection;

/**
 * Class LanguageCollection
 * @package Application\Lib\Model\Collection
 */
class LanguageCollection extends AbstractCollection {

    /**
     * @param array $result
     *
     * @return void
     */
    protected function fill(array $result) {
        if (array_key_exists('id', $result)) {
            $language = new Language();
            $language->setId($result['id'])->init();
            $this->models[] = $language;

            return;
        }

        foreach ($result as $data) {
            if (!is_array($data)) {
                continue;
            }
            $language = new Language();
            $language->setId($data['id'])->init();
            $this->models[] = $language;
        }
    }

}