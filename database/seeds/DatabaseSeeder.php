<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		//$this->call('UserTableSeeder');
	}
}

class CitiesTableSeeder extends Seeder {
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('cities')->truncate();

        $cities['lt'] = array('Vilnius',
                            'Kaunas',
                            'Klaipėda',
                            'Šiauliai',
                            'Panevėžys',
                            'Akmenė',
                            'Alytus',
                            'Anykščiai',
                            'Birštonas',
                            'Biržai',
                            'Druskininkai',
                            'Elektrėnai',
                            'Gargždai',
                            'Grigiškės',
                            'Ignalina',
                            'Jonava',
                            'Joniškis',
                            'Jurbarkas',
                            'Kaišiadorys',
                            'Kalvarija',
                            'Kazlų Rūda',
                            'Kėdainiai',
                            'Kelmė',
                            'Kretinga',
                            'Kupiškis',
                            'Lazdijai',
                            'Lentvaris',
                            'Marijampolė',
                            'Mažeikiai',
                            'Molėtai',
                            'Naujoji Akmenė',
                            'Neringa',
                            'Pagėgiai',
                            'Pakruojis',
                            'Palanga',
                            'Pasvalys',
                            'Plungė',
                            'Prienai',
                            'Radviliškis',
                            'Raseiniai',
                            'Rokiškis',
                            'Šakiai',
                            'Šalčininkai',
                            'Šilutė',
                            'Skuodas',
                            'Švenčionys',
                            'Tauragė',
                            'Telšiai',
                            'Trakai',
                            'Ukmergė',
                            'Utena',
                            'Varėna',
                            'Vievis',
                            'Vilkaviškis',
                            'Vilkija',
                            'Visaginas',
                            'Zarasai',
                            'Visa Lietuva',
                            'Darbas iš namų');

