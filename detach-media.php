<?php
/*
 * Plugin Name: Detach_Media
 * Description: Because you can attach media but sometimes you just want to re-attach them not delete all the thing !
 * Version : 1.0
 * Author: Julien Maury
 * Author URI: http://tweetpressfr.github.io
 */


/*  Copyright 2014 Julien Maury  (email : contact@tweetpress.fr)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH')
    or die("No direct load please !");

if( ! class_exists('Detach_Media') )
{
    class Detach_Media
    {
        /*
         * @var $instance
         */
        private static $instance;

        /*
         * Allows nice things !
         */
        public static function GetInstance()
        {
            if (!isset(self::$instance)){
                self::$instance = new self();
            }

            return self::$instance;
        }

        /*
         * Use action hook to add our button
         */
        public function hooks()
        {

            add_action( 'media_row_actions',  array(__CLASS__, 'detach_media_link'), 10, 3 );

        }

        /*
         * Allow user to change the post to which the media is attached
         */
        public static function detach_media_link( $actions, $post, $detached )
        {
            if ( $post->post_parent != 0 ) {

                if ( current_user_can('edit_post', $post->ID) ) {

                    $actions['attach'] = '<a href="#the-list" onclick="findPosts.open( \'media[]\', \''. $post->ID . '\' );return false;" class="hide-if-no-js">' . __('Re-attach', 'detach-media') . '</a>';

                 }
            }

            return $actions;

        }
    }

    $Detach_Media = Detach_Media::GetInstance();
    $Detach_Media->hooks();

}