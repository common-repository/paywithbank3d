<?php

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class paymentTable extends  WP_List_Table {

    public function prepare_items()
    {
        $post_id = sanitize_text_field($_GET['form']);
        $currency = get_post_meta($post_id, 'pwb3d_currency', true);

        global $wpdb;

        $table = $wpdb->prefix . PWB3D_DB_TABLE;
        $data = array();
        $alldbdata = $wpdb->get_results("SELECT * FROM $table WHERE (pwb3d_id = '" . $post_id . "' AND paid = '1')");

        foreach ($alldbdata as $key => $dbdata) {
            $newkey = $key + 1;
            $data[] = array(
                'id'  => $newkey,
                'email' => '<a href="mailto:' . $dbdata->email . '">' . $dbdata->email . '</a>',
                'amount' => $currency . '<b>' . number_format($dbdata->amount) . '</b>',
                'txn_code' => $dbdata->txn_code,
                'metadata' => $this->format_data($dbdata->metadata),
                'date'  => $dbdata->created_at
            );
        }

        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        usort($data, array(&$this, 'sort_data'));
        $perPage = 20;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->set_pagination_args(
            array(
                'total_items' => $totalItems,
                'per_page'    => $perPage
            )
        );
        $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;

        $rows = count($alldbdata);
        return $rows;
    }

    public function get_columns()
    {
        $columns = array(
            'id'  => '#',
            'email' => 'Email',
            'amount' => 'Amount',
            'txn_code' => 'Reference',
            'metadata' => 'Data',
            'date'  => 'Date'
        );
        return $columns;
    }
    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }
    public function get_sortable_columns()
    {
        return array('email' => array('email', false), 'date' => array('date', false), 'amount' => array('amount', false));
    }
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data($data)
    {
        return $data;
    }
    /**
     * Define what data to show on each column of the table
     *
     * @param Array  $item        Data
     * @param String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'email':
            case 'amount':
            case 'txn_code':
            case 'metadata':
            case 'date':
                return $item[$column_name];
            default:
                return print_r($item, true);
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @param $a
     * @param $b
     *
     * @return Mixed
     */
    private function sort_data($a, $b)
    {
        $orderby = 'date';
        $order = 'desc';
        if (!empty($_GET['orderby'])) {
            $orderby = sanitize_text_field($_GET['orderby']);
        }
        if (!empty($_GET['orderby'])) {
            $order = sanitize_text_field($_GET['orderby']);
        }
        $result = strcmp($a[$orderby], $b[$orderby]);
        if ($order === 'asc') {
            return $result;
        }
        return -$result;
    }

    private function format_data($data)
    {
        //var_dump($data);
        $new = json_decode($data);
        //var_dump(count($new));
        $text = '';
        if (array_key_exists("0", $new)) {
            foreach ($new as $key => $item) {
                if($item->display_name == 'Pwb3d-currency') {
                    $display_name = 'Currency';
                } else if($item->display_name == 'Pwb3d-minimum-hidden'){
                    $display_name ='Minimun';
                } else if($item->display_name == 'Pwb3d Agreement'){
                    $display_name = 'Agreement';
                } else {
                    $display_name = $item->display_name;
                }
                if ($item->type == 'text') {
                    $text .= '<b>' . $display_name . ": </b> " . ucwords($item->value) . "<br />";
                } else {
                    $text .= '<b>' . $display_name . ": </b>  <a target='_blank' href='" . ucwords($item->value) . "'>link</a><br />";
                }
            }
        } else {
            $text = '';
            if (count($new) > 0) {
                foreach ($new as $key => $item) {
                    $text .= '<b>' . $key . ": </b> " . $item . "<br />";
                }
            }
        }
        //
        return $text;
    }
}