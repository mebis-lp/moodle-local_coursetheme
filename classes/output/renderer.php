<?php
/**
 * Author: Daniel Poggenpohl
 * Date: 08.07.2019
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Renderer for degree programs elements
 */
class local_coursetheme_renderer extends plugin_renderer_base {

	private function getTemplateReference($templateName) {
		return '/'.$templateName;
	}

}
