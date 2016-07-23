{*
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
*}
<script type="text/javascript">

    var admin_word_link = "{$mymodule_controller_url|escape:'html':'UTF-8'}";
    var store_total =  [];
    var total_lng = [];

</script>
{foreach from=$elements item=elem}
<script>
    var lng_aux = "{$elem['language']|escape:'htmlall':'UTF-8'}";
    var index_title_product = 'title_product-' + lng_aux;
    var current_title_product = "{$elem['title_product']|escape:'htmlall':'UTF-8'}";
    store_total[index_title_product] = current_title_product;
    var index_title_category = 'title_category-' + lng_aux;
    var current_title_category = "{$elem['title_category']|escape:'htmlall':'UTF-8'}";
    store_total[index_title_category] = current_title_category;
    var index_description_product = 'description_product-' + lng_aux;
    var current_description_product = "{$elem['description_product']|escape:'htmlall':'UTF-8'}";
    store_total[index_description_product] = current_description_product;
    var index_description_category = 'description_category-' + lng_aux;
    var current_description_category =  "{$elem['description_category']|escape:'htmlall':'UTF-8'}";
    store_total[index_description_category] = current_description_category;
    var index_keywords_product = 'keywords_product-' + lng_aux;
    var current_keywords_product = "{$elem['keywords_product']|escape:'htmlall':'UTF-8'}";
    store_total[index_keywords_product] = current_keywords_product;
    var index_keywords_category = 'keywords_category-' + lng_aux;
    var current_keywords_category = "{$elem['keywords_category']|escape:'htmlall':'UTF-8'}";;
    store_total[index_keywords_category] = current_keywords_category;
</script>
{/foreach}
