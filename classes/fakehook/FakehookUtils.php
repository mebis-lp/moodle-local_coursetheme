<?php

namespace local_coursetheme\fakehook;

use \course_edit_form;
use MoodleQuickForm;

class FakehookUtils {

    public static function courseform_after_definition_hook(course_edit_form $theForm, MoodleQuickForm $mform) {
        $mform->addElement('header', 'coursetheme_header', 'Kursthemes');
        $mform->addElement('static', 'test', 'Teststring');
        $fakethemes = [
            0 => 'KEINS',
            1 => 'Frosch',
            2 => 'Ochse'
        ];
        $mform->addElement('select', 'themeselector', 'Theme wählen', $fakethemes);
        $mform->setDefault('themeselector', 'KEINS');
    }

    public static function courseform_after_submit_hook(course_edit_form $theForm, MoodleQuickForm $mForm) {
        // FIXME: Save submitted coursetheme data to database
    }
}
