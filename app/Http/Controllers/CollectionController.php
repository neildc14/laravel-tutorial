<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Member;

class CollectionController extends Controller
{
   public function collection_class(){

        //Create a new collection using Collection class
        $collection1 = new Collection([67,34,89,56,23]);
        return $collection1;

    }

    public function collection_method(){
        $collection = collect(["good","better","best"]);
        return $collection;
    }

    public function filter_data(){
        $products = collect([
            ['product' => 'HDD', 'price' => 6000],
            ['product' => 'Mouse', 'price' => 500],
            ['product' => 'Monitor', 'price' => 5000],
            ['product' => 'Printer', 'price' => 4000],
        ]);

        //Create another list after filtering the data based on price value
        $filter_price = $products->filter(function ($item) {
            return data_get($item, 'price') > 4000;
        });

        $filtered = $filter_price->all();
        return $filtered;

    }

    public function member_collection(){
        $member = Member::all();
        $collection = collect($member);
        return $collection;
    }
}
