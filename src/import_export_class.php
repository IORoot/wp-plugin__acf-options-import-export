<?php

if (! defined('ABSPATH')) {
    return;
} // Exit if accessed directly

use ap_acf_admin_page as adminpage;

class ap_acf_import_export
{
    private $plugin_path;
    
    public $wp_options_search = array();

    public function __construct()
    {
        $this->plugin_path = plugin_dir_path(__FILE__);
        
        new adminpage;
        add_action('admin_init', array( $this, 'import_options' ));
        add_action('admin_init', array( $this, 'exports_options' ));
    }

    

    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                                                                         │░
    // │                                                                         │░
    // │                                EXPORTER                                 │░
    // │                                                                         │░
    // │                                                                         │░
    // └─────────────────────────────────────────────────────────────────────────┘░
    //  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    public function exports_options()
    {

        if (isset($_GET['export']) && isset($_GET['page']) && $_GET['page'] == 'ap-acf-import-export' && isset($_POST['options'])) {

            $this->csv_to_query($_POST['options']);

            $acf_fields = $this->export_from_db();

            if (!$acf_fields){
                echo 'no option fields selected';
                exit;
            }

            $json = '';
            $json = json_encode($acf_fields);

            if ($json == ''){
                exit;
            }

            file_put_contents($this->plugin_path . 'temp/options.json', $json);
            $file = $this->plugin_path . 'temp/options.json';

            $this->send_to_file($file);
            
            $this->delete_files();

            exit;
        }
    }

    public function csv_to_query($csv_string)
    {
        $csv_string = str_replace(' ', '', $csv_string);

        $query_array = str_getcsv($csv_string);

        if (!isset($query_array)){
            return;
        }

        foreach ($query_array as $key => $option)
        {
            $query_array[$key] = '%'.$option.'%';
        }

        if (!isset($query_array)){
            return;
        }

        $this->wp_options_search = $query_array;
    }



    public function export_from_db()
    {

        if (empty($this->wp_options_search)) {
            return false;
        }

        global $wpdb;
        
        $sql_statement = $this->create_sql_statement($wpdb);
        
        $prepared_statement = $wpdb->prepare($sql_statement, $this->wp_options_search);

        $acf_fields = $wpdb->get_results($prepared_statement);

        return $acf_fields;
    }
    
    

    public function create_sql_statement($wpdb)
    {
        $sql_statement = "SELECT option_name, option_value FROM $wpdb->options WHERE ";

        $numItems = count($this->wp_options_search);
        $i = 0;

        foreach ($this->wp_options_search as $item) {
            $sql_statement .= " option_name LIKE %s";

            if (++$i !== $numItems) {
                $sql_statement .= " OR ";
            }
        }

        return $sql_statement;
    }



    public function send_to_file($filename)
    {
        if (file_exists($filename)) {

            //Get file type and set it as Content Type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            header('Content-Type: ' . finfo_file($finfo, $filename));
            finfo_close($finfo);
        
            //Use Content-Disposition: attachment to specify the filename
            header('Content-Disposition: attachment; filename='.basename($filename));
        
            //No cache
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
        
            //Define file size
            header('Content-Length: ' . filesize($filename));
        
            ob_clean();
            flush();
            readfile($filename);
            // exit;
        }
    }
    


    public function delete_files()
    {
        $files = glob($this->plugin_path . '/temp/options*');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }





    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                                                                         │░
    // │                                                                         │░
    // │                                IMPORTER                                 │░
    // │                                                                         │░
    // │                                                                         │░
    // └─────────────────────────────────────────────────────────────────────────┘░
    //  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    public function import_options()
    {
        if (isset($_GET['import']) && isset($_GET['page']) && $_GET['page'] == 'ap-acf-import-export') {
            $plugin_url = menu_page_url('ap-acf-import-export', false);
            
            if (! empty($_FILES['backup'])) {
                $target_dir  = $this->plugin_path . 'temp/';
                $target_file = $target_dir . basename($_FILES['backup']['name']);
                
                if (move_uploaded_file($_FILES['backup']['tmp_name'], $target_file)) {
                    WP_Filesystem();
                        
                    if (is_wp_error($target_file)) {
                        wp_redirect($plugin_url . '&imported=2');
                        die();
                    }
                    if (! file_exists($this->plugin_path . '/temp/options.json')) {
                        wp_redirect($plugin_url . '&imported=2');
                        die();
                    }

                    $json 	  = file_get_contents($this->plugin_path . '/temp/options.json');
                    $options  = json_decode($json, true);

                    foreach ($options as $option) {
                        $this->insert_option($option);
                    }

                    $this->delete_files();
                }
            }
            
            // unzip_file()
            wp_redirect($plugin_url . '&imported=1');
            die();
        }
    }
    
    

    public function insert_option($option)
    {
        update_option($option['option_name'], $option['option_value'], null, 'no');
    }
}

new ap_acf_import_export();
