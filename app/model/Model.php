<?php
namespace App;
use Nette;

/**
 * Provádí operace nad databázovou tabulkou.
 */
abstract class Model extends Nette\Object
{
    /** @var Nette\Database\Context */
    protected $db;

    public function __construct(Nette\Database\Context $db) 
    {
        $this->db = $db;
    }

    /**
     * Vrací objekt reprezentující databázovou tabulku.
     * @return Nette\Database\Table\Selection
     */
    protected function getTable()
    {
        // název tabulky odvodíme z názvu třídy
        preg_match('#(\w+)Model$#', get_class($this), $m);
        return $this->db->table(lcfirst($m[1]));
    }

    /**
     * Vrací všechny řádky z tabulky.
     * @return Nette\Database\Table\Selection
     */
    public function findAll()
    {
        return $this->getTable();
    }

    /**
     * Vrací řádky podle filtru, např. array('name' => 'John').
     * @return Nette\Database\Table\Selection
     */
    public function findBy(array $by)
    {
        return $this->getTable()->where($by);
    }

}
