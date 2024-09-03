<?php

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
