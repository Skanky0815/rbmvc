<?php
namespace RBMVC\Core\Model\Collection;

use RBMVC\Core\Model\Entry;

class EntryCollection extends AbstractCollection {
    
    /**
     * @return void
     */
    public function __construct() {
        parent::__construct('entry');
    }
    
    /**
     * @return void
     */
    public function findAll() {
        $sql = '
            SELECT * 
            FROM ' . $this->dbTable . '
            ORDER BY id DESC';
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $entriesData = $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log(__METHOD__.'::> '.$e->getMessage());
            return false;
        }
        
        if (empty($entriesData)) {
            return;
        }
        
        if (array_key_exists('id', $entriesData)) {
            $entry = new Entry();
            $entry->fillModelByArray($entriesData);
            $this->models[] = $entry;
            return;
        }
        
        foreach ($entriesData as $entryData) {
            if (!is_array($entryData)) {
                continue;
            }
            $entry = new Entry();
            $entry->fillModelByArray($entryData);
            $this->models[] = $entry;
        }
    }
}