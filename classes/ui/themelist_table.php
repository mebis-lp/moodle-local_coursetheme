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

namespace local_coursetheme\ui;

defined('MOODLE_INTERNAL') || die;

global $CFG;

require_once($CFG->libdir . '/tablelib.php');

use local_coursetheme\db\Theme_table;
use moodle_url;

/**
 * @author Daniel Poggenpohl
 * @package local_coursetheme
 */
class themelist_table extends \table_sql {
    function __construct($uniqueid) {
        parent::__construct($uniqueid);
        // Define the list of columns to show.

        $columns = [Theme_table::FIELD_ID, Theme_table::FIELD_NAME, Theme_table::FIELD_DISPLAYNAME, 'editaction'];
        $this->define_columns($columns);
        $this->set_hidden_columns([Theme_table::FIELD_ID]);
        $this->no_sorting('editaction');

        // Define the titles of columns to show in header.
        $headers = ['Id', 'Kurzname', 'Anzeigename', 'Aktion'];
        $this->define_headers($headers);
        $this->set_sql(
            '*',
            '{' . Theme_table::TABLE_NAME . '}',
            '1 = 1'
        );
    }

    function has_capability() {
        return true;
    }

    function col_editaction($values) {
        $themeid = $values->{Theme_table::FIELD_ID};
        $url = new moodle_url('/local/coursetheme/edittheme.php', ['id' => $themeid]);
        $buttonhtml = '<span><a href="' . $url->out() . '">Editieren</a></span>';
        return $buttonhtml;
    }
}
