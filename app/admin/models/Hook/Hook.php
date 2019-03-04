<?php
namespace Hook;
use Hook\Db\PdoConnect;
use Hook\Sql\Hook\Hook;

class HookModel extends \AbstractModel
{
    public static $table = 'hp_hook';
    public static $foreign = 'hook_id';

    public $fields = [
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
        'title' => array('require' => true, 'validate' => 'isGenericName'),
        'description' => array('require' => true),
    ];

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_ALL, [$_SESSION[APP_NAME]['lang_id']]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_SHOW_SELECT, [$_SESSION[APP_NAME]['app_id'], $_SESSION[APP_NAME]['lang_id']], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}