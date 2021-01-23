<?php

/**
 * Include ACF Page into plugin.
 *
 */
class ap_acf_admin_page
{
    public function __construct()
    {
        add_action('admin_menu', array( $this, 'admin_menu' ));
    }

    public function admin_menu()
    {
        add_submenu_page(
            'edit.php?post_type=acf-field-group',
            'ACF Data export',
            'ACF Data export',
            'manage_options',
            'ap-acf-import-export',
            array($this, 'admin_page' )
        );
    }


    public function admin_page()
    {
        $plugin_url = menu_page_url('ap-acf-import-export', false);
		$plugin_url = '/wp-admin/edit.php?post_type=post&page=ap-acf-import-export'; 
		
		$output = '<div class="wrap">';
		$output .= '<h2>Data import/export</h2>';
		$output .= '<div class="acfim-container">';

		if (! function_exists('get_field')){
			$output .= '<p>Please install Advanced Custom Fields plugin</p>';
		}
		if (function_exists('get_field')){
			$output .= $this->export($plugin_url);
			$output .= $this->import($plugin_url);
		}

		$output .= '</div>';
		$output .= '</div>';

		echo $output;
    }
    


    public function export($plugin_url)
    {
        $output = '<div class="acfim-section">';
            $output .= '<h3>Export options</h3>';
            $output .= '<form method="post" enctype="multipart/form-data" action="'. $plugin_url .'&export">';
                $output .= '<p>Comma separated list of all option field names. (Repeaters are accepted too)</p>';
                $output .= '<input type="text" name="options" size="50" required/>';
                $output .= get_submit_button('Export');
            $output .= '</form>';
        $output .= '</div>';

        return $output;
    }




    public function import($plugin_url)
    {
        $output = '<div class="acfim-section">';
        $output .= '<form method="post" enctype="multipart/form-data" action="'. $plugin_url .'&import">';
        $output .= '<h3>Import options</h3>';
        $output .= '<p>File MUST be called options.json</p>';
        $output .= '<input type="file" name="backup" required />';
        $output .= get_submit_button('Upload file and import');

        if (isset($_GET['imported']) && $_GET['imported'] == 1) {
            $output .= '<p>Options successfully imported.</p>';
        }

        if (isset($_GET['imported']) && $_GET['imported'] == 2) {
            $output .= '<p>Some error happened during the upload process.</p>';
        }
            
        $output .= '<p class="acfim-info">Your current options WILL be overwritten</p>';
        $output .= '</form>';
        $output .= '</div>';
        
        return $output;
    }
}
