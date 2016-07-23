<?php
/**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2014 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class SeotagsObject extends ObjectModel
{
    public $id;

    public $title_product;
    public $title_category;
    public $description_product;
    public $description_category;
    public $keywords_product;
    public $keywords_category;
    public $language;
    /**
    * @see ObjectModel::$definition
    */
    public static $definition = array(
        'table' => 'neo_seotags',
        'primary' => 'seotags_id',
        'fields' => array(
        'title_product' =>              array('type' => self::TYPE_STRING, 'required' => false),
        'description_product' =>              array('type' => self::TYPE_STRING, 'required' => false),
        'keywords_product' =>              array('type' => self::TYPE_STRING, 'required' => false),
        'title_category' =>              array('type' => self::TYPE_STRING, 'required' => false),
        'description_category' =>              array('type' => self::TYPE_STRING, 'required' => false),
        'keywords_category' =>              array('type' => self::TYPE_STRING, 'required' => false),
        'language' =>              array('type' => self::TYPE_INT, 'required' => false)
        )
    );

    /**
    * Return all the saved fields
    *
    * @return Array
    */
    public static function getAll()
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $results = $db->executeS('
        SELECT *
        FROM '._DB_PREFIX_.self::$definition['table'].'
        ');

        return $results;
    }

    public static function getAllByLanguage($id)
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $results = $db->executeS('
        SELECT *
        FROM '._DB_PREFIX_.self::$definition['table'].'
        WHERE language = '.$id.'');

        return $results;
    }

    public static function deleteFromByLanguage($id)
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $results = $db->executeS('
        DELETE
        FROM '._DB_PREFIX_.self::$definition['table'].'
        WHERE language = '.$id.'');
        /*echo '
        DELETE
        FROM '._DB_PREFIX_.self::$definition['table'].'
        WHERE language = '.$id.'';exit(0);*/
        return $results;
    }

    public static function insertFromByLanguage($tp, $tc, $dp, $dc, $kp, $kc, $lng)
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'INSERT INTO '._DB_PREFIX_.self::$definition['table'].
               '(title_product, title_category, description_product, description_category, keywords_product, keywords_category, language)'.
               ' VALUES ("'.pSQL($tp).'", "'.pSQL($tc).'","'.pSQL($dp).'","'.pSQL($dc).'","'.pSQL($kp).'","'.pSQL($kc).'",'.(int)$lng.')';

        $results = $db->execute($sql);
        return $results;
    }

    public static function getTab()
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $results = $db->executeS('
            SELECT id_parent
            FROM '._DB_PREFIX_.'tab WHERE class_name = "AdminPreferences"
          ');

        return $results;
    }

    public static function getLangs()
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'SELECT * FROM  '._DB_PREFIX_.'lang ';
        //echo $sql;exit(0);
        $results = $db->executeS($sql);
        return $results;
    }
}
