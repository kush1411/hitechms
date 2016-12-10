<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Database_entry extends CI_Controller {

    function file_read() {
        $this->load->helper('string');
        $this->load->helper('file');
        $present = array();
        $lines = file(base_url('/uploads/microflock_stock_Rev.csv'));
        foreach ($lines as $k => $v) {
            $arr = explode(',', $v);
//            $srno = trim(strtolower($arr[0]));

            /* Product */
            $design_no = trim(strtolower($arr[0]));
            $shade_no = trim(strtolower($arr[1]));
            $title = trim(strtolower($arr[2]));
            $description = trim(strtolower($arr[3]));
            $weight = trim(strtolower($arr[10]));

            /* Category */
            $theme = trim(strtolower($arr[4]));
            $design_repeat_size = trim(strtolower($arr[5]));
            $primary_color = trim(strtolower($arr[6]));
            $secondary_color = trim(strtolower($arr[7]));
            $tertiary_color = trim(strtolower($arr[8]));
            $weave = trim(strtolower($arr[9]));
            /* Image name */
            $image = trim(strtolower($arr[11]));
            $product = Product::find(array('conditions' => array('title = ? ', $title)));
//            echo '<pre>';print_r($product);exit;
            if (!$product) {
                /* Update Table Product */
//                $present[] = $product->title;
                $product = new Product();
                $product->sku = $design_no;
                $product->colorcode = $shade_no;
                $product->title = $title;
                $product->description = $description;
                $product->weight = $weight;
                $product->section_id = 1;
                $product->updated = date('Y/m/d h:i:s', time());
                $product->save();

                /* Added subcategories */
                if ($theme) {
                    $sub = Subcategory::find('first', array('conditions' => array('category_id = ? and name = ? ', 1, $theme)));
                    if (!$sub) {
                    $sub = new Subcategory();
                    $sub->category_id = 1;
                    $sub->name = $theme;
                    $sub->status = 1;
                    $sub->showinfilter = 1;
                    $sub->created = date('Y/m/d h:i:s', time());
                    $sub->updated = date('Y/m/d h:i:s', time());
                    $sub->save();

                    $productvaraition = new Productvariation();
                    $productvaraition->product_id = $product->id;
                    $productvaraition->subcategory_id = $sub->id;
                    $productvaraition->created = date('Y/m/d h:i:s', time());
                    $productvaraition->updated = date('Y/m/d h:i:s', time());
                    $productvaraition->save();
                }
                    else {
                        $productvaraition = new Productvariation();
                        $productvaraition->product_id = $product->id;
                        $productvaraition->subcategory_id = $sub->id;
                        $productvaraition->created = date('Y/m/d h:i:s', time());
                        $productvaraition->updated = date('Y/m/d h:i:s', time());
                        $productvaraition->save();
                    }
                }
                if ($design_repeat_size) {
                    $sub = Subcategory::find('first', array('conditions' => array('category_id = ? and name = ? ', 2, $design_repeat_size)));
                    if (!$sub) {
                    $sub = new Subcategory();
                    $sub->category_id = 2;
                    $sub->name = $design_repeat_size;
                    $sub->status = 1;
                    $sub->showinfilter = 1;
                    $sub->created = date('Y/m/d h:i:s', time());
                    $sub->updated = date('Y/m/d h:i:s', time());
                    $sub->save();

                    $productvaraition = new Productvariation();
                    $productvaraition->product_id = $product->id;
                    $productvaraition->subcategory_id = $sub->id;
                    $productvaraition->created = date('Y/m/d h:i:s', time());
                    $productvaraition->updated = date('Y/m/d h:i:s', time());
                    $productvaraition->save();
                }
                    else {
                        $productvaraition = new Productvariation();
                        $productvaraition->product_id = $product->id;
                        $productvaraition->subcategory_id = $sub->id;
                        $productvaraition->created = date('Y/m/d h:i:s', time());
                        $productvaraition->updated = date('Y/m/d h:i:s', time());
                        $productvaraition->save();
                    }
                }
                if ($primary_color) {
                    $sub = Subcategory::find('first', array('conditions' => array('category_id = ? and name = ? ', 3, $primary_color)));
                    if (!$sub) {
                    $sub = new Subcategory();
                    $sub->category_id = 3;
                    $sub->name = $primary_color;
                    $sub->status = 1;
                    $sub->showinfilter = 1;
                    $sub->created = date('Y/m/d h:i:s', time());
                    $sub->updated = date('Y/m/d h:i:s', time());
                    $sub->save();

                    $productvaraition = new Productvariation();
                    $productvaraition->product_id = $product->id;
                    $productvaraition->subcategory_id = $sub->id;
                    $productvaraition->created = date('Y/m/d h:i:s', time());
                    $productvaraition->updated = date('Y/m/d h:i:s', time());
                    $productvaraition->save();
                }
                    else {
                        $productvaraition = new Productvariation();
                        $productvaraition->product_id = $product->id;
                        $productvaraition->subcategory_id = $sub->id;
                        $productvaraition->created = date('Y/m/d h:i:s', time());
                        $productvaraition->updated = date('Y/m/d h:i:s', time());
                        $productvaraition->save();
                    }
                }
                if ($secondary_color) {
                    $sub = Subcategory::find('first', array('conditions' => array('category_id = ? and name = ? ', 4, $secondary_color)));
                    if (!$sub) {
                    $sub = new Subcategory();
                    $sub->category_id = 4;
                    $sub->name = $secondary_color;
                    $sub->status = 1;
                    $sub->showinfilter = 1;
                    $sub->created = date('Y/m/d h:i:s', time());
                    $sub->updated = date('Y/m/d h:i:s', time());
                    $sub->save();

                    $productvaraition = new Productvariation();
                    $productvaraition->product_id = $product->id;
                    $productvaraition->subcategory_id = $sub->id;
                    $productvaraition->created = date('Y/m/d h:i:s', time());
                    $productvaraition->updated = date('Y/m/d h:i:s', time());
                    $productvaraition->save();
                }
                    else {
                        $productvaraition = new Productvariation();
                        $productvaraition->product_id = $product->id;
                        $productvaraition->subcategory_id = $sub->id;
                        $productvaraition->created = date('Y/m/d h:i:s', time());
                        $productvaraition->updated = date('Y/m/d h:i:s', time());
                        $productvaraition->save();
                    }
                }
                if ($tertiary_color) {
                    $sub = Subcategory::find('first', array('conditions' => array('category_id = ? and name = ? ', 5, $tertiary_color)));
                    if (!$sub) {
                    $sub = new Subcategory();
                    $sub->category_id = 5;
                    $sub->name = $tertiary_color;
                    $sub->status = 1;
                    $sub->showinfilter = 1;
                    $sub->created = date('Y/m/d h:i:s', time());
                    $sub->updated = date('Y/m/d h:i:s', time());
                    $sub->save();

                    $productvaraition = new Productvariation();
                    $productvaraition->product_id = $product->id;
                    $productvaraition->subcategory_id = $sub->id;
                    $productvaraition->created = date('Y/m/d h:i:s', time());
                    $productvaraition->updated = date('Y/m/d h:i:s', time());
                    $productvaraition->save();
                }
                    else {
                        $productvaraition = new Productvariation();
                        $productvaraition->product_id = $product->id;
                        $productvaraition->subcategory_id = $sub->id;
                        $productvaraition->created = date('Y/m/d h:i:s', time());
                        $productvaraition->updated = date('Y/m/d h:i:s', time());
                        $productvaraition->save();
                    }
                }
                if ($weave) {
                    $sub = Subcategory::find('first', array('conditions' => array('category_id = ? and name = ? ', 6, $weave)));
                    if (!$sub) {
                    $sub = new Subcategory();
                    $sub->category_id = 6;
                    $sub->name = $weave;
                    $sub->status = 1;
                    $sub->showinfilter = 1;
                    $sub->created = date('Y/m/d h:i:s', time());
                    $sub->updated = date('Y/m/d h:i:s', time());
                    $sub->save();

                    $productvaraition = new Productvariation();
                    $productvaraition->product_id = $product->id;
                    $productvaraition->subcategory_id = $sub->id;
                    $productvaraition->created = date('Y/m/d h:i:s', time());
                    $productvaraition->updated = date('Y/m/d h:i:s', time());
                    $productvaraition->save();
                }
                    else {
                        $productvaraition = new Productvariation();
                        $productvaraition->product_id = $product->id;
                        $productvaraition->subcategory_id = $sub->id;
                        $productvaraition->created = date('Y/m/d h:i:s', time());
                        $productvaraition->updated = date('Y/m/d h:i:s', time());
                        $productvaraition->save();
                    }
                }

                if ($image) {
                    /* Added Entry in photo table */
                    $photo = new Photo();
                    $photo->file_name = $image;
                    $photo->file_title = $image;
                    $photo->created = date('Y/m/d h:i:s', time());
                    $photo->updated = date('Y/m/d h:i:s', time());
                    $photo->save();

                    /* Added Entry  in design table */
                    $design = new Design();
                    $design->file_name = $image;
                    $design->file_title = $image;
                    $design->created = date('Y/m/d h:i:s', time());
                    $design->updated = date('Y/m/d h:i:s', time());
                    $design->save();

                    $productdesign = new Productdesign();
                    $productdesign->product_id = $product->id;
                    $productdesign->design_id = $photo->id;
                    $productdesign->created = date('Y/m/d h:i:s', time());
                    $productdesign->updated = date('Y/m/d h:i:s', time());
                    $productdesign->save();

                    $productdesign = new Productphoto();
                    $productdesign->product_id = $product->id;
                    $productdesign->photo_id = $design->id;
                    $productdesign->created = date('Y/m/d h:i:s', time());
                    $productdesign->updated = date('Y/m/d h:i:s', time());
                    $productdesign->save();
                }
            }
        }
    }

}

?>
