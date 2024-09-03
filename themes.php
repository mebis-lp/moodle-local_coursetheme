<?php

require_once __DIR__.'/../../config.php';

use local_coursetheme\ui\themelist_table;

global $PAGE;

$PAGE->set_url(new moodle_url('/local/coursetheme/themes.php'));

$PAGE->set_pagelayout('admin');

require_login();
$systemContext = context_system::instance();
$PAGE->set_context($systemContext);

$PAGE->set_title('Kursthemes-Titel');

$PAGE->set_heading('Kursthemes-Heading');

/** @var local_coursetheme_renderer|core_renderer $renderer */
$renderer = $PAGE->get_renderer('local_coursetheme');

echo $renderer->header();

$themeTable = new themelist_table('coursetheme-theme-table');
$themeTable->define_baseurl(new moodle_url('/local/coursetheme/themes.php'));
$themeTable->out(25, false);

echo $renderer->footer();
