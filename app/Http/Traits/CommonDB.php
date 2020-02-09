<?php
/**
 * Created by PhpStorm.
 * User: SSE
 * Date: 2/24/2019
 * Time: 3:17 PM
 */
namespace App\Http\Traits;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Code;
use App\Models\Customer;
use App\Models\Pro_model;
use App\Models\Product;
use App\Models\SaleDetails;
use App\Models\Sub_category;
use App\Models\ChildTag;
use App\Models\Supplier;
use App\Models\Unit;

Trait CommonDb
{

    //Categorys
    public function categories()
    {
        return Category::orderBy('name', 'asc')->get();
    }
    //subCategorys
    public function subCategories()
    {
        return Sub_category::orderBy('name', 'asc')->get();
    }
    //subCategorys
    public function subCategoriesByParentID($id)
    {
        return Sub_category::where('category_id', $id)->orderBy('name', 'asc')->get();
    }

    //Tag subCategorys
    public function tagSubCategories()
    {
        return ChildTag::orderBy('name', 'asc')->get();
    }
    //brands
    public function brands()
    {
        return Brand::orderBy('name', 'asc')->get();
    }
    //pro_models
    public function pro_models()
    {
        return Pro_model::orderBy('name', 'asc')->get();
    }
    //suppliers
    public function suppliers()
    {
        return Supplier::orderBy('name', 'asc')->get();
    }
    //units
    public function units()
    {
        return Unit::orderBy('name', 'asc')->get();
    }

    //Product
    public function products()
    {
        return Product::orderBy('name', 'asc')->get();
    }
    //Product
//    public function sales()
//    {
//        return SaleDetails::orderBy('name', 'asc')->get();
//    }

}