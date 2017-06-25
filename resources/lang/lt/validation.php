<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "The :attribute must be accepted.",
	"active_url"           => "The :attribute is not a valid URL.",
	"after"                => "The :attribute must be a date after :date.",
	"alpha"                => "The :attribute may only contain letters.",
	"alpha_dash"           => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The :attribute may only contain letters and numbers.",
	"array"                => "The :attribute must be an array.",
	"before"               => "The :attribute must be a date before :date.",
	"between"              => [
		"numeric" => "The :attribute must be between :min and :max.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => "The :attribute must be between :min and :max characters.",
		"array"   => "The :attribute must have between :min and :max items.",
	],
	"boolean"              => "The :attribute field must be true or false.",
	"confirmed"            => "The :attribute confirmation does not match.",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => "The :attribute must be between :min and :max digits.",
	"email"                => "The :attribute must be a valid email address.",
	"filled"               => "The :attribute field is required.",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "The :attribute must be an integer.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => [
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "The :attribute may not be greater than :max characters.",
		"array"   => "The :attribute may not have more than :max items.",
	],
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => [
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	],
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "The :attribute field is required.",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => [
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	],
	"unique"               => "The :attribute has already been taken.",
	"url"                  => "The :attribute format is invalid.",
	"timezone"             => "The :attribute must be a valid zone.",


	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
	    'g-recaptcha-response' => [
            'required' => 'Patvirtinkite, kad jus ne robotas',
            'recaptcha' => 'Patvirtinkite, kad jus ne robotas',
        ],
        'password' => [
            "required" => "Nurodykite slaptažodį",
            "confirmed" => "Slaptažodžiai turi sutapti",
            "min" => "Slaptažodis turi sudaryti ne mažiau kaip 6 simboliai",
        ],
		'user_type' => [
			'in' => 'Vartotojo tipas neteisingas',
		],
        'email' => [
            'required' => 'Nurodykite el. pašto adresą',
            'unique'   => 'Toks el. paštas jau registruotas',
            'email'    => 'Neteisingai nurodytas el. paštas',
        ],
        'company_name' => [
            'required' => 'Parašykite įmonės pavadinimą',
        ],
        'company_code' => [
            'required' => 'Nurodykite įmonės kodą',
        ],
        'company_position' => [
            'required' => 'Nurodykite pareigas',
        ],
        'company_address' => [
            'required' => 'Nurodykite įmonės adresą korspondencijai',
        ],
        'telephone' => [
            'required' => 'Nurodykite telefono numerį',
        ],
        'name' => [
            'required' => 'Nurodykite vardą, pavardę',
        ],
        'birthday' => [
            'required' => 'Nurodykite gimimo metus',
            'date_format' => 'Neteisingai nurodyti gimimo metai (pvz. 1995-10-30).',
            'before' => 'Neteisingai nurodyti gimimo metai'
        ],
        'gender' => [
            'required' => 'Nurodykite lytį',
        ],
        'practice_city_id' => [
            'required' => 'Nurodykite miestą, kuriame norite atlikti profesinę praktiką',
            'required_without' => 'Nurodykite miestą, kuriame norite atlikti profesinę praktiką'
        ],
        'job_city_id' => [
            'required' => 'Nurodykite miestą, kuriame gyventate',
            'required_without' => 'arba/ ir miestą, kuriame norite susirasti darbą.'
        ],
        'photo' => [
            'image' => 'Nuotrauka turi būti PNG, JPG arba GIF formatu',
            'max'   => 'Nuotraukos dydis turi būti iki 10 MB'
        ],
        'cv_file' => [
            'required' => 'CV nepasirinktas',
            'mimes' => 'Prisegtas dokumentas gali būti WORD, PDF, JPG, PNG formatu',
        ],
        'cv_status' => [
            'required' => 'Nurodykite CV statusą',
        ],
		'scope_category_id' => [
			'required' => 'Nurodykite srities kategoriją',
		],
        'institution_name' => [
            'required' => 'Parašykite švietimo įstaigos pavadinimą',
        ],
        'study_scope' => [
            'required' => 'Parašykite studijų sritį',
        ],
        'specialty' => [
            'required' => 'Parašykite specialybės pavadinimą',
        ],
        'study_grade_id' => [
            'required' => 'Nurodykite mokslinį laipsnį',
        ],
        'study_course' => [
            'required' => 'Nurodykite kursą',
        ],
        'study_form_id' => [
            'required' => 'Nurodykite studijų formą',
        ],
        'study_from_year' => [
            'required' => 'Nurodykite studijų/ mokymosi laikotarpio pradžią',
        ],
        'study_to_year' => [
            'required' => 'Nurodykite studijų/ mokymosi laikotarpio pabaigą',
        ],
        'work_scope_id' => [
            'required' => 'Nurodykite dominantį darbo sritį',
        ],
		'interested_work_description' => [
			'required' => 'Parašykite trumpai apie dominančią darbo sritį, pareigas ir darbo pobūdį',
		],
        'interested_work_city_id' => [
            'required' => 'Nurodykite miestą, kuriame noritе dirbti',
        ],
        'spend_time_per_day' => [
            'required' => 'Nurodykite kiek laiko per dieną galite skirti profesinei praktikai',
        ],
        'work_position' => [
            'required' => 'Parašykite pareigas',
        ],
        'start_date' => [
            'required' => 'Nurodykite pageidaujamos profesinės praktikos pradžią',
        ],
        'practice_description' => [
            'required' => 'Parašykite pageidaujamos praktikos turinį',
        ],
        'work_from_year' => [
            'required' => 'Nurodykite darbo laikotarpio pradžią',
        ],
        'work_to_year' => [
            'required' => 'Nurodykite darbo laikotarpio pabaigą',
        ],
        'interested_work_position' => [
            'required' => 'Parašykite dominančias pareigas',
        ],
        'first_language_id' => [
            'required' => 'Nurodykite gimtąją kalbą',
        ],
        'participation_type_id' => [
            'required' => 'Nurodykite įvykį',
        ],
        'participation_year' => [
            'required' => 'Nurodykite įvykio metus',
        ],
		'participation_name' => [
			'required' => 'Parašykite įvykio pavadinimą',
		],
        'participation_organizer' => [
            'required' => 'Parašykite įvykio rengėją',
        ],
        'participation_description' => [
            'required' => 'Parašykite įvykio turinį/ pobūdį',
        ],
        'recomendation_type_id' => [
            'required' => 'Nurodykite kas įteikta/ gauta',
        ],
        'recomendation_year' => [
            'required' => 'Nurodykite kada įteikta/ gauta',
        ],
        'recomendation_name' => [
            'required' => 'Parašykite kas įteikė',
        ],
        'recomendation_description' => [
            'required' => 'Parašykite dokumento turinį',
        ],
		'trial_salary' => [
			'integer' => 'Atlyginimas bandomuoju laikotarpiu turi būti sveikas skaičius',
		],
		'full_salary' => [
			'integer' => 'Atlyginimas po bandomuojo laikotarpio turi būti sveikas skaičius',
		],
		'cv_document' => [
			'required' => 'Reikia prisegti nors vieną dokumentą',
		],
		'driving_a_year' => [
			'date_format' => 'Vairavimo paritis nurodykite teisingus metus',
		],
		'driving_b_year' => [
			'date_format' => 'Vairavimo paritis nurodykite teisingus metus',
		],
		'driving_c_year' => [
			'date_format' => 'Vairavimo paritis nurodykite teisingus metus',
		],
		'driving_d_year' => [
			'date_format' => 'Vairavimo paritis nurodykite teisingus metus',
		],
        'scope_id' => [
            'required' => 'Nurodykite profesijų sritį',
        ],
        'offer_duration' => [
            'required' => 'Pasirinkite skelbimo trukmę',
        ],
        'logo' => [
            'required' => 'Pasirinkite įmonės logotipą',
            'image' => 'Logotipas turi būti PNG, JPG arba GIF formatu',
            'max'   => 'Logotipo dydis turi būti iki 10 MB'
        ],
        'offer_image_file' => [
            'required' => 'Įkelkite skelbimą PNG, JPG arba GIF formate',
            'image' => 'Įkelkite skelbimą PNG, JPG arba GIF formate',
            'max'   => 'Įkelkite skelbimą iki 10 MB'
        ],
        'logo_id' => [
            'required' => 'Pasirinkite įmonės logotipą',
        ],
        'company_description' => [
            'required' => 'Parašykite įmonės ir jos veiklos aprašymą',
            'min'     => 'Per trumpas įmonės ir jos veiklos aprašymas'
        ],
        'offer_requirements' => [
            'required' => 'Parašykite reikalavimus kandidatams',
            'min'     => 'Per trumpas reikalavimų kandidatams aprašymas'
        ],
        'offer_description' => [
            'required' => 'Parašykite darbo pobūdį',
            'min'     => 'Per trumpas darbo pobūdžio aprašymas'
        ],
        'offer_skills' => [
            'required' => 'Parašykite naudingus įgūdžius ir žinias',
            'min'     => 'Per trumpas naudingų įgūdžių ir žinių aprašymas'
        ],
        'company_offers' => [
            'required' => 'Parašykite ką įmonė siūlo',
            'min'     => 'Per trumpas ką įmonė siūlo aprašymas'
        ],
        'salary_from' => [
            'number' => 'Siūlomas atlyginimas turi būti skaičius'
        ],
        'salary_to' => [
            'number' => 'Siūlomas atlyginimas turi būti skaičius'
        ],
        'recruitment_days' => [
            'required' => 'Parašykite per kiek dienų planuojamas įdarbinimas',
            'number' => 'Planuojamas įdarbinimas per d. turi būti skaičius'
        ],
        'contacts_title' => [
            'required' => 'Parašykite pranešimo pavadinimą',
        ],
        'contacts_name' => [
            'required' => 'Parašykite pranešėjo vardą, pavardę',
        ],
        'contacts_email' => [
            'required' => 'Parašykite elektroninį paštą',
            'email' => 'Neteisingai nurodytas el. paštas',
        ],
        'contacts_message' => [
            'required' => 'Parašykite pranešimo tekstą',
        ],
        'banner_name' => [
            'required' => 'Parašykite banerio pavadinimą',
        ],
        'banner_link' => [
            'required' => 'Parašykite banerio nuorodą',
        ],
        'banner_image' => [
            'required' => 'Banerio paveikliukas',
        ],
        'banner_zone' => [
            'required' => 'Pasirinkite banerio zoną',
        ],
		'rf_name' => [
			'required' => 'Nurodykite vardą, pavardę',
		],
		'rf_position' => [
			'required' => 'Nurodykite jūsų užimamas vadovaujamas pareigas',
		],
		'rf_company' => [
			'required' => 'Nurodykite įmonės pavadinimą',
		],
		'rf_telephone' => [
			'required' => 'Nurodykite jūsų mob. tel. numerį',
		],
		'rf_email' => [
			'required' => 'Nurodykite jūsų darbinį el. paštą',
		],
		'rf_question_theme' => [
			'required' => 'Nurodykite jūsų klausimo temą',
		],
		'rf_question' => [
			'required' => 'Nurodykite jūsų klausimą',
		],
		'cf_name' => [
			'required' => 'Nurodykite vardą, pavardę',
		],
		'cf_email' => [
			'required' => 'Nurodykite jūsų el. paštą',
		],
		'cf_question_theme' => [
			'required' => 'Nurodykite jūsų klausimo temą',
		],
		'cf_question' => [
			'required' => 'Nurodykite jūsų klausimą',
		],
        'message' => [
            'required' => 'Parašykite žinutės tekstą',
        ],
        'age' => [
            'required' => 'Nurodykite amžių',
        ]
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
		'title_lt' => trans('admin.fields.page.title'),
		'title_en' => trans('admin.fields.page.title'),
		'title_ru' => trans('admin.fields.page.title'),
		'content_lt' => trans('admin.fields.page.content'),
		'content_en' => trans('admin.fields.page.content'),
		'content_ru' => trans('admin.fields.page.content'),
		'description_lt' => trans('admin.fields.page.description'),
		'description_en' => trans('admin.fields.page.description'),
		'description_ru' => trans('admin.fields.page.description'),
	],

];
