<?php
  namespace Database\Seeders;

  use Illuminate\Database\Seeder;
  use App\Models\AbTest;
  use App\Models\AbVariant;

  class AbTestSeeder extends Seeder
  {
      public function run()
      {
          $abTest = AbTest::create(['name' => 'Homepage Test']);

          AbVariant::create([
            'ab_test_id' => $abTest->id,
            'name' => 'Variant A',
            'ratio' => 1,
          ]);

          AbVariant::create([
              'ab_test_id' => $abTest->id,
              'name' => 'Variant B',
              'ratio' => 2,
          ]);
      }
  }
?>