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

include_once(dirname(__FILE__).'/../../entity/Seotags.php');
include_once(dirname(__FILE__).'/../../seotags.php');

class SeotagsController extends AdminController
{

    protected $module;
    public $bootstrap = true;
    public function __construct()
    {
        $this->module = new Seotags();

        $this->addRowAction('edit'); //add an edit button
        $this->addRowAction('delete'); //add a delete button
        $this->bulk_actions = array('delete' =>
                                    array('text' => $this->l('Delete selected'),
                                          'confirm' => $this->l('Delete selected items?')));
        $this->explicitSelect = true;
        $this->context = Context::getContext();
        $this->id_lang = $this->context->language->id;
        $this->path = _MODULE_DIR_.'seotags';

        $this->default_form_language = $this->context->language->id;
        $this->table = 'neo_seotags'; //define the main table
        $this->className = 'SeotagsObject'; //define the module entity
        $this->identifier = 'seotags_id'; //the primary key
        $this->fields_list = array(
        'seotags_id' => array(
            'title' => $this->l('ID'),
            'align' => 'center',
            'width' => 20
        ),
        'title_product' => array(
            'title' => $this->l('Título del producto'),
            'align' => 'center',
            'width' => 20
        ),
        'description_product' => array(
            'title' => $this->l('Descripción del producto'),
            'align' => 'center',
            'width' => 20
        ),
        'keywords_product' => array(
            'title' => $this->l('Keywords del producto'),
            'align' => 'center',
            'width' => 20
        ),
        'title_category' => array(
            'title' => $this->l('Título de la categoría'),
            'align' => 'center',
            'width' => 20
        ),
        'description_category' => array(
            'title' => $this->l('Descripción de la categoría'),
            'align' => 'center',
            'width' => 20
        ),
        'keywords_category' => array(
            'title' => $this->l('Keywords de la categoría'),
            'align' => 'center',
            'width' => 20
        ),
        'language' => array(
            'title' => $this->l('Language'),
            'align' => 'center',
            'width' => 20
        )
        );
        parent::__construct();

    }

    public function setMedia()
    {
        $this->addJquery();
        $this->addJS($this->path.'/views/js/seotag.js');

        parent::setMedia();

    }

