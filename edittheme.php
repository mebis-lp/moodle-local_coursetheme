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

require_once __DIR__ . '/../../config.php';

use local_coursetheme\ui\edit_theme_form;
use local_coursetheme\db\Theme_table;

global $DB, $PAGE;

$id = required_param('id', PARAM_INT); // Theme id.

$pageurl = new moodle_url('/local/coursetheme/edittheme.php', ['id' => $id]);
$PAGE->set_url($pageurl);

$PAGE->set_pagelayout('report');

require_login();
$systemcontext = context_system::instance();
$PAGE->set_context($systemcontext);

$PAGE->set_title('Theme editieren');

$PAGE->set_heading('Theme X editieren');

/** @var local_coursetheme_renderer|core_renderer $renderer */
$renderer = $PAGE->get_renderer('local_coursetheme');

$theme = $DB->get_record(Theme_table::TABLE_NAME, ['id' => $id]);
$themeform = new edit_theme_form(null, ['id' => $id]);

$returnurl = new moodle_url('/local/coursetheme/themes.php');

if ($themeform->is_cancelled()) {
    // The form has been cancelled, take them back to what ever the return to is.
    redirect($returnurl);
} else if ($data = $themeform->get_data()) {
    global $DB;
    $DB->update_record(Theme_table::TABLE_NAME, $data);
    redirect($returnurl);
}

echo $renderer->header();

$themeform->display();

echo $renderer->footer();
