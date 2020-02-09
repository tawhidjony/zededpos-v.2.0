<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersTableSeeder::class);
      factory(App\Models\Setting::class,1)->create();
      //factory(App\Models\Customer::class,1)->create();
      
      //factory(App\Models\Category::class,10)->create();
      //factory(App\Models\Sub_category::class,10)->create();
      //factory(App\Models\ChildTag::class,10)->create();
      //factory(App\Models\Pro_model::class,10)->create();
      //factory(App\Models\Brand::class,10)->create();

      factory(App\Models\Invoice_setting::class,1)->create();
    }

}
