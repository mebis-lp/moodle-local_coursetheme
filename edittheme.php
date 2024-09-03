<?php

require_once __DIR__.'/../../config.php';

use local_coursetheme\ui\edit_theme_form;
use local_coursetheme\db\Theme_table;

global $DB, $PAGE;

$id = required_param('id', PARAM_INT); // Theme id.

$pageurl = new moodle_url('/local/coursetheme/edittheme.php', ['id' => $id]);
$PAGE->set_url($pageurl);

$PAGE->set_pagelayout('report');

require_login();
$systemContext = context_system::instance();
$PAGE->set_context($systemContext);

$PAGE->set_title('Theme editieren');

$PAGE->set_heading('Theme X editieren');

/** @var local_coursetheme_renderer|core_renderer $renderer */
$renderer = $PAGE->get_renderer('local_coursetheme');

echo $renderer->header();

$theme = $DB->get_record(Theme_table::TABLE_NAME,['id' => $id]);
$themeForm = new edit_theme_form(null, ['id'=> $id]);

$returnurl = new moodle_url('/local/coursetheme/themes.php');

if ($themeForm->is_cancelled()) {
    // The form has been cancelled, take them back to what ever the return to is.
    redirect($returnurl);
} else if ($data = $themeForm->get_data()) {
    global $DB;
    $DB->update_record(Theme_table::TABLE_NAME, $data);
    redirect($returnurl);
}

$themeForm->display();

echo $renderer->footer();
