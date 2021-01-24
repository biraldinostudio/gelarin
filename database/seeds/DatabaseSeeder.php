<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(SettingTableSeeder::class);		
		$this->call(UserTableSeeder::class);
		$this->call(UserDescriptionTableSeeder::class);
		$this->call(AdminTableSeeder::class);		
		$this->call(LanguageTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);		
        $this->call(GenderTableSeeder::class);
        $this->call(ContinentTableSeeder::class);
        $this->call(CategoryTypeTableSeeder::class);
        $this->call(EducationTableSeeder::class);
        $this->call(ArticleTypeTableSeeder::class);
        $this->call(WorkingTimeTableSeeder::class);
        $this->call(WorkingUniformTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(WorkingTypeTableSeeder::class);
        $this->call(WorkingLevelTableSeeder::class);
        $this->call(SalaryTypeTableSeeder::class);	
    }
}
