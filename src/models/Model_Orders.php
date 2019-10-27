<?php
namespace src\models;

use RedBean_SimpleModel;

class Model_Orders extends RedBean_SimpleModel
{

//    public function update() {
//
//    }

//    public function validate() {
//        $gump = new GUMP();
//        $post = $gump->sanitize($request->getParsedBody());
//        $post = [
//            'from'          => 'from example',
//            'destination'   => 'destination example',
//            'delivery_date' => '2019-10-27 14:00:00',
//            'name'          => 'name example',
//            'phone'         => '+79872705566',
//        ];
//
//        $gump->validation_rules([
//            'from' => 'required|max_len,100|min_len,5',
////            'destination' => 'required|max_len,100|min_len,5',
////            'delivery_date' => 'required',
////            'name' => 'required|valid_name|max_len,30|min_len,2',
////            'phone' => 'required',
//        ]);
//
//        $gump->filter_rules([
//            'from'          => 'trim|sanitize_string',
//            'destination'   => 'trim|sanitize_string',
//            'delivery_date' => 'trim|sanitize_string',
//            'name'          => 'trim|sanitize_string',
//            'phone'         => 'trim|sanitize_string',
//        ]);
//
//        $validated_data = $gump->run($post);
//    }
}