    public function renderForm()
    {
        //$module_instance = $this->module;
        $path = _MODULE_DIR_.'seotags';
        $seotags = new SeotagsObject();
        //$seotags->age = 23;

        //print_r($seotags);exit();
        $allRecords = $seotags->getLangs();
        $lngArray = array();
        $array_input =  array(array(
                'type' => 'text',
                'label' => $this->l('Título del producto'),
                'name' => 'title_product',
                'size' => 40,
                'required' => false,
                'hint' => $this->l('Título del producto'),
                'desc' => $this->l('Introduce %title% para el nombre, %price% precio, %category% categoría')
            ),
            array(
                    'type' => 'text',
                    'label' => $this->l('Descripción del producto'),
                    'name' => 'description_product',
                    'size' => 40,
                    'required' => false,
                    'hint' => $this->l('Descripción del producto'),
                    'desc' => $this->l('Introduce %title% para el nombre, %price% precio, %category% categoría')
            ),
           array(
                    'type' => 'text',
                    'label' => $this->l('Keywords del producto'),
                    'name' => 'keywords_product',
                    'size' => 40,
                    'required' => false,
                    'hint' => $this->l('Keywords del producto'),
                    'desc' => $this->l('Separadas por comas ,')
            ),
           array(
                'type' => 'text',
                'label' => $this->l('Título de la categoría'),
                'name' => 'title_category',
                'size' => 40,
                'required' => false,
                'hint' => $this->l('Título de la categoría'),
                'desc' => $this->l('Introduce %category% para la categoría')
            ),
            array(
                    'type' => 'text',
                    'label' => $this->l('Descripción de la categoría'),
                    'name' => 'description_category',
                    'size' => 40,
                    'required' => false,
                    'hint' => $this->l('Descripción de la categoría'),
                    'desc' => $this->l('Introduce %category% para la categoría')
            ),
           array(
                    'type' => 'text',
                    'label' => $this->l('Keywords de la categoría'),
                    'name' => 'keywords_category',
                    'size' => 40,
                    'required' => false,
                    'hint' => $this->l('Keywords de la categoría'),
                    'desc' => $this->l('Separadas por comas ,')
            ));

        foreach ($allRecords as $element) {
            $nameCat = $element['name'];
            $idCat = $element['id_lang'];
            $lngArray[] = array('id'=>$idCat,'name'=> $nameCat);
            // $title_aux = 'title_product-'.$idCat;
            // $description_aux = 'description_product-'.$idCat;
            // $keywords_aux = 'keywords_product-'.$idCat;
            // $seotags->createProperty($title_aux, 23);
            // $seotags->createProperty($description_aux, 23);
            // $seotags->createProperty($keywords_aux, 23);
            // $title_aux = 'title_category-'.$idCat;
            // $description_aux = 'description_category-'.$idCat;
            // $keywords_aux = 'keywords_category-'.$idCat;
            // $seotags->createProperty($title_aux, 23);
            // $seotags->createProperty($description_aux, 23);
            // $seotags->createProperty($keywords_aux, 23);
            // $array_input = $this->create_new_lang_inputs($array_input, $idCat);
        }

        //define the field to display with the form helper

        array_push($array_input, array(
                                      'type' => 'select',
                                      'label' => $this->l('language').' :',
                                      'name' => 'language',
                                      'required' => false,
                                      'col' => '4',
                                      'options' => array(
                                        'query' => $lngArray,
                                        'id' => 'id',
                                        'name' => 'name'
                                    )
                                ));
        $this->fields_form = array(
        'tinymce' => true,
        'legend' => array(
            'title' => $this->l('Modulo de Seotags')
        ),
        'input' => $array_input,
        /*'input' => array(
                                      'type' => 'button',
                                      'label' => $this->l('language').' :',
                                      'name' => 'testing'
                        )*/
        );
        //add the save button
        $this->fields_form['submit'] = array(
            'name' => 'submitSeotags',
            'title' => $this->l('   Save   '),
            'class' => 'button'
        );

        $res_op = $my_module_object = $this->loadObject(true);
        if (!($res_op)) {
            return;
        }

        //print_r($array_input);
        //populate the field with good values if we are in an edition
        foreach ($this->fields_form['input'] as $inputfield) {
            $this->fields_value[$inputfield['name']] = $my_module_object->$inputfield['name'];
        }

        $this->context->smarty->assign(array(
            'mymodule_controller_url' => $this->context->link->getAdminLink('Seotags'),//give the url for ajax query
            'elements' => $seotags->getAll()
        ));

        $more = $this->module->display($path, 'views/templates/admin/seotagadmin.tpl');

        return $more.parent::renderForm();
    }

    /**
    * postProcess handle every checks before saving products information
    *
    * @return void
    */
    public function postProcess()
    {
        $seotags = new SeotagsObject();
        if (Tools::isSubmit('submitSeotags')) {
            $allRecords = $seotags->getLangs();
            foreach ($allRecords as $element) {
                $idlang = $element['id_lang'];
                if (Tools::getValue('title_product-'.$idlang)) {
                    $seotags->deleteFromByLanguage($idlang);
                    $seotags->insertFromByLanguage(
                        Tools::getValue('title_product-'.$idlang),
                        Tools::getValue('title_category-'.$idlang),
                        Tools::getValue('description_product-'.$idlang),
                        Tools::getValue('description_category-'.$idlang),
                        Tools::getValue('keywords_product-'.$idlang),
                        Tools::getValue('keywords_category-'.$idlang),
                        $idlang
                    );
                }
            }
        }

        /*if (!$this->redirect_after) {
            parent::postProcess();
        }*/

    }
}
