<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace local_coursetheme\fakehook;

use course_edit_form;
use local_coursetheme\db\Coursetheme_table;
use MoodleQuickForm;
use stdClass;

/**
 * Class containing fake hooks for the course edit form.
 * @package local_coursetheme
 * @author Daniel Poggenpohl
 */
class FakehookUtils {
    const FORMELEM_THEMESELECTOR = 'themeselector';

    public static function courseform_after_definition_hook(course_edit_form $theform, MoodleQuickForm $mform) {
        $mform->addElement('header', 'coursetheme_header', 'Kursthemes');
        $fakethemes = [
            0 => 'KEINS',
            1 => 'Frosch',
            2 => 'Ochse',
        ];
        $mform->addElement('select', self::FORMELEM_THEMESELECTOR, 'Theme wählen', $fakethemes);
        $mform->setDefault('themeselector', 0);
    }

    public static function courseform_after_definition_after_data_hook(course_edit_form $theform, MoodleQuickForm $mform) {
        global $DB;
        $course = $theform->get_course();
        $courseid = 0;
        if (isset($course->id)) {
            $courseid = $course->id;
        }
        if ($courseid) {
            $params = [
                'courseid' => $courseid,
            ];
            $coursetheme = $DB->get_record(Coursetheme_table::TABLE_NAME, $params);
            if ($coursetheme) {
                $currenttheme = $coursetheme->{Coursetheme_table::FIELD_COURSE_THEME_ID};
                $mform->setDefault(self::FORMELEM_THEMESELECTOR, $currenttheme);
            }
        }
    }

    public static function courseform_after_form_submission(stdClass $data, $isnewcourse = false) {
        global $DB;
        $selectedtheme = $data->{self::FORMELEM_THEMESELECTOR} ?? 0;
        $courseid = $data->id;
        $params = [
            'courseid' => $courseid,
        ];
        $coursetheme = $DB->get_record(Coursetheme_table::TABLE_NAME, $params);
        if (!$coursetheme) {
            $coursetheme = new stdClass();
            $coursetheme->{Coursetheme_table::FIELD_COURSE_ID} = $courseid;
            $coursetheme->{Coursetheme_table::FIELD_COURSE_THEME_ID} = $selectedtheme;
            $coursetheme->{Coursetheme_table::FIELD_COMPONENT_THEME_ID} = 0;
            $DB->insert_record(Coursetheme_table::TABLE_NAME, $coursetheme);
        } else {
            $coursetheme->{Coursetheme_table::FIELD_COURSE_THEME_ID} = $selectedtheme;
            $DB->update_record(Coursetheme_table::TABLE_NAME, $coursetheme);
        }
        // TODO: Also delete records to cleanup, move to DB layer
    }
}
