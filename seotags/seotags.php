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

require_once(dirname(__FILE__).'/entity/Seotags.php');

class Seotags extends Module
{
    const INSTALL_SQL_FILE = 'install.sql';

    public function __construct()
    {
        $this->name = 'seotags';
        $this->version = '1.0.0';
        $this->tab = 'others';
        $this->author = 'Prestayuda';
        $this->need_instance = 0;
        $this->module_key = '3b5e97eb300aa6139a41ee06123ae007';
        parent::__construct();
        $this->displayName = $this->l('Seotags');
        $this->description = $this->l('Modulo Seotags');

    }

    public function install()
    {
        if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE)) {
            return false;
        } elseif (!$sql = Tools::file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE)) {
            return false;
        }

        $sql = str_replace(array('PREFIX_', 'ENGINE_TYPE'), array(_DB_PREFIX_, _MYSQL_ENGINE_), $sql);
        $sql = preg_split("/;\s*[\r\n]+/", trim($sql));

        foreach ($sql as $query) {
            if (!Db::getInstance()->execute(trim($query))) {
                return false;
            }
        }

        $seotags = new SeotagsObject();

        $tab = $seotags->getTab();

        if (parent::install() == false || !$this->registerHook('backOfficeHeader')
            || !$this->registerHook('displayHeader')
            || !$this->installModuleTab(
                'Seotags',
                array(
                        1 => $this->l('Seotags'),
                        2 => $this->l('Seotags'),
                        3 => $this->l('Seotags'),
                        4 => $this->l('Seotags'),
                        5 => $this->l('Seotags'),
                        6 => $this->l('Seotags')
                    ),
                $tab[0]['id_parent']
            )
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (parent::uninstall() == false
            || !$this->deleteTables()
            || !$this->unregisterHook('backOfficeHeader')
            || !$this->unregisterHook('displayHeader')
            || !$this->uninstallModuleTab('Seotags')) {
                    return false;
        }

        return true;
    }

    /**
    * Give to smarty extra description based on the attribute id
    * @param array $params
    */
    public function hookDisplayHeader()
    {
        $seotags = new SeotagsObject();
        $language = $this->context->language->id;
        $allRecords = $seotags->getAllByLanguage($language);
        if (sizeof($allRecords) > 0) {
            $type_message = $this->context->controller->php_self;
            $context = $this->context->controller;
            $new_metas = false;
            if ($type_message === 'product') {
                $new_metas = true;
                $product = $context->getProduct();
                foreach ($allRecords as $record) {
                    $description_product = $record['description_product'];
                    $title_product = $record['title_product'];
                }

                $description = str_replace('%title%', $product->name, $description_product);
                $description = str_replace('%price%', $product->price, $description);
                $description = str_replace('%category%', $product->category, $description);
                $title = str_replace('%title%', $product->name, $title_product);
                $title = str_replace('%price%', $product->price, $title);
                $title = str_replace('%category%', $product->category, $title);
                $meta_keywords =
                $meta_description = $description;
                $meta_title = $title;
                $meta_keywords = $record['keywords_product'];
            } elseif ($type_message === 'category') {
                foreach ($allRecords as $record) {
                    $description_category = $record['description_category'];
                    $title_category = $record['title_category'];
                }

                $cat = $context->getCategory();
                $description = str_replace('%category%', $cat->name, $description_category);
                $title = str_replace('%category%', $cat->name, $title_category);
                $new_metas = true;
                $meta_description = $description;
                $meta_title = $title;
                $meta_keywords = $record['keywords_category'];
            }

            if ($new_metas) {
                $this->context->smarty->assign(array(
                    'meta_description' => $meta_description,
                    'meta_title' => $meta_title,
                    'meta_keywords' => $meta_keywords
                ));
            }
        }

        return $this->display(__FILE__, 'view.tpl');
    }

    public function deleteTables()
    {
        return Db::getInstance()->execute('
            DROP TABLE IF EXISTS
            `'._DB_PREFIX_.'neo_seotags`');
    }


    private function installModuleTab($tab_class, $tab_name, $id_tab_parent)
    {
        copy(_PS_MODULE_DIR_.$this->name.'/logo.png', _PS_IMG_DIR_.'t/'.$tab_class.'.png');
        $tab = new Tab();
        $tab->name = $tab_name;
        $tab->class_name = $tab_class;
        $tab->module = $this->name;
        $tab->id_parent = $id_tab_parent;
        if (!$tab->save()) {
            return false;
        }

        return true;
    }

    private function uninstallModuleTab($tab_class)
    {
        $id_tab = Tab::getIdFromClassName($tab_class);
        if ($id_tab != 0) {
            $tab = new Tab($id_tab);
            $tab->delete();
            unlink(_PS_IMG_DIR.'t/'.$tab_class.'.png');
            return true;
        }

        return false;
    }
}
