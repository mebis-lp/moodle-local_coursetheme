<?php

namespace local_coursetheme\fakehook;

use \course_edit_form;
use local_coursetheme\db\Coursetheme_table;

use MoodleQuickForm;
use stdClass;

class FakehookUtils {

    const FORMELEM_THEMESELECTOR = 'themeselector';

    public static function courseform_after_definition_hook(course_edit_form $theForm, MoodleQuickForm $mform) {
        $mform->addElement('header', 'coursetheme_header', 'Kursthemes');
        $fakethemes = [
            0 => 'KEINS',
            1 => 'Frosch',
            2 => 'Ochse'
        ];
        $mform->addElement('select', self::FORMELEM_THEMESELECTOR, 'Theme wählen', $fakethemes);
        $mform->setDefault('themeselector', 0);

    }

    public static function courseform_after_definition_after_data_hook(course_edit_form $theForm, MoodleQuickForm $mform) {
        global $DB;
        $course = $theForm->get_course();
        if ($course->id) {
            $courseId = $course->id;
        }
        if ($courseId) {
            $params = [
                'courseid' => $courseId
            ];
            $courseTheme = $DB->get_record(Coursetheme_table::TABLE_NAME, $params);
            if ($courseTheme) {
                $currentTheme = $courseTheme->{Coursetheme_table::FIELD_COURSE_THEME_ID};
                $mform->setDefault(self::FORMELEM_THEMESELECTOR, $currentTheme);
            }

        }

    }

    public static function courseform_after_form_submission(stdClass $data, $isNewCourse = false) {
        global $DB;
        $selectedTheme = $data->{self::FORMELEM_THEMESELECTOR};
        $courseId = $data->id;
        $params = [
            'courseid' => $courseId
        ];
        $courseTheme = $DB->get_record(Coursetheme_table::TABLE_NAME, $params);
        if (!$courseTheme) {
            $courseTheme = new stdClass();
            $courseTheme->{Coursetheme_table::FIELD_COURSE_ID} = $courseId;
            $courseTheme->{Coursetheme_table::FIELD_COURSE_THEME_ID} = $selectedTheme;
            $courseTheme->{Coursetheme_table::FIELD_COMPONENT_THEME_ID} = 0;
            $DB->insert_record(Coursetheme_table::TABLE_NAME, $courseTheme);
        } else {
            $courseTheme->{Coursetheme_table::FIELD_COURSE_THEME_ID} = $selectedTheme;
            $DB->update_record(Coursetheme_table::TABLE_NAME, $courseTheme);
        }
        // TODO: Also delete records to cleanup, move to DB layer
    }
}
