<?php
defined('MOODLE_INTERNAL') || die();

/** @var bool $hassiteconfig */
if ($hassiteconfig) {
    /** @var admin_root $ADMIN */
    $ADMIN->add('users', new admin_externalpage(
        'local_coursetheme',
        'Kursthemes-Liste',
        new moodle_url('/local/coursetheme/themes.php')
    ));
//    $ADMIN->add(
//        $feuUsersCategory->name,
//        new admin_externalpage(
//            DegreeProgramConstants::getPluginName(),
//            DegreeProgramLocalization::getPluginString(
//                DegreeProgramLocalization::NAVIGATION_VIEW_DEGREE_PROGRAMS
//            ),
//            ViewDegreeProgramsPage::getMoodleUrl()
//        )
//    );
}
