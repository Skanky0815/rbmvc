<?php
namespace core\rbmvc\model\collection;

use core\rbmvc\model\collection\AbstractCollection;
use core\rbmvc\model\Entry;

class EntryCollection extends AbstractCollection {
    
    public function __construct() {
        parent::__construct('entry');
    }
    
    public function findAll() {
        $sql = '
            SELECT * 
            FROM ' . $this->dbTable . '
            ORDER BY id DESC';
        
        $entriesData = $this->db->fetch($sql);
        
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