        foreach ($cities['lt'] as $k => $item)
        {
            $data = array('name_lt' => $item, 'position' => $k);
            DB::table('cities')->insert($data);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class InstitutionsTableSeeder extends Seeder {
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('institution_categories')->truncate();
        DB::table('institutions')->truncate();

		$data = require(base_path() . '/database/seeds/institutionsData.php');

		foreach ($data as $item)
        {
			$categoryData = array('name_lt'=>$item['name_lt'], 'position'=>$item['position']);
            
            $categoryId = DB::table('institution_categories')->insertGetId($categoryData);
			
			if (!empty($item['institutions']) && $categoryId)
            {
                foreach ($item['institutions'] as $institution)
                {
					$institutionData = array('name_lt'=>$institution['name_lt'], 'category_id' => $categoryId, 'position'=>$institution['position']);
					DB::table('institutions')->insertGetId($institutionData);
				}
			}
		}
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}

class StudyGradesTableSeeder extends Seeder {
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('study_grades')->truncate();

        $data[] = array('name_lt' => 'Profesinis bakalauras', 'position' => 1);
        $data[] = array('name_lt' => 'Bakalauras', 'position' => 2);
        $data[] = array('name_lt' => 'Magistras', 'position' => 3);
        $data[] = array('name_lt' => 'Daktaras', 'position' => 4);
        $data[] = array('name_lt' => 'Internautas', 'type' => 'student', 'position' => 5);
        $data[] = array('name_lt' => 'Rezidentas', 'type' => 'student', 'position' => 6);
        $data[] = array('name_lt' => 'Bakalauratūra (nebaigta)', 'type' => 'graduate', 'position' => 7);
        $data[] = array('name_lt' => 'Bakalauratūra (sustabdyta)', 'type' => 'graduate', 'position' => 8);
        $data[] = array('name_lt' => 'Magistrantūra (nebaigta)', 'type' => 'graduate', 'position' => 9);
        $data[] = array('name_lt' => 'Magistrantūra (sustabdyta)', 'type' => 'graduate', 'position' => 10);
        $data[] = array('name_lt' => 'Doktorantūra (nebaigta)', 'type' => 'graduate', 'position' => 11);
        $data[] = array('name_lt' => 'Doktorantūra (sustabdyta)', 'type' => 'graduate', 'position' => 12);

        foreach ($data as $item)
        {
            DB::table('study_grades')->insert($item);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class WorkScopesTableSeeder extends Seeder {
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('work_scopes')->truncate();

        $data[] = array('name_lt' => 'Administravimas', 'position' => 1);
        $data[] = array('name_lt' => 'Aplinkotvarka/Aplinkosauga', 'position' => 2);
        $data[] = array('name_lt' => 'Aukštosios (pažangios) technologijos ', 'position' => 3);
        $data[] = array('name_lt' => 'Automatika', 'position' => 4);
        $data[] = array('name_lt' => 'Architektūra/Dailė', 'position' => 5);
        $data[] = array('name_lt' => 'Chemija/Biochemija', 'position' => 6);
        $data[] = array('name_lt' => 'Choreografija', 'position' => 7);
        $data[] = array('name_lt' => 'Draudimas', 'position' => 8);
        $data[] = array('name_lt' => 'Ekonomika', 'position' => 9);
        $data[] = array('name_lt' => 'Elektronika/telekomunikacijos', 'position' => 10);
        $data[] = array('name_lt' => 'Energetika (elektros)', 'position' => 11);
        $data[] = array('name_lt' => 'Energetika (šilumos)', 'position' => 12);
        $data[] = array('name_lt' => 'Energetika (gamtos ištekliai)', 'position' => 13);
        $data[] = array('name_lt' => 'Finansai/Bankininkystė/Apskaita', 'position' => 14);
        $data[] = array('name_lt' => 'Fizika/matematika', 'position' => 15);
        $data[] = array('name_lt' => 'Gamtos ištekliai', 'position' => 16);
        $data[] = array('name_lt' => 'Hidraulika/Pneumatika', 'position' => 17);
        $data[] = array('name_lt' => 'Humanitariniai mokslai', 'position' => 18);
        $data[] = array('name_lt' => 'Interjero, eksterjero dizainas', 'position' => 19);
        $data[] = array('name_lt' => 'IT inžinerija/kompiuterija', 'position' => 20);
        $data[] = array('name_lt' => 'Karyba', 'position' => 21);
        $data[] = array('name_lt' => 'Komercija/verslas (pardavimai/prekyba)', 'position' => 22);
        $data[] = array('name_lt' => 'Kūno kultūra/Sportas', 'position' => 23);
        $data[] = array('name_lt' => 'Mechanika/medžiagotyra', 'position' => 24);
        $data[] = array('name_lt' => 'Medicina/farmacija/Sveikata', 'position' => 25);
        $data[] = array('name_lt' => 'Muzika', 'position' => 26);
        $data[] = array('name_lt' => 'Kultūra/Kūryba', 'position' => 27);
        $data[] = array('name_lt' => 'Nekilnojamas turtas', 'position' => 28);
        $data[] = array('name_lt' => 'Poligrafija', 'position' => 29);
        $data[] = array('name_lt' => 'Politika/Tarptautiniai santykiai', 'position' => 30);
        $data[] = array('name_lt' => 'Pramogų ir poilsio industrija', 'position' => 31);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos (maistas ir gėrimai)', 'position' => 32);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos (baldai)', 'position' => 33);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos (metalas)', 'position' => 34);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos (mediena)', 'position' => 35);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos  (tekstilė/drabužiai)', 'position' => 36);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos (chemija)', 'position' => 37);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos (polimerai)', 'position' => 38);
        $data[] = array('name_lt' => 'Pramonės/Gamybos technologijos (statybinės medžiagos)', 'position' => 39);
        $data[] = array('name_lt' => 'Pramonės/Gamybos valdymas', 'position' => 40);
        $data[] = array('name_lt' => 'Reklama', 'position' => 41);
        $data[] = array('name_lt' => 'Rinkodara', 'position' => 42);
        $data[] = array('name_lt' => 'Religija', 'position' => 43);
        $data[] = array('name_lt' => 'Statybų technologijos (pastatų konstrukcijos)', 'position' => 44);
        $data[] = array('name_lt' => 'Statybų technologijos (pastatų vidaus tinklų inžinerija)', 'position' => 45);
        $data[] = array('name_lt' => 'Statybų technologijos (saugos inžinerija)', 'position' => 46);
        $data[] = array('name_lt' => 'Statybų technologijos (išorinių tinklų inžinerija)', 'position' => 47);
        $data[] = array('name_lt' => 'Statybų technologijos (tiltų  ir kelių statyba)', 'position' => 48);
        $data[] = array('name_lt' => 'Švietimas/Pedagogika/Auklėjimas', 'position' => 49);
        $data[] = array('name_lt' => 'Tarptautiniai ryšiai', 'position' => 50);
        $data[] = array('name_lt' => 'Teatras/kinas', 'position' => 51);
        $data[] = array('name_lt' => 'Teisė/Teisėtvarka', 'position' => 52);
        $data[] = array('name_lt' => 'Tiekimas/Distribucija', 'position' => 53);
        $data[] = array('name_lt' => 'Transportas/Logistika', 'position' => 54);
        $data[] = array('name_lt' => 'Turizmas', 'position' => 55);
        $data[] = array('name_lt' => 'Užsienio kalbos/Kalbotyra', 'position' => 56);
        $data[] = array('name_lt' => 'Veterinarija', 'position' => 57);
        $data[] = array('name_lt' => 'Žemės ūkis/Miškininkystė', 'position' => 58);
        $data[] = array('name_lt' => 'Žiniasklaida/Viešieji ryšiai', 'position' => 59);
        $data[] = array('name_lt' => 'Žmogiškieji ištekliai/Psichologija/Sociologija', 'position' => 60);

        foreach ($data as $item)
        {
            DB::table('work_scopes')->insert($item);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class LanguagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('languages')->truncate();

        $data[] = array('name_lt' => 'Lietuvių', 'position' => 1);
        $data[] = array('name_lt' => 'Anglų', 'position' => 2);
        $data[] = array('name_lt' => 'Rusų', 'position' => 3);
        $data[] = array('name_lt' => 'Lenkų', 'position' => 4);
        $data[] = array('name_lt' => 'Vokiečių', 'position' => 5);
        $data[] = array('name_lt' => 'Prancūzų', 'position' => 6);
        $data[] = array('name_lt' => 'Ispanų', 'position' => 7);
        $data[] = array('name_lt' => 'Baltarusių', 'position' => 8);
        $data[] = array('name_lt' => 'Norvegų', 'position' => 9);
        $data[] = array('name_lt' => 'Švedų', 'position' => 10);
        $data[] = array('name_lt' => 'Danų', 'position' => 11);
        $data[] = array('name_lt' => 'Suomių', 'position' => 12);
        $data[] = array('name_lt' => 'Latvių', 'position' => 13);
        $data[] = array('name_lt' => 'Estų', 'position' => 14);
        $data[] = array('name_lt' => 'Graikų', 'position' => 15);
        $data[] = array('name_lt' => 'Turkų', 'position' => 16);
        $data[] = array('name_lt' => 'Žydų', 'position' => 17);

        foreach ($data as $item)
        {
            DB::table('languages')->insert($item);
        }
    }
}

class ItKnowledgesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('it_knowledge_categories')->truncate();
        DB::table('it_knowledges')->truncate();

        $data = require(base_path() . '/database/seeds/ItknowledgesData.php');

        foreach ($data as $item)
        {
            $categoryData = array('name_lt'=>$item['name_lt'], 'position'=>$item['position']);

            $categoryId = DB::table('it_knowledge_categories')->insertGetId($categoryData);

            if (!empty($item['knowledges']) && $categoryId)
            {
                foreach ($item['knowledges'] as $knowledge)
                {
                    $knowledgeData = array('name_lt'=>$knowledge['name_lt'], 'category_id' => $categoryId, 'position'=>$knowledge['position']);
                    DB::table('it_knowledges')->insertGetId($knowledgeData);
                }
            }
        }
    }
}