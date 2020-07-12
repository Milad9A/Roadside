<?php

use Illuminate\Database\Seeder;

class ServeiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_ar'=>'النقل بين المدن',
                'name_en'=>'Logistics Between Cities',
                'type'=>'service',
                'photo'=>'/images/services/logistics.png',
                'photo_selected'=>'/images/services/selected-logistics.png',
                'service_id'=>null,
                'is_sub'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
        ],
            [
                'name_ar'=>'سطحة عادي',
                'name_en'=>'Regular Towing - Between Cities',
                'type'=>'service',
                'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>1,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name_ar'=>'سطحة هيدروليك',
                'name_en'=>'Flatbed  - Between Cities',
                'type'=>'service',
                'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>1,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'سطحة مغطاة',
                'name_en'=>'Covered Towing - Between Cities',
                'type'=>'service',
                'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>1,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'سطحة',
                'name_en'=>'Tow',
                'type'=>'service',
                'photo'=>'/images/services/tow-truck1.png',
                'photo_selected'=>'/images/services/selectedTruck.png',
                'service_id'=>null,
                'is_sub'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'سطحة عادي',
                'name_en'=> 'Regular Towing',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>5,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'بنشر',
                'name_en'=>'Tire',
                'type'=>'service',
                'photo'=>'/images/services/flat-tire.png',
                'photo_selected'=>'/images/services/selectedWheel.png',
                'service_id'=>null,
                'is_sub'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'تغيير الاطار الاحتياطي',
                'name_en'=>'Spare Tire Installation',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>7,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'اصلاح الاطار في المحطة',
                'name_en'=>'Tire Repair in Station',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>7,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'اصلاح الاطار في الموقع',
                'name_en'=>'Tire Repair on Site',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>7,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'تعبئة الاطار بالهواء',
                'name_en'=>'Tire Inflation on Site',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>7,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'تغيير الاطار في المحطة',
                'name_en'=>'Tire Change on Site',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>7,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'بطارية',
                'name_en'=>'Battery',
                'type'=>'service',
                'photo'=>'/images/services/battery.png',
                'photo_selected'=>'/images/services/selectedBattery.png',
                'service_id'=>null,
                'is_sub'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'اشتراك بطارية',
                'name_en'=>'Battery Jump Start',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>13,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'تغيير بطارية',
                'name_en'=>'Battery Change',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>13,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'بنزين',
                'name_en'=>'Gas',
                'type'=>'service',
                'photo'=>'/images/services/fuel.png',
                'photo_selected'=>'/images/services/selectedFuel.png',
                'service_id'=>null,
                'is_sub'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'توصيل بنزين خارج المدينة',
                'name_en'=>'Gas Delivery Outside City',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>16,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name_ar'=>'توصيل بنزين داخل المدينة',
                'name_en'=>'Gas Delivery City',
                'type'=>'service',
               'photo'=>null,
                'photo_selected'=>null,
                'service_id'=>16,
                'is_sub'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
           ];
        \App\Models\Service\Service::query()->insert($data);

    }
}
