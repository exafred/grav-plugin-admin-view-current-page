<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;

/**
 * Class ViewCurrentPageFromAdminPlugin
 * @package Grav\Plugin
 */
class AdminViewCurrentPagePlugin extends Plugin {

	const SLUG = "admin-view-current-page";

	/**
	 * @return array
	 *
	 * The getSubscribedEvents() gives the core a list of events
	 *     that the plugin wants to listen to. The key of each
	 *     array section is the event that the plugin listens to
	 *     and the value (in the form of an array) contains the
	 *     callable (or function) as well as the priority. The
	 *     higher the number the higher the priority.
	 */
	public static function getSubscribedEvents(): array {
		return [
			'onPluginsInitialized' => [
				// Uncomment following line when plugin requires Grav < 1.7
				// ['autoload', 100000],
				['onPluginsInitialized', 0]
			]
		];
	}

	/**
	 * Composer autoload
	 *
	 * @return ClassLoader
	 */
	public function autoload(): ClassLoader {
		return require __DIR__ . '/vendor/autoload.php';
	}

	/**
	 * Initialize the plugin
	 */
	public function onPluginsInitialized(): void {
		if ($this->isAdmin()) {
			$user = $this->grav['user'] ?? null;

			if (null === $user || !$user->authorize('login', 'admin')) {
				return;
			}

			$this->enable([
				// Put your main events here
				'onAssetsInitialized' => ['onAssetsInitialized', 0],
			]);
		}
	}

	/**
	 * [getLanguageRoute]
	 *
	 * @return string
	 */
	public function getLanguageRoute(): string {
		$page = $this->grav['admin']->page();
		$config = $this->grav['config']['system']['languages'];
		$current_lang = $page->language();
		$lang = '/' . $current_lang;

		if (!$config['include_default_lang'] && $current_lang == $config['default_lang']) {
			$lang = '';
		}

		return $lang;
	}

	/**
	 * [onAssetsInitialized]
	 *
	 * @return void
	 */
	public function onAssetsInitialized() {

		$page = $this->grav['admin']->page();

		// if this is a modular page's child, get the
		// first ancestor that *isn't* the child of a 
		// modular page instead. Modular pages should 
		// only be able to have modules as children,
		// but better safe than sorry?
		$folder = preg_replace("/^\d+\._/", "_", $page->folder());
		while(substr($folder, 0, 1) == "_") {
			$page = $page->parent();
			$folder = preg_replace("/^\d+\._/", "_", $page->folder());
		}
		$route = $this->grav['base_url'] . $page->slug();

		$lang = $this->getLanguageRoute();
		$lang = ($lang == '/') ? '' : $lang;

		// add script for creating the button
		$assets = $this->grav['assets'];
		$assets->addInlineJs('const page_route = "' . $route . '";');
		$assets->addInlineJs('const page_lang = "' . $lang . '";');
		$assets->addJs('plugin://' . self::SLUG . '/assets/add-view-current-page-button.js', [ 'group' => 'bottom' ]);
	}
}
