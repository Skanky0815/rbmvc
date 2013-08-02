<?php
namespace RBMVC\Core\Model\Collection;

use RBMVC\Core\Model\Entry;

class EntryCollection extends AbstractCollection {
    
    /**
     * @return void
     */
    public function findAll() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->orderBy(array('id' => 'DESC'));
        
        $stmt = $this->db->execute($query);
        $entriesData = $stmt->fetchAll();
        
        if (empty($entriesData)) {
            return;
        }
        
        if (array_key_exists('id', $entriesData)) {
            $entry = new Entry();
            $entry->setId($entriesData['id'])->init();
            $this->models[] = $entry;
            return;
        }
        
        foreach ($entriesData as $entryData) {
            if (!is_array($entryData)) {
                continue;
            }
            $entry = new Entry();
            $entry->setId($entryData['id'])->init();
            $this->models[] = $entry;
        }
    }
}