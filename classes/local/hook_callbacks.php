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

namespace local_coursetheme\local;

use local_coursetheme\fakehook\FakehookUtils;

/**
 * Hook listener callbacks.
 *
 * @package    local_coursetheme
 * @copyright  2024 ISB Bayern
 * @author     Tobias Garske
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hook_callbacks {
    /**
     * Add a checkbox to add a ai-chat block.
     *
     * @param after_form_definition $hook
     */
    public static function handle_after_form_definition(\core_course\hook\after_form_definition $hook): void {
        $mform = $hook->mform;
        $formwrapper = $hook->formwrapper;
        FakehookUtils::courseform_after_definition_hook($formwrapper, $mform);
    }

    /**
     * Check for addaichat form setting and add/remove ai-chat blockk.
     *
     * @param after_form_submission $hook
     */
    public static function handle_after_form_submission(\core_course\hook\after_form_submission $hook): void {
        global $DB;
        // Get form data.
        $data = $hook->get_data();
        $isnewcourse = $hook->isnewcourse;
        FakehookUtils::courseform_after_form_submission($data, $isnewcourse);
    }

    /**
     * Check if block instance is present and set addaichat form setting.
     *
     * @param after_form_submission $hook
     */
    public static function handle_after_form_definition_after_data(\core_course\hook\after_form_definition_after_data $hook): void {
        // Get form data.
        $mform = $hook->mform;
        $formwrapper = $hook->formwrapper;
        FakehookUtils::courseform_after_definition_after_data_hook($formwrapper, $mform);
    }


    /**
     * Insert a chatbot floating button on pagetypes which are defined in the related admin setting.
     *
     * @param \core\hook\output\before_footer_html_generation $hook the before footer html generation hook object
     */
    public static function handle_before_footer_html_generation(\core\hook\output\before_footer_html_generation $hook): void {
        global $COURSE, $DB;
        $courseid = $COURSE->id;
        if (!$courseid) {
            return;
        }
        $coursetheme = $DB->get_record(\local_coursetheme\db\Coursetheme_table::TABLE_NAME, ['courseid' => $courseid]);
        if (!$coursetheme) {
            return;
        }
        $themeid = $coursetheme->{\local_coursetheme\db\Coursetheme_table::FIELD_COURSE_THEME_ID};
        if (!$themeid) {
            return;
        }
        $theme = $DB->get_record(\local_coursetheme\db\Theme_table::TABLE_NAME, ['id' => $themeid]);
        if (!$theme) {
            return;
        }
        $css = $theme->{\local_coursetheme\db\Theme_table::FIELD_CSS};
        $js = $theme->{\local_coursetheme\db\Theme_table::FIELD_js};

        if ($css) {
            echo '<style>';
            echo $css;
            echo '</style>';
        }
        if ($js) {
            echo $js;
        }
    }
}
