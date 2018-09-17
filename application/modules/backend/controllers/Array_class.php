<?php
/**
 * Created by PhpStorm.
 * User: jsp-thanh
 * Date: 9/13/18
 * Time: 8:07 PM
 */

class Array_class extends MY_Controller
{
    // properties here
    public function __construct()
    {
        parent::__construct();
    }

    public function dos()
    {
        $states = array('az' => 'Arizona', 'al' => 'Alabama');

        array_map(function ($short, $long) {
            return array(
                'short' => $short,
                'long' => $long
            );
        }, array_keys($states), $states);

        // produces:
        array(
            array('short' => 'az', 'long' => 'Arizona'),
            array('short' => 'al', 'long' => 'Alabama')
        );
    }

    public function doCombine()
    {
        $names = array('Thanh', 'Tien', 'Quoc', 'Ha');
        $ages = array(23, 31, 22, 11);
        $arrayCombine = array_combine($names, $ages);
        echo "<pre>";
        //print_r($arrayCombine);
        print_r(array_flip($arrayCombine)); // revert vitri
        echo "</pre>";
        die;
//        Array (
//            [Thanh] => 23
//            [Tien] => 31
//            [Quoc] => 22
//            [Ha] => 11
//        )

    }

    public function doList()
    {
        $arrs = array('ac', 'ba', 'ca', 'da');
        // without list
//        $a= $arrs[33];
//        $b= $arrs[44];
//        $c= $arrs[55];
//        $d= $arrs[66];

        // using list()
        list($a, $b, $c, $d) = $arrs;
        /*echo "<pre>";
        print_r($a);
        print_r($b);
        print_r($c);
        echo "</pre>";die;*/

        $configs = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'pass',
                'label' => 'Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'passconf',
                'label' => 'Password conf',
                'rules' => 'trim|required|matches[pass]'
            ),
            array(
                'field' => 'checkbox',
                'label' => '',
                'rules' => ''
            ),
        );

        $posts = array(
            'email' => 'this@email',
            'pass' => 'zxcz',
        );

        $fields = array();
        foreach ($configs as $config) {
            //list($a[])=array_values($config);
            $key = $config['field'];

            list($b, $c, $fields[$key]) = array_values($config);
            echo "<pre>";
            print_r($fields);
            echo "</pre>";
            die;
            if (array_diff_key($fields, $posts)) {
                unset($fields[$key]);
            }

        }
        echo "<pre>";
        print_r($fields);
        echo "</pre>";
        die;
    }

    public function doMerge()
    {

        $configs = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'pass', 'label' => 'Password', 'rules' => 'trim|required'
            ),
            array(
                'field' => 'passconf',
                'label' => 'Password conf',
                'rules' => 'trim|required|matches[pass]'
            ),
            array(
                'field' => 'checkbox', 'label' => '', 'rules' => ''
            ),
        );

        $fields = array('email', 'pass');
        $after = array();

        echo "<pre>";
        print_r(
            array_filter($fields, function ($a) {
                $configs = array(
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
                    ),
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
                    ),
                    array(
                        'field' => 'pass', 'label' => 'Password', 'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'passconf',
                        'label' => 'Password conf',
                        'rules' => 'trim|required|matches[pass]'
                    ),
                    array(
                        'field' => 'checkbox', 'label' => '', 'rules' => ''
                    ),
                );

                foreach ($configs as $config) {
                    if ($a == $config['filed']) {
                        return $config;
                    }
                }
            })
        );
        echo "</pre>";
        die;


//        foreach ($fields as $field) {
//            if( $key = array_search($field, $configs) == true) {
//                $after[]= $configs;
//            }
//        }
        //$users = [ 123 => 'Joe', 456 => 'Bob', 789 => 'Sam' ];

//        echo "<pre>";
//        print_r(array_map(function ($key, $values,$posts) {
//            return $posts;
//            return $values;
//            return $values['field'];
//            return array_merge($posts,$values);
//            if(array_key_exists($posts,$values)) {
//                return $values;
//            }
//
//        }, array_keys($configs), array_values($configs),$fields));
//        echo "</pre>";die;
    }

    public function g()
    {
        $configs = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'pass', 'label' => 'Password', 'rules' => 'trim|required'
            ),
            array(
                'field' => 'passconf',
                'label' => 'Password conf',
                'rules' => 'trim|required|matches[pass]'
            ),
            array(
                'field' => 'checkbox', 'label' => '', 'rules' => ''
            ),
        );
        $posts = array('email', 'pass');

        $arr = array();

        foreach ($configs as $config) {
            $match = $config['field'];

            foreach ($posts as $post) {
                if ($match == $post) {
                    $arr[] = $config;
                }
            }

            /*var_dump(array_filter($config, function($element) {
                $posts = array('email', 'pass');
                return array_search($element['field'],$posts);
            }));*/
            /*var_dump(array_search($config['field'],$posts));
            if(array_search($match,$posts)) {
                //var_dump($arr[]=$config);
                //$arr[]=$config;
                array_push($arr,$config);
            }*/
        }
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        die;

        /*foreach ($posts as $post) {
            $arr[]=array('filed'=>$post);
        }*/

        /*array_map(function ($key, $values,$posts) {
            return $posts;
            return $values;
            return $values['field'];
            return array_merge($posts,$values);
            if(array_key_exists($posts,$values)) {
                return $values;
            }

        }, array_keys($configs), array_values($configs),$arr);

        echo "<pre>";
        print_r($arr);
        echo "</pre>";die;
        array_diff_key($arr,$configs);

        array_walk($configs,function (){

        });*/
    }

    private function _getRules($posts = array())
    {
        // email_new|email_old
        $mainConfigs = array(
            array(
                'field' => 'email_new',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'email_old',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'pass',
                'label' => 'Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'passconf',
                'label' => 'Password conf',
                'rules' => 'trim|required|matches[pass]'
            ),
            array(
                'field' => 'checkbox',
                'label' => '',
                'rules' => ''
            ),
        );

        $arr = array();
        /*foreach ($mainConfigs as $config) {
            $match = $config['field'];
            foreach ($posts as $post) {
                if($match == $post) {
                    $arr[]=$config;
                }
            }
        }*/

        $flag = 0;
        count($posts);
        foreach ($posts as $post) {
            foreach ($mainConfigs as $config) {
                if ($post == $config['field']) {
                    $arr[] = $config;
                    return;
                }

            }
        }

        return $arr;
    }

    public function gr()
    {
        $posts = array('email', 'checkbox');

        $rules = $this->_getRules($posts);

        echo "<pre>";
        print_r($rules);
        echo "</pre>";
        die;

    }

}