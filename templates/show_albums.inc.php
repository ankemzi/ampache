<?php
/* vim:set softtabstop=4 shiftwidth=4 expandtab: */
/**
 *
 * LICENSE: GNU General Public License, version 2 (GPLv2)
 * Copyright 2001 - 2013 Ampache.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v2
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 */

$web_path = Config::get('web_path');
$tags_list = Tag::get_display(Tag::get_tags());
?>
<?php require Config::get('prefix') . '/templates/list_header.inc.php'; ?>
<table class="tabledata" cellpadding="0" cellspacing="0">
    <tr class="th-top">
    <?php if (Config::get('directplay')) { ?>
        <th class="cel_directplay"><?php echo T_('Play'); ?></th>
    <?php } ?>
        <th class="cel_add"><?php echo T_('Add'); ?></th>
    <?php if (Art::is_enabled()) { ?>
        <th class="cel_cover"><?php echo T_('Cover'); ?></th>
    <?php } ?>
        <th class="cel_album"><?php echo Ajax::text('?page=browse&action=set_sort&browse_id=' . $browse->id . '&sort=name', T_('Album'),'album_sort_name'); ?></th>
        <th class="cel_artist"><?php echo Ajax::text('?page=browse&action=set_sort&browse_id=' . $browse->id . '&sort=artist', T_('Artist'),'album_sort_artist'); ?></th>
        <th class="cel_songs"><?php echo T_('Songs'); ?></th>
        <th class="cel_year"><?php echo Ajax::text('?page=browse&action=set_sort&browse_id=' . $browse->id . '&sort=year', T_('Year'),'album_sort_year'); ?></th>
        <th class="cel_tags"><?php echo T_('Tags'); ?></th>
    <?php if (Config::get('ratings')) { ?>
        <th class="cel_rating"><?php echo T_('Rating'); ?></th>
    <?php } ?>
    <?php if (Config::get('userflags')) { ?>
        <th class="cel_userflag"><?php echo T_('Flag'); ?></th>
    <?php } ?>
        <th class="cel_action"><?php echo T_('Actions'); ?></th>
    </tr>
    <?php
    if (Config::get('ratings')) { Rating::build_cache('album',$object_ids); }
    if (Config::get('userflags')) { Userflag::build_cache('album',$object_ids); }

    /* Foreach through the albums */
    foreach ($object_ids as $album_id) {
        $album = new Album($album_id);
        $album->format();
    ?>
    <tr id="album_<?php echo $album->id; ?>" class="<?php echo UI::flip_class(); ?>">
        <?php require Config::get('prefix') . '/templates/show_album_row.inc.php'; ?>
    </tr>
    <?php } //end foreach ($albums as $album) ?>
    <?php if (!count($object_ids)) { ?>
    <tr class="<?php echo UI::flip_class(); ?>">
        <td colspan="7"><span class="nodata"><?php echo T_('No album found'); ?></span></td>
    </tr>
    <?php } ?>
    <tr class="th-bottom">
    <?php if (Config::get('directplay')) { ?>
        <th class="cel_directplay"><?php echo T_('Play'); ?></th>
    <?php } ?>
        <th class="cel_add"><?php echo T_('Add'); ?></th>
    <?php if (Art::is_enabled()) { ?>
        <th class="cel_cover"><?php echo T_('Cover'); ?></th>
    <?php } ?>
        <th class="cel_album"><?php echo Ajax::text('?page=browse&action=set_sort&browse_id=' . $browse->id . '&sort=name', T_('Album'),'album_sort_name_bottom'); ?></th>
        <th class="cel_artist"><?php echo Ajax::text('?page=browse&action=set_sort&browse_id=' . $browse->id . '&sort=artist', T_('Artist'),'album_sort_artist'); ?></th>
        <th class="cel_songs"><?php echo T_('Songs'); ?></th>
        <th class="cel_year"><?php echo Ajax::text('?page=browse&action=set_sort&browse_id=' . $browse->id . '&sort=year', T_('Year'),'album_sort_year_bottom'); ?></th>
        <th class="cel_tags"><?php echo T_('Tags'); ?></th>
    <?php if (Config::get('ratings')) { ?>
        <th class="cel_rating"><?php echo T_('Rating'); ?></th>
    <?php } ?>
    <?php if (Config::get('userflags')) { ?>
        <th class="cel_userflag"><?php echo T_('Flag'); ?></th>
    <?php } ?>
        <th class="cel_action"><?php echo T_('Actions'); ?></th>
    </tr>
</table>
<?php require Config::get('prefix') . '/templates/list_header.inc.php'; ?>
