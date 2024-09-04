<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Basic lib file for local_coursetheme.
 *
 * @package   local_coursetheme
 * @copyright 2024 ISB Bayern
 * @author    Philipp Memmel
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use local_coursetheme\db\Theme_table;
use local_coursetheme\db\Coursetheme_table;

function local_coursetheme_before_footer() {
    global $PAGE, $COURSE, $DB;
    $courseId = $COURSE->id;
    if (!$courseId) return;
    $coursetheme = $DB->get_record(Coursetheme_table::TABLE_NAME, ['courseid' => $courseId]);
    if (!$coursetheme) return;
    $themeId = $coursetheme->{Coursetheme_table::FIELD_COURSE_THEME_ID};
    if (!$themeId) return;
    $theme = $DB->get_record(Theme_table::TABLE_NAME, ['id' => $themeId]);
    if (!$theme) return;
    $css = $theme->{Theme_table::FIELD_CSS};
    $js = $theme->{Theme_table::FIELD_js};

    if ($css) {
        echo '<style>';
        echo $css;
        echo '</style>';
    }
    if ($js) {
        echo $js;
    }
}
