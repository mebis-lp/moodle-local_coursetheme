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

// install code for mocking up some course themes

use local_coursetheme\db\Theme_table;
use local_coursetheme\utils\Themetype;

function xmldb_local_coursetheme_install() {
    global $CFG, $DB;
    $frogtheme = new stdClass();
    $frogtheme->{Theme_table::FIELD_ID} = 1;
    $frogtheme->{Theme_table::FIELD_NAME} = 'frosch';
    $frogtheme->{Theme_table::FIELD_TYPE} = Themetype::COURSE;
    $frogtheme->{Theme_table::FIELD_DISPLAYNAME} = 'Ein Froschtheme';
    $frogtheme->{Theme_table::FIELD_CSS} = 'FIXME';
    $frogtheme->{Theme_table::FIELD_js} = 'FIXME';
    $DB->insert_record(Theme_table::TABLE_NAME, $frogtheme);

    $bulltheme = new stdClass();
    $bulltheme->{Theme_table::FIELD_ID} = 2;
    $bulltheme->{Theme_table::FIELD_NAME} = 'bull';
    $bulltheme->{Theme_table::FIELD_TYPE} = Themetype::COURSE;
    $bulltheme->{Theme_table::FIELD_DISPLAYNAME} = 'Ein Ochsentheme';
    $bulltheme->{Theme_table::FIELD_CSS} = 'FIXME';
    $bulltheme->{Theme_table::FIELD_js} = 'FIXME';
    $DB->insert_record(Theme_table::TABLE_NAME, $bulltheme);
}
