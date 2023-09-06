<?php

class UserFeedback_Aioseo_Integration extends UserFeedback_Plugin_Integration {

	/**
	 * @inheritdoc
	 */
	protected static $slug = 'all-in-one-seo-pack/all_in_one_seo_pack.php';

	/**
	 * @inheritdoc
	 */
	protected $name = 'all-in-one-seo-pack';

	/**
	 * @inheritdoc
	 */
	public function get_basename() {
		return 'all-in-one-seo-pack/all_in_one_seo_pack.php';
	}
}

new UserFeedback_Aioseo_Integration();
