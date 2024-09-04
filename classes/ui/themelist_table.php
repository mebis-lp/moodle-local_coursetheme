<?php

namespace local_coursetheme\ui;

defined('MOODLE_INTERNAL') || die;

global $CFG;

require_once($CFG->libdir . '/tablelib.php');

use core_table\dynamic;
use local_coursetheme\db\Theme_table;
use \moodle_url;

/**
 * Author: Daniel Poggenpohl
 * Date: 03.09.2024
 */
class themelist_table extends \table_sql {

    function __construct($uniqueid) {
        parent::__construct($uniqueid);
        // Define the list of columns to show.

        $columns = array(Theme_table::FIELD_ID, Theme_table::FIELD_NAME, Theme_table::FIELD_DISPLAYNAME, 'editaction');
        $this->define_columns($columns);
        $this->set_hidden_columns([Theme_table::FIELD_ID]);
        $this->no_sorting('editaction');

        // Define the titles of columns to show in header.
        $headers = array('Id', 'Kurzname', 'Anzeigename', 'Aktion');
        $this->define_headers($headers);
        $this->set_sql(
            '*',
            '{'.Theme_table::TABLE_NAME.'}',
            '1 = 1'
        );
    }

    function has_capability() {
        return true;
    }

    function col_editaction($values) {
        $themeId = $values->{Theme_table::FIELD_ID};
        $url = new moodle_url('/local/coursetheme/edittheme.php', ['id' => $themeId]);
        $buttonHtml = '<span><a href="'.$url->out().'">Editieren</a></span>';
        return $buttonHtml;
    }
}
