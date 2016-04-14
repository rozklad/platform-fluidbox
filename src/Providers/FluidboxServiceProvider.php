<?php namespace Sanatorium\Fluidbox\Providers;

use Asset;
use Cartalyst\Support\ServiceProvider;

class FluidboxServiceProvider extends ServiceProvider {

	public function boot()
	{
		$this->prepareResources();

		if ( self::isFrontend() ) {
			Asset::queue('fluidbox', 'sanatorium/fluidbox::js/jquery.fluidbox.js', 'jquery');
			Asset::queue('fluidbox', 'sanatorium/fluidbox::scss/fluidbox.scss');

			foreach( config('sanatorium-fluidbox') as $type => $enabled ) {

				if ( $enabled ) {
					
					Asset::queue('fluidbox-' . $type, 'sanatorium/fluidbox::js/fluidbox-' . $type . '.js', 'fluidbox');
				}

			}
		}
	}

	public function register()
	{

	}

	/**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {
        $config = realpath(__DIR__.'/../../config/config.php');

        $this->mergeConfigFrom($config, 'sanatorium-fluidbox');

        $this->publishes([
            $config => config_path('sanatorium-fluidbox.php'),
        ], 'config');
    }

	/**
	 * @todo make more reliable and universal, maybe globally available
	 * @return boolean [description]
	 */
	public static function isFrontend()
	{
		if ( isset($_SERVER) ) {
			if ( isset($_SERVER['REQUEST_URI']) ) {
				if ( strpos($_SERVER['REQUEST_URI'], '/admin/') === false ) {
					return true;
				}
			}
		}

		return false;
	}

}