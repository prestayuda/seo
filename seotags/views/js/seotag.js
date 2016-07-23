/**
* 2007-2016 PrestaShop
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
*  @copyright 2007-2016 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

$(function() {
    $( "#neo_seotags_form" ).append('<input type="hidden" name="lang_store" id="lang_store" value="" />');
    $('#lang_store').val($('#language').val());
    $('#language').on('change', function() {
        store_seotags($('#lang_store').val());
        if (total_lng.indexOf($('#lang_store').val()) < 0) {
            total_lng.push($('#lang_store').val());
        }

        $('#lang_store').val($('#language').val());
        load_new_language($('#language').val());
    });

    $( "#neo_seotags_form" ).on('submit', function() {//alert(total_lng.length);
      if (total_lng.indexOf($('#lang_store').val()) < 0) {
            total_lng.push($('#lang_store').val());
      }

      store_seotags($('#lang_store').val());
      for (var i=0; i < total_lng.length; i++) {
          var title_product = 'title_product-' + total_lng[i];
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + title_product + '" id="' + title_product + '" value="'+store_total[title_product]+'" />');
          var title_category = 'title_category-' + total_lng[i];
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + title_category + '" id="' + title_category + '" value="'+store_total[title_category]+'" />');
          var description_product = 'description_product-' + total_lng[i];
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + description_product + '" id="' + description_product + '" value="'+store_total[description_product]+'" />');
          var description_category = 'description_category-' + total_lng[i];
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + description_category + '" id="' + description_category + '" value="'+store_total[description_category]+'" />');
          var keywords_product = 'keywords_product-' + total_lng[i];
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + keywords_product + '" id="' + keywords_product + '" value="'+store_total[keywords_product]+'" />');
          var keywords_category = 'keywords_category-' + total_lng[i];
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + keywords_category + '" id="' + keywords_category + '" value="'+store_total[keywords_category]+'" />');
      }

          /*var title_product = 'title_product-' + $('#language').val();
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + title_product + '" id="' + title_product + '" value="'+store_total[title_product]+'" />');
          var title_category = 'title_category-' + $('#language').val();
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + title_category + '" id="' + title_category + '" value="'+store_total[title_category]+'" />');
          var description_product = 'description_product-' + $('#language').val();
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + description_product + '" id="' + description_product + '" value="'+store_total[description_product]+'" />');
          var description_category = 'description_category-' + $('#language').val();
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + description_category + '" id="' + description_category + '" value="'+store_total[description_category]+'" />');
          var keywords_product = 'keywords_product-' + $('#language').val();
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + keywords_product + '" id="' + keywords_product + '" value="'+store_total[keywords_product]+'" />');
          var keywords_category = 'keywords_category-' + $('#language').val();
          $( "#neo_seotags_form" ).append('<input type="hidden" name="' + keywords_category + '" id="' + keywords_category + '" value="'+store_total[keywords_category]+'" />');
          */
       // alert('submit nada!' );
    });
});

function store_seotags(param) {
    var lng_aux = $('#lang_store').val();
    $('#lang_store').val(param);
    var index_title_product = 'title_product-' + lng_aux;
    var current_title_product = $('#title_product').val();
    store_total[index_title_product] = current_title_product;
    var index_title_category = 'title_category-' + lng_aux;
    var current_title_category = $('#title_category').val();
    store_total[index_title_category] = current_title_category;
    var index_description_product = 'description_product-' + lng_aux;
    var current_description_product = $('#description_product').val();
    store_total[index_description_product] = current_description_product;
    var index_description_category = 'description_category-' + lng_aux;
    var current_description_category = $('#description_category').val();
    store_total[index_description_category] = current_description_category;
    var index_keywords_product = 'keywords_product-' + lng_aux;
    var current_keywords_product = $('#keywords_product').val();
    store_total[index_keywords_product] = current_keywords_product;
    var index_keywords_category = 'keywords_category-' + lng_aux;
    var current_keywords_category = $('#keywords_category').val();
    store_total[index_keywords_category] = current_keywords_category;
}

function load_new_language(lng) {
    $('#title_product').val(store_total['title_product-' + lng]);
    $('#title_category').val(store_total['title_category-' + lng]);
    $('#description_product').val(store_total['description_product-' + lng]);
    $('#description_category').val(store_total['description_category-' + lng]);
    $('#keywords_product').val(store_total['keywords_product-' + lng]);
    $('#keywords_category').val(store_total['keywords_category-' + lng]);
}
