<?php

// install code for mocking up some course themes

use local_coursethemes\db\Coursetheme_themes_table;
use local_coursetheme\utils\Themetype;

function xmldb_local_coursetheme_install() {
    global $CFG, $DB;
    $frogtheme = new stdClass();
    $frogtheme->{Coursetheme_themes_table::FIELD_ID} = 1;
    $frogtheme->{Coursetheme_themes_table::FIELD_NAME} = 'frosch';
    $frogtheme->{Coursetheme_themes_table::FIELD_TYPE} = Themetype::COURSE;
    $frogtheme->{Coursetheme_themes_table::FIELD_DISPLAYNAME} = 'Ein Froschtheme';
    $frogtheme->{Coursetheme_themes_table::FIELD_CSS} = 'FIXME';
    $frogtheme->{Coursetheme_themes_table::FIELD_js} = 'FIXME';
    $DB->insert_record(Coursetheme_themes_table::TABLE_NAME, $frogtheme);

    $bulltheme = new stdClass();
    $bulltheme->{Coursetheme_themes_table::FIELD_ID} = 2;
    $bulltheme->{Coursetheme_themes_table::FIELD_NAME} = 'bull';
    $bulltheme->{Coursetheme_themes_table::FIELD_TYPE} = Themetype::COURSE;
    $bulltheme->{Coursetheme_themes_table::FIELD_DISPLAYNAME} = 'Ein Ochsentheme';
    $bulltheme->{Coursetheme_themes_table::FIELD_CSS} = 'FIXME';
    $bulltheme->{Coursetheme_themes_table::FIELD_js} = 'FIXME';
    $DB->insert_record(Coursetheme_themes_table::TABLE_NAME, $bulltheme);
}
