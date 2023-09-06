<?php
/**
 * Plugin Name: Lightbox block
 * Description: Lightbox block is an excellent choice for your WordPress Lightbox Block.
 * Version: 1.1.0
 * Author: bPlugins LLC
 * Author URI: http://bplugins.com
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: lightbox
 */

// ABS PATH
if ( !defined( 'ABSPATH' ) ) { exit; }

// Constant
define( 'LBB_PLUGIN_VERSION', 'localhost' === $_SERVER['HTTP_HOST'] ? time() : '1.1.0' );
define( 'LBB_ASSETS_DIR', plugin_dir_url( __FILE__ ) . 'assets/' );
define( 'LBB_DIR', plugin_dir_url( __FILE__ ));

if(!function_exists('lbb_init')){
    function lbb_init(){
        global $lbb_bs;
        require_once(plugin_dir_path(__FILE__).'bplugins_sdk/init.php');
        $lbb_bs = new BPlugins_SDK(__FILE__);
    }
    lbb_init();
}else {
	$lbb_bs->uninstall_plugin(__FILE__);
}

// Light Box
class lbbLightBox{
	
	function __construct(){
		add_action( 'enqueue_block_assets', [$this, 'enqueueBlockAssets'] );
		add_action( 'init', [$this, 'onInit'] );
	}

	function enqueueBlockAssets(){
		wp_register_style( 'lbb-fancyapps', LBB_ASSETS_DIR . 'css/fancyapps.min.css', [], LBB_PLUGIN_VERSION );
		wp_register_style( 'lbb-fontawesome', LBB_ASSETS_DIR . 'css/fontAwesome.min.css', [], LBB_PLUGIN_VERSION );
		wp_register_script( 'lbb-fancyapps', LBB_ASSETS_DIR . 'js/fancyapps.min.js', [], LBB_PLUGIN_VERSION );

		wp_register_script( 'lbb-script', LBB_DIR . 'dist/script.js', ['react', 'react-dom', 'lbb-fancyapps', 'wp-blocks'], LBB_PLUGIN_VERSION );

		wp_register_style( 'lbb-style', plugins_url( 'dist/style.css', __FILE__ ), ['lbb-fancyapps', 'lbb-fontawesome' ], LBB_PLUGIN_VERSION ); // Frontend Style
			
	}

	function onInit() {
		wp_register_style( 'lbb-lightbox-editor-style', plugins_url( 'dist/editor.css', __FILE__ ), [ 'wp-edit-blocks','lbb-style' ], LBB_PLUGIN_VERSION ); // Backend Style

		register_block_type( __DIR__, [
			'editor_style'		=> 'lbb-lightbox-editor-style',
			'render_callback'	=> [$this, 'render']
		] ); // Register Block

		wp_set_script_translations( 'lbb-lightbox-editor-script', 'lightbox', plugin_dir_path( __FILE__ ) . 'languages' ); // Translate
	}

	function render( $attributes ){

		extract( $attributes );
		$className = $className ?? '';
		$lbbBlockClassName = 'wp-block-lbb-lightbox ' . $className . ' align' . $align;

		wp_enqueue_style( 'lbb-style' );
		wp_enqueue_script( 'lbb-script' );

		ob_start();

		$contentBlock = [];

		foreach($attributes['items'] as $index => $item){
			if($item['type'] === 'content'){
				$blocks = parse_blocks($item['content']);
				$content = '';
				foreach($blocks as $block){
					$content .= render_block( $block );
				}
				$contentBlock[$index] = $content;
			}
		}
		?>
	<div>
		<div class='<?php echo esc_attr( $lbbBlockClassName ); ?>' id='lbbLightBox-<?php echo esc_attr( $cId ) ?>' data-attributes='<?php echo esc_attr( wp_json_encode( $attributes ) ); ?>' data-content-indexs="<?php echo esc_attr(wp_json_encode(array_keys($contentBlock))) ?>"></div>
				<?php
					foreach($contentBlock as $index => $block){
						?>
							<div class="lbbItemContent" id="content-<?php echo esc_attr($cId .'-'. $index) ?>">
								<?php echo wp_kses_post($block); ?>
							</div>	
						<?php
					}
				?>
	</div>
		<?php return ob_get_clean();
	} // Render
}
new lbbLightBox();
