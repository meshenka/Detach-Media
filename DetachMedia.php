<?php
/*
 * Plugin Name: Detach_Media
 * Description: Because you can attach media but sometimes you just want to re-attach them not delete all the thing !
 * Version : 1.1
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

class DetachMedia
{
    /*
     * @var $instance
     */
    private $capability;

    public function getCapability()
    {
        return $this->capability;
    }

    public function __construct($capability = 'edit_post')
    {
        $this->capability = $capability;
    }

    /*
     * Use action hook to add our button
     */
    public function hookIn()
    {
        // media_row_actions is a filter not an action, props to @meshenka
        add_filter('media_row_actions',  array($this, 'detachMediaLinkCallback'), 10, 3);
    }

    /*
     * Allow user to change the post to which the media is attached
     */
    public function detachMediaLinkCallback($actions, $post, $detached)
    {
        if (($post->post_parent != 0) && (current_user_can($this->capability, $post->ID))) {
            $actions['attach'] = '<a onclick="findPosts.open( \'media[]\', \''.$post->ID.'\' );return false;" class="hide-if-no-js detach-media">'.__('Re-attach', 'detach-media').'</a>';
        }

        return $actions;
    }
}
