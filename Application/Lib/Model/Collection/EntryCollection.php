<?php
namespace Application\Lib\Model\Collection;

use Application\Lib\Model\Entry;
use RBMVC\Core\Model\Collection\AbstractCollection;

/**
 * Class EntryCollection
 * @package Application\Lib\Model\Collection
 */
class EntryCollection extends AbstractCollection {

    /**
     * @param array $result
     *
     * @return void
     */
    protected function fill(array $result) {
        if (array_key_exists('id', $result)) {
            $entry = new Entry();
            $entry->setId($result['id'])->init();
            $this->models[] = $entry;

            return;
        }

        foreach ($result as $entryData) {
            if (!is_array($entryData)) {
                continue;
            }
            $entry = new Entry();
            $entry->setId($entryData['id'])->init();
            $this->models[] = $entry;
        }
    }

}