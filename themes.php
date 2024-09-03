<?php

require_once __DIR__.'/../../config.php';

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

echo 'FIXME Themeliste mit Bearbeiten-Knöpfen';

echo $renderer->footer();
