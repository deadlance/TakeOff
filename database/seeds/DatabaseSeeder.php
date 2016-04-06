<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;



class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tags')->delete();

        \DB::table('tags')->insert(array (
          0 =>
            array (
              'id' => 16,
              'name' => 'Appliance ',
              'slug' => 'appliance',
              'description' => '',
              'created_at' => '2016-04-06 18:46:22',
              'updated_at' => '2016-04-06 18:57:39',
            ),
          1 =>
            array (
              'id' => 17,
              'name' => 'Architecture',
              'slug' => 'architecture',
              'description' => '',
              'created_at' => '2016-04-06 18:46:33',
              'updated_at' => '2016-04-06 19:03:17',
            ),
          2 =>
            array (
              'id' => 18,
              'name' => 'Building Material',
              'slug' => 'building-material',
              'description' => '',
              'created_at' => '2016-04-06 18:46:49',
              'updated_at' => '2016-04-06 19:02:03',
            ),
          3 =>
            array (
              'id' => 19,
              'name' => 'Building Permits',
              'slug' => 'building-permits',
              'description' => '',
              'created_at' => '2016-04-06 18:47:15',
              'updated_at' => '2016-04-06 19:03:30',
            ),
          4 =>
            array (
              'id' => 20,
              'name' => 'Cabinet ',
              'slug' => 'cabinet',
              'description' => '',
              'created_at' => '2016-04-06 18:47:27',
              'updated_at' => '2016-04-06 19:02:08',
            ),
          5 =>
            array (
              'id' => 21,
              'name' => 'Commission',
              'slug' => 'commission',
              'description' => '',
              'created_at' => '2016-04-06 18:47:38',
              'updated_at' => '2016-04-06 18:47:38',
            ),
          6 =>
            array (
              'id' => 22,
              'name' => 'Concrete Flatwork',
              'slug' => 'concrete-flatwork',
              'description' => '',
              'created_at' => '2016-04-06 18:47:50',
              'updated_at' => '2016-04-06 18:57:57',
            ),
          7 =>
            array (
              'id' => 23,
              'name' => 'Concrete ',
              'slug' => 'concrete',
              'description' => '',
              'created_at' => '2016-04-06 18:48:04',
              'updated_at' => '2016-04-06 19:02:15',
            ),
          8 =>
            array (
              'id' => 24,
              'name' => 'Countertop',
              'slug' => 'countertop',
              'description' => '',
              'created_at' => '2016-04-06 18:48:18',
              'updated_at' => '2016-04-06 18:58:03',
            ),
          9 =>
            array (
              'id' => 25,
              'name' => 'Deck',
              'slug' => 'deck',
              'description' => '',
              'created_at' => '2016-04-06 18:48:29',
              'updated_at' => '2016-04-06 18:58:31',
            ),
          10 =>
            array (
              'id' => 26,
              'name' => 'Drywall ',
              'slug' => 'drywall',
              'description' => '',
              'created_at' => '2016-04-06 18:49:35',
              'updated_at' => '2016-04-06 19:02:21',
            ),
          11 =>
            array (
              'id' => 27,
              'name' => 'Electrical',
              'slug' => 'electrical',
              'description' => '',
              'created_at' => '2016-04-06 18:49:43',
              'updated_at' => '2016-04-06 18:58:22',
            ),
          12 =>
            array (
              'id' => 28,
              'name' => 'Engineering ',
              'slug' => 'engineering',
              'description' => '',
              'created_at' => '2016-04-06 18:49:52',
              'updated_at' => '2016-04-06 19:03:42',
            ),
          13 =>
            array (
              'id' => 29,
              'name' => 'Erosion Control',
              'slug' => 'erosion-control',
              'description' => '',
              'created_at' => '2016-04-06 18:50:02',
              'updated_at' => '2016-04-06 18:58:41',
            ),
          14 =>
            array (
              'id' => 30,
              'name' => 'Excavation - Grading',
              'slug' => 'excavation-grading',
              'description' => '',
              'created_at' => '2016-04-06 18:50:17',
              'updated_at' => '2016-04-06 18:58:50',
            ),
          15 =>
            array (
              'id' => 31,
              'name' => 'Financing Cost',
              'slug' => 'financing-cost',
              'description' => '',
              'created_at' => '2016-04-06 18:50:30',
              'updated_at' => '2016-04-06 18:50:30',
            ),
          16 =>
            array (
              'id' => 32,
              'name' => 'Fireplace',
              'slug' => 'fireplace',
              'description' => '',
              'created_at' => '2016-04-06 18:50:37',
              'updated_at' => '2016-04-06 18:58:59',
            ),
          17 =>
            array (
              'id' => 33,
              'name' => 'Flooring',
              'slug' => 'flooring',
              'description' => '',
              'created_at' => '2016-04-06 18:50:44',
              'updated_at' => '2016-04-06 18:59:09',
            ),
          18 =>
            array (
              'id' => 34,
              'name' => 'Framing',
              'slug' => 'framing',
              'description' => '',
              'created_at' => '2016-04-06 18:51:01',
              'updated_at' => '2016-04-06 18:59:26',
            ),
          19 =>
            array (
              'id' => 35,
              'name' => 'Front',
              'slug' => 'front',
              'description' => '',
              'created_at' => '2016-04-06 18:51:18',
              'updated_at' => '2016-04-06 19:04:16',
            ),
          20 =>
            array (
              'id' => 36,
              'name' => 'Garage',
              'slug' => 'garage',
              'description' => '',
              'created_at' => '2016-04-06 18:51:25',
              'updated_at' => '2016-04-06 19:04:37',
            ),
          21 =>
            array (
              'id' => 37,
              'name' => 'Guttering',
              'slug' => 'guttering',
              'description' => '',
              'created_at' => '2016-04-06 18:51:33',
              'updated_at' => '2016-04-06 18:59:47',
            ),
          22 =>
            array (
              'id' => 38,
              'name' => 'Hardware ',
              'slug' => 'hardware',
              'description' => '',
              'created_at' => '2016-04-06 18:51:50',
              'updated_at' => '2016-04-06 19:02:27',
            ),
          23 =>
            array (
              'id' => 39,
              'name' => 'HVAC',
              'slug' => 'hvac',
              'description' => '',
              'created_at' => '2016-04-06 18:51:58',
              'updated_at' => '2016-04-06 19:00:04',
            ),
          24 =>
            array (
              'id' => 40,
              'name' => 'Insulation',
              'slug' => 'insulation',
              'description' => '',
              'created_at' => '2016-04-06 18:52:05',
              'updated_at' => '2016-04-06 19:00:15',
            ),
          25 =>
            array (
              'id' => 41,
              'name' => 'Insurance',
              'slug' => 'insurance',
              'description' => '',
              'created_at' => '2016-04-06 18:52:11',
              'updated_at' => '2016-04-06 18:52:11',
            ),
          26 =>
            array (
              'id' => 42,
              'name' => 'Interest',
              'slug' => 'interest',
              'description' => '',
              'created_at' => '2016-04-06 18:52:20',
              'updated_at' => '2016-04-06 18:52:20',
            ),
          27 =>
            array (
              'id' => 43,
              'name' => 'Interior Cleaning ',
              'slug' => 'interior-cleaning',
              'description' => '',
              'created_at' => '2016-04-06 18:52:33',
              'updated_at' => '2016-04-06 19:00:28',
            ),
          28 =>
            array (
              'id' => 44,
              'name' => 'Interior  ',
              'slug' => 'interior',
              'description' => '',
              'created_at' => '2016-04-06 18:52:44',
              'updated_at' => '2016-04-06 19:04:44',
            ),
          29 =>
            array (
              'id' => 45,
              'name' => 'Landscaping',
              'slug' => 'landscaping',
              'description' => '',
              'created_at' => '2016-04-06 18:52:58',
              'updated_at' => '2016-04-06 19:05:29',
            ),
          30 =>
            array (
              'id' => 46,
              'name' => 'Light Fixture ',
              'slug' => 'light-fixture',
              'description' => '',
              'created_at' => '2016-04-06 18:53:07',
              'updated_at' => '2016-04-06 19:02:33',
            ),
          31 =>
            array (
              'id' => 47,
              'name' => 'Lot Cost',
              'slug' => 'lot-cost',
              'description' => '',
              'created_at' => '2016-04-06 18:53:18',
              'updated_at' => '2016-04-06 18:53:18',
            ),
          32 =>
            array (
              'id' => 48,
              'name' => 'Masonry ',
              'slug' => 'masonry',
              'description' => '',
              'created_at' => '2016-04-06 18:53:26',
              'updated_at' => '2016-04-06 19:00:47',
            ),
          33 =>
            array (
              'id' => 49,
              'name' => 'Millwork ',
              'slug' => 'millwork',
              'description' => '',
              'created_at' => '2016-04-06 18:53:34',
              'updated_at' => '2016-04-06 19:02:39',
            ),
          34 =>
            array (
              'id' => 50,
              'name' => 'Mirror  ',
              'slug' => 'mirror',
              'description' => '',
              'created_at' => '2016-04-06 18:53:51',
              'updated_at' => '2016-04-06 19:05:13',
            ),
          35 =>
            array (
              'id' => 51,
              'name' => 'Painting ',
              'slug' => 'painting',
              'description' => '',
              'created_at' => '2016-04-06 18:53:58',
              'updated_at' => '2016-04-06 19:01:00',
            ),
          36 =>
            array (
              'id' => 52,
              'name' => 'Plumbing ',
              'slug' => 'plumbing',
              'description' => '',
              'created_at' => '2016-04-06 18:54:06',
              'updated_at' => '2016-04-06 19:01:10',
            ),
          37 =>
            array (
              'id' => 53,
              'name' => 'Roofing ',
              'slug' => 'roofing',
              'description' => '',
              'created_at' => '2016-04-06 18:54:17',
              'updated_at' => '2016-04-06 19:01:16',
            ),
          38 =>
            array (
              'id' => 54,
              'name' => 'Sand and Gravel ',
              'slug' => 'sand-and-gravel',
              'description' => '',
              'created_at' => '2016-04-06 18:54:24',
              'updated_at' => '2016-04-06 19:02:45',
            ),
          39 =>
            array (
              'id' => 55,
              'name' => 'Seller Fees',
              'slug' => 'seller-fees',
              'description' => '',
              'created_at' => '2016-04-06 18:54:30',
              'updated_at' => '2016-04-06 18:54:30',
            ),
          40 =>
            array (
              'id' => 56,
              'name' => 'Site Cleaning ',
              'slug' => 'site-cleaning',
              'description' => '',
              'created_at' => '2016-04-06 18:54:38',
              'updated_at' => '2016-04-06 19:01:21',
            ),
          41 =>
            array (
              'id' => 57,
              'name' => 'Sod',
              'slug' => 'sod',
              'description' => '',
              'created_at' => '2016-04-06 18:55:05',
              'updated_at' => '2016-04-06 19:01:32',
            ),
          42 =>
            array (
              'id' => 58,
              'name' => 'Steel Material ',
              'slug' => 'steel-material',
              'description' => '',
              'created_at' => '2016-04-06 18:55:12',
              'updated_at' => '2016-04-06 19:02:50',
            ),
          43 =>
            array (
              'id' => 59,
              'name' => 'Taxes',
              'slug' => 'taxes',
              'description' => '',
              'created_at' => '2016-04-06 18:55:18',
              'updated_at' => '2016-04-06 18:55:18',
            ),
          44 =>
            array (
              'id' => 60,
              'name' => 'Temporary Services',
              'slug' => 'temporary-services',
              'description' => '',
              'created_at' => '2016-04-06 18:55:29',
              'updated_at' => '2016-04-06 18:55:29',
            ),
          45 =>
            array (
              'id' => 61,
              'name' => 'Trim Carpentry ',
              'slug' => 'trim-carpentry',
              'description' => '',
              'created_at' => '2016-04-06 18:55:44',
              'updated_at' => '2016-04-06 19:01:40',
            ),
          46 =>
            array (
              'id' => 62,
              'name' => 'Water Service ',
              'slug' => 'water-service',
              'description' => '',
              'created_at' => '2016-04-06 18:56:04',
              'updated_at' => '2016-04-06 19:01:47',
            ),
          47 =>
            array (
              'id' => 63,
              'name' => 'Contractor',
              'slug' => 'contractor',
              'description' => '',
              'created_at' => '2016-04-06 18:56:40',
              'updated_at' => '2016-04-06 18:56:40',
            ),
          48 =>
            array (
              'id' => 64,
              'name' => 'Supplier',
              'slug' => 'supplier',
              'description' => '',
              'created_at' => '2016-04-06 19:03:00',
              'updated_at' => '2016-04-06 19:03:00',
            ),
          49 =>
            array (
              'id' => 65,
              'name' => 'Plan Fees',
              'slug' => 'plan-fees',
              'description' => '',
              'created_at' => '2016-04-06 19:03:10',
              'updated_at' => '2016-04-06 19:03:10',
            ),
          50 =>
            array (
              'id' => 66,
              'name' => 'Taps',
              'slug' => 'taps',
              'description' => '',
              'created_at' => '2016-04-06 19:03:25',
              'updated_at' => '2016-04-06 19:03:25',
            ),
          51 =>
            array (
              'id' => 67,
              'name' => 'Fees',
              'slug' => 'fees',
              'description' => '',
              'created_at' => '2016-04-06 19:03:46',
              'updated_at' => '2016-04-06 19:03:46',
            ),
          52 =>
            array (
              'id' => 68,
              'name' => 'Exterior',
              'slug' => 'exterior',
              'description' => '',
              'created_at' => '2016-04-06 19:04:22',
              'updated_at' => '2016-04-06 19:04:22',
            ),
          53 =>
            array (
              'id' => 69,
              'name' => 'Door',
              'slug' => 'door',
              'description' => '',
              'created_at' => '2016-04-06 19:04:27',
              'updated_at' => '2016-04-06 19:04:27',
            ),
          54 =>
            array (
              'id' => 70,
              'name' => 'Shower',
              'slug' => 'shower',
              'description' => '',
              'created_at' => '2016-04-06 19:05:17',
              'updated_at' => '2016-04-06 19:05:17',
            ),
        ));

        \DB::table('unit_of_measures')->delete();

        \DB::table('unit_of_measures')->insert(array (
          0 =>
            array (
              'id' => 4,
              'name' => 'Each',
              'slug' => 'each',
              'description' => '',
              'created_at' => '2016-04-06 18:25:01',
              'updated_at' => '2016-04-06 18:26:33',
            ),
          1 =>
            array (
              'id' => 5,
              'name' => 'Turnkey',
              'slug' => 'turnkey',
              'description' => '',
              'created_at' => '2016-04-06 18:26:43',
              'updated_at' => '2016-04-06 18:26:43',
            ),
          2 =>
            array (
              'id' => 6,
              'name' => 'Bundle',
              'slug' => 'bundle',
              'description' => '',
              'created_at' => '2016-04-06 18:27:43',
              'updated_at' => '2016-04-06 18:27:43',
            ),
          3 =>
            array (
              'id' => 7,
              'name' => 'Box',
              'slug' => 'box',
              'description' => '',
              'created_at' => '2016-04-06 18:27:51',
              'updated_at' => '2016-04-06 18:27:51',
            ),
          4 =>
            array (
              'id' => 8,
              'name' => 'Foot',
              'slug' => 'foot',
              'description' => '',
              'created_at' => '2016-04-06 18:28:11',
              'updated_at' => '2016-04-06 18:28:11',
            ),
          5 =>
            array (
              'id' => 9,
              'name' => 'Hour',
              'slug' => 'hour',
              'description' => '',
              'created_at' => '2016-04-06 18:28:19',
              'updated_at' => '2016-04-06 18:28:19',
            ),
          6 =>
            array (
              'id' => 10,
              'name' => 'Load',
              'slug' => 'load',
              'description' => '',
              'created_at' => '2016-04-06 18:28:32',
              'updated_at' => '2016-04-06 18:28:32',
            ),
          7 =>
            array (
              'id' => 14,
              'name' => 'Lump Sum',
              'slug' => 'lump-sum',
              'description' => '',
              'created_at' => '2016-04-06 18:32:22',
              'updated_at' => '2016-04-06 18:32:22',
            ),
          8 =>
            array (
              'id' => 15,
              'name' => 'Linear Foot',
              'slug' => 'linear-foot',
              'description' => '',
              'created_at' => '2016-04-06 18:33:37',
              'updated_at' => '2016-04-06 18:33:37',
            ),
          9 =>
            array (
              'id' => 16,
              'name' => 'Thousand Board Feet',
              'slug' => 'thousand-board-feet',
              'description' => '',
              'created_at' => '2016-04-06 18:33:57',
              'updated_at' => '2016-04-06 18:33:57',
            ),
          10 =>
            array (
              'id' => 17,
              'name' => 'Pair',
              'slug' => 'pair',
              'description' => '',
              'created_at' => '2016-04-06 18:34:17',
              'updated_at' => '2016-04-06 18:34:17',
            ),
          11 =>
            array (
              'id' => 18,
              'name' => 'Roll',
              'slug' => 'roll',
              'description' => '',
              'created_at' => '2016-04-06 18:34:23',
              'updated_at' => '2016-04-06 18:34:23',
            ),
          12 =>
            array (
              'id' => 19,
              'name' => 'Set',
              'slug' => 'set',
              'description' => '',
              'created_at' => '2016-04-06 18:34:28',
              'updated_at' => '2016-04-06 18:34:28',
            ),
          13 =>
            array (
              'id' => 20,
              'name' => 'Square Foot',
              'slug' => 'square-foot',
              'description' => '',
              'created_at' => '2016-04-06 18:34:39',
              'updated_at' => '2016-04-06 18:34:39',
            ),
          14 =>
            array (
              'id' => 21,
              'name' => 'Ton',
              'slug' => 'ton',
              'description' => '',
              'created_at' => '2016-04-06 18:34:57',
              'updated_at' => '2016-04-06 18:34:57',
            ),
          15 =>
            array (
              'id' => 22,
              'name' => 'Yard',
              'slug' => 'yard',
              'description' => '',
              'created_at' => '2016-04-06 18:35:02',
              'updated_at' => '2016-04-06 18:35:02',
            ),
          16 =>
            array (
              'id' => 23,
              'name' => 'Square Yard',
              'slug' => 'square-yard',
              'description' => '',
              'created_at' => '2016-04-06 19:33:58',
              'updated_at' => '2016-04-06 19:33:58',
            ),
          17 =>
            array (
              'id' => 24,
              'name' => 'Cubic Yard',
              'slug' => 'cubic-yard',
              'description' => '',
              'created_at' => '2016-04-06 19:34:04',
              'updated_at' => '2016-04-06 19:34:04',
            ),
        ));
    }
}
