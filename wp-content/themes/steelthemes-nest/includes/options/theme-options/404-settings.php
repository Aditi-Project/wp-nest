<?php
/*
====================
404 Settings
====================
*/
Redux::setSection( $opt_name, array(
            'title'  => esc_html__( '404 Settings', 'steelthemes-nest' ),
            'id'     => 'fournotfour_settings',
            'desc'   => esc_html__( '', 'steelthemes-nest' ),
            'icon'   => 'el el-check-empty',
            'fields' => array(
              
                array(
                    'id'       => '404_image',
                    'type'     => 'media', 
                    'url'      => true,
                    'title'    => __('404 Image', 'steelthemes-nest'), 
                ),
                array(
                    'id'       => 'bg_error_images',
                    'type'     => 'media', 
                    'url'      => true,
                    'title'    => __('404 Background Image', 'steelthemes-nest'), 
                ),
                array(         
                    'id'       => 'bg_error_color',
                    'type'     => 'background',
                    'title'    => __('404 Backgrounds', 'steelthemes-nest'),
                    'background-image' => false ,
                    'subtitle' => __('404 background with color, etc.', 'steelthemes-nest'),
                    'output'    => array('.error404'),
                ),
                array(
                    'id'       => 'fn_title_color',
                    'type'     => 'color',
                    'title'    => __('404 Title Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('.main.page-404 .title_no_a_24'),
                ),
                array(
                    'id'       => 'fn_des_color',
                    'type'     => 'color',
                    'title'    => __('404 Description Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('.main.page-404 p'),
                ),
                
                array(
                    'id'       => 'fn_search_text_color',
                    'type'     => 'color',
                    'title'    => __('404 Search Input Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    =>   array('color' => '.main.page-404 form input::placeholder , .main.page-404 form input , .main.page-404 form i'),
                ),
                array(
                    'id'       => 'fn_search_br_color',
                    'type'     => 'color',
                    'title'    => __('404 Search Border Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('border-color' => '.main.page-404 form input'),
                ),
                array(
                    'id'       => 'fn_search_tbgcolor',
                    'type'     => 'color',
                    'title'    => __('404 Search Background Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('background' => '.main.page-404 form input'),
                ),
                array(
                    'id'       => 'fn_search_bcolcolor',
                    'type'     => 'color',
                    'title'    => __('404 Search Btn  Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('.main.page-404 form .sch_btn'),
                ),
                array(
                    'id'       => 'fn_search_btngcolor',
                    'type'     => 'color',
                    'title'    => __('404 Search Btn Background Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('background' =>'.main.page-404 form .sch_btn'),
                ), 
                array(
                    'id'       => 'fn_search_brcolor',
                    'type'     => 'color',
                    'title'    => __('404 Search Btn Border Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('border-color' =>'.main.page-404 form .sch_btn'),
                ), 
                array(
                    'id'       => 'fn_backtohomecolor',
                    'type'     => 'color',
                    'title'    => __('404 Back to Home Button Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('.main.page-404 .btn'),
                ),
                array(
                    'id'       => 'fn_backtohomebgcolor',
                    'type'     => 'color',
                    'title'    => __('404 Back to Home Background Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('background' =>'.main.page-404 .btn'),
                ),
                array(
                    'id'       => 'fn_backtohomebrcolor',
                    'type'     => 'color',
                    'title'    => __('404 Back to Home Border Color', 'steelthemes-nest'),  
                    'validate' => 'color', 
                    'output'    => array('border-color' =>'.main.page-404 .btn'),
                ),
            )
        )
    );