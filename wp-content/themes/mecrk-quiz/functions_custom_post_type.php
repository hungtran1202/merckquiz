<?php
/**
 * Created by PhpStorm.
 * User: lacphan
 * Date: 2/19/16
 * Time: 2:12 PM
 */

/*
 * check plugin enpii core active
 * plugin active, you cant use class NpWP
 */
if(defined('_ENPII_CORE')) {
    if (!function_exists('enpii_custom_post_type_init')) {
        /**
         * Register a job post type.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_post_type
         * @param $postType
         * @param $slug
         * @param pluralName
         * @param $singularName
         * @param $textDomain
         * @param $menuPosition
         */
        function enpii_custom_post_type_init()
        {

            $postType = "question";
            $slug = "question";
            $pluralName = "Questions";
            $singularName = "Question";
        NpWp::registerPostType($postType, $slug, $pluralName, $singularName,10);

        }
    }
    /*
     * Create custom post type, using:
     * add_action( 'init', 'enpii_custom_post_type_init' )
     */
    add_action('init', 'enpii_custom_post_type_init');

    /*
     * register Taxonomy
     */

    if (!function_exists('template_custom_taxonomy')) {

        function template_custom_taxonomy()
        {
            $taxonomy = "questionnaire";
            $slugTaxonomy = "questionnaire";
            $postType = "question";
            $pluralName = "Questionnaires";
            $singularName = "Questionnaire";
        NpWp::registerTaxonomy($taxonomy, $slugTaxonomy, $postType, $pluralName, $singularName);
        }

    }
    /*
     * register Taxonomy for custom post type, using:
     * add_action('init', 'template_custom_taxonomy')
     */
    add_action('init', 'template_custom_taxonomy', 0);
}
?>
<?php remove_role( 'subscriber' ); ?>
<?php remove_role( 'editor' ); ?>
<?php remove_role( 'contributor' ); ?>
<?php remove_role( 'author' ); ?>
