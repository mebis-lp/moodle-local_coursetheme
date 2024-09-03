<?php

namespace local
use \course_edit_form;

class FakehookUtils {

    public static function courseform_after_definition_hook(course_edit_form $theForm, $mform) {
        $mform->addElement('static', 'test', 'Teststring');

    }
}
