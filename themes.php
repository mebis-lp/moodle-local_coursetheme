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

use local_coursetheme\ui\themelist_table;

global $PAGE;

$PAGE->set_url(new moodle_url('/local/coursetheme/themes.php'));

$PAGE->set_pagelayout('admin');

require_login();
$systemcontext = context_system::instance();
$PAGE->set_context($systemcontext);

$PAGE->set_title('Kursthemes-Titel');

$PAGE->set_heading('Kursthemes-Heading');

/** @var local_coursetheme_renderer|core_renderer $renderer */
$renderer = $PAGE->get_renderer('local_coursetheme');

echo $renderer->header();

$themetable = new themelist_table('coursetheme-theme-table');
$themetable->define_baseurl(new moodle_url('/local/coursetheme/themes.php'));
$themetable->out(25, false);

echo $renderer->footer();
