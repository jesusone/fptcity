<?php
  class zo_webservice extends stdClass {
    public $params;  
    public  function __construct(){
            //Add Routers
            $atts = array(
                /* Api Tin Tuc*/
                array(
                    'namespace' => 'zo_news',
                    'routename' => '/news/',
                    'methods' => 'GET',
                    'callback' => 'zo_get_lists_news',
               
                ),
               array(
                    'namespace' => 'zo_news',
                    'routename' => 'new',
                    'methods' => 'GET',
                    'callback' => 'zo_get_new_detail',
                ),
                 array(
                    'namespace' => 'zo_news',
                    'routename' => 'categories',
                    'methods' => 'GET',
                    'callback' => 'zo_get_list_categories',
                ),
                 

            );
        $this->zo_register_router($atts);
    }  
    /* Register   */
    public function zo_register_router($params){
                    
          if(!empty($params)){
                  set_query_var('zo_params',$params);        
                  add_action( 'rest_api_init', function () {
                     $params = get_query_var('zo_params');
                      
                    foreach($params as $router){
                         register_rest_route( $router['namespace'], $router['routename'],  array(
                            'methods' => $router['methods'],
                            'callback' => $router['callback'],
                        ) );
                       }
                     
                        } );
                 
              }
         
           
    }
  
     
  }
?>
