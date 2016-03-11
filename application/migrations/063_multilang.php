<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Multilang extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        
        $this->db->query("CREATE TABLE IF NOT EXISTS `language` (
                            `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                            `language_name` varchar(255) NOT NULL,
                            `native_name` varchar(512) DEFAULT NULL,
                            `iso_639_1` varchar(2) NOT NULL,
                            `published` TINYINT(1) NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `iso_639_1` (`iso_639_1`)) ENGINE=InnoDB DEFAULT CHARSET=utf16;");

        $this->db->query('INSERT INTO `language` (`language_name`, `native_name`, `iso_639_1`) 
                            VALUES  ("Abkhaz","аҧсуа бызшәа","ab"),
                                    ("Afar","Afaraf","aa"),
                                    ("Afrikaans","Afrikaans","af"),
                                    ("Akan","Akan","ak"),
                                    ("Albanian","Shqip","sq"),
                                    ("Amharic","አማርኛ","am"),
                                    ("Arabic","العربية","ar"),
                                    ("Aragonese","aragonés","an"),
                                    ("Armenian","Հայերեն","hy"),
                                    ("Assamese","অসমীয়া","as"),
                                    ("Avaric","авар мацӀ","av"),
                                    ("Avestan","avesta","ae"),
                                    ("Aymara","aymar aru","ay"),
                                    ("Azerbaijani","azərbaycan dili","az"),
                                    ("Bambara","bamanankan","bm"),
                                    ("Bashkir","башҡорт теле","ba"),
                                    ("Basque","euskara","eu"),
                                    ("Belarusian","беларуская мова","be"),
                                    ("Bengali","বাংলা","bn"),
                                    ("Bihari","भोजपुरी","bh"),
                                    ("Bislama","Bislama","bi"),
                                    ("Bosnian","bosanski jezik","bs"),
                                    ("Breton","brezhoneg","br"),
                                    ("Bulgarian","български език","bg"),
                                    ("Burmese","ဗမာစာ","my"),
                                    ("Catalan","català","ca"),
                                    ("Chamorro","Chamoru","ch"),
                                    ("Chechen","нохчийн мотт","ce"),
                                    ("Chichewa","chiCheŵa","ny"),
                                    ("Chinese","Zhōngwén","zh"),
                                    ("Chuvash","чӑваш чӗлхи","cv"),
                                    ("Cornish","Kernewek","kw"),
                                    ("Corsican","corsu","co"),
                                    ("Cree","ᓀᐦᐃᔭᐍᐏᐣ","cr"),
                                    ("Croatian","hrvatski jezik","hr"),
                                    ("Czech","čeština","cs"),
                                    ("Danish","dansk","da"),
                                    ("Divehi","ދިވެހި","dv"),
                                    ("Dutch","Nederlands","nl"),
                                    ("Dzongkha","རྫོང་ཁ","dz"),
                                    ("English","English","en"),
                                    ("Esperanto","Esperanto","eo"),
                                    ("Estonian","eesti","et"),
                                    ("Ewe","Eʋegbe","ee"),
                                    ("Faroese","føroyskt","fo"),
                                    ("Fijian","vosa Vakaviti","fj"),
                                    ("Finnish","suomi","fi"),
                                    ("French","français","fr"),
                                    ("Fula","Fulfulde","ff"),
                                    ("Galician","galego","gl"),
                                    ("Georgian","ქართული","ka"),
                                    ("German","Deutsch","de"),
                                    ("Greek (modern)","ελληνικά","el"),
                                    ("Guaraní","Avañe\'ẽ","gn"),
                                    ("Gujarati","ગુજરાતી","gu"),
                                    ("Haitian","Kreyòl ayisyen","ht"),
                                    ("Hausa","هَوُسَ","ha"),
                                    ("Hebrew","עברית","he"),
                                    ("Herero","Otjiherero","hz"),
                                    ("Hindi","हिन्दी","hi"),
                                    ("Hiri Motu","Hiri Motu","ho"),
                                    ("Hungarian","magyar","hu"),
                                    ("Interlingua","Interlingua","ia"),
                                    ("Indonesian","Bahasa Indonesia","id"),
                                    ("Interlingue","Interlingue","ie"),
                                    ("Irish","Gaeilge","ga"),
                                    ("Igbo","Asụsụ Igbo","ig"),
                                    ("Inupiaq","Iñupiaq","ik"),
                                    ("Ido","Ido","io"),
                                    ("Icelandic","Íslenska","is"),
                                    ("Italian","italiano","it"),
                                    ("Inuktitut","ᐃᓄᒃᑎᑐᑦ","iu"),
                                    ("Japanese","","ja"),
                                    ("Javanese","basa Jawa","jv"),
                                    ("Kalaallisut","kalaallisut","kl"),
                                    ("Kannada","ಕನ್ನಡ","kn"),
                                    ("Kanuri","Kanuri","kr"),
                                    ("Kashmiri","कश्मीरी","ks"),
                                    ("Kazakh","қазақ тілі","kk"),
                                    ("Khmer","ខ្មែរ","km"),
                                    ("Kikuyu","Gĩkũyũ","ki"),
                                    ("Kinyarwanda","Ikinyarwanda","rw"),
                                    ("Kyrgyz","Кыргызча","ky"),
                                    ("Komi","коми кыв","kv"),
                                    ("Kongo","Kikongo","kg"),
                                    ("Korean","한국어","ko"),
                                    ("Kurdish","Kurdî","ku"),
                                    ("Kwanyama","Kuanyama","kj"),
                                    ("Latin","latine","la"),
                                    ("Luxembourgish","Lëtzebuergesch","lb"),
                                    ("Ganda","Luganda","lg"),
                                    ("Limburgish","Limburgs","li"),
                                    ("Lingala","Lingála","ln"),
                                    ("Lao","ພາສາລາວ","lo"),
                                    ("Lithuanian","lietuvių kalba","lt"),
                                    ("Luba-Katanga","Tshiluba","lu"),
                                    ("Latvian","latviešu valoda","lv"),
                                    ("Manx","Gaelg","gv"),
                                    ("Macedonian","македонски јазик","mk"),
                                    ("Malagasy","fiteny malagasy","mg"),
                                    ("Malay","bahasa Melayu","ms"),
                                    ("Malayalam","മലയാളം","ml"),
                                    ("Maltese","Malti","mt"),
                                    ("Māori","te reo Māori","mi"),
                                    ("Marathi (Marāṭhī)","मराठी","mr"),
                                    ("Marshallese","Kajin M̧ajeļ","mh"),
                                    ("Mongolian","Монгол хэл","mn"),
                                    ("Nauruan","Dorerin Naoero","na"),
                                    ("Navajo","Diné bizaad","nv"),
                                    ("Northern Ndebele","isiNdebele","nd"),
                                    ("Nepali","नेपाली","ne"),
                                    ("Ndonga","Owambo","ng"),
                                    ("Norwegian Bokmål","Norsk bokmål","nb"),
                                    ("Norwegian Nynorsk","Norsk nynorsk","nn"),
                                    ("Norwegian","Norsk","no"),
                                    ("Nuosu","","ii"),
                                    ("Southern Ndebele","isiNdebele","nr"),
                                    ("Occitan","occitan","oc"),
                                    ("Ojibwe","ᐊᓂᔑᓈᐯᒧᐎᓐ","oj"),
                                    ("Old Church Slavonic","ѩзыкъ словѣньскъ","cu"),
                                    ("Oromo","Afaan Oromoo","om"),
                                    ("Oriya","ଓଡ଼ିଆ","or"),
                                    ("Ossetian","ирон æвзаг","os"),
                                    ("Panjabi","ਪੰਜਾਬੀ","pa"),
                                    ("Pāli","पाऴि","pi"),
                                    ("Persian","فارسی","fa"),
                                    ("Polish","język polski","pl"),
                                    ("Pashto","پښتو","ps"),
                                    ("Portuguese","português","pt"),
                                    ("Quechua","Runa Simi","qu"),
                                    ("Romansh","rumantsch grischun","rm"),
                                    ("Kirundi","Ikirundi","rn"),
                                    ("Romanian","limba română","ro"),
                                    ("Russian","Русский","ru"),
                                    ("Sanskrit","संस्कृतम्","sa"),
                                    ("Sardinian","sardu","sc"),
                                    ("Sindhi","सिन्धी","sd"),
                                    ("Northern Sami","Davvisámegiella","se"),
                                    ("Samoan","gagana fa\'a Samoa","sm"),
                                    ("Sango","yângâ tî sängö","sg"),
                                    ("Serbian","српски језик","sr"),
                                    ("Scottish Gaelic","Gàidhlig","gd"),
                                    ("Shona","chiShona","sn"),
                                    ("Sinhala","සිංහල","si"),
                                    ("Slovak","slovenčina","sk"),
                                    ("Slovene","slovenski jezik","sl"),
                                    ("Somali","Soomaaliga","so"),
                                    ("Southern Sotho","Sesotho","st"),
                                    ("Spanish","español","es"),
                                    ("Sundanese","Basa Sunda","su"),
                                    ("Swahili","Kiswahili","sw"),
                                    ("Swati","SiSwati","ss"),
                                    ("Swedish","svenska","sv"),
                                    ("Tamil","தமிழ்","ta"),
                                    ("Telugu","తెలుగు","te"),
                                    ("Tajik","тоҷикӣ","tg"),
                                    ("Thai","ไทย","th"),
                                    ("Tigrinya","ትግርኛ","ti"),
                                    ("Tibetan Standard","བོད་ཡིག","bo"),
                                    ("Turkmen","Türkmen","tk"),
                                    ("Tagalog","Wikang Tagalog","tl"),
                                    ("Tswana","Setswana","tn"),
                                    ("Tonga","faka Tonga","to"),
                                    ("Turkish","Türkçe","tr"),
                                    ("Tsonga","Xitsonga","ts"),
                                    ("Tatar","татар теле","tt"),
                                    ("Twi","Twi","tw"),
                                    ("Tahitian","Reo Tahiti","ty"),
                                    ("Uyghur","ئۇيغۇرچە‎","ug"),
                                    ("Ukrainian","Українська","uk"),
                                    ("Urdu","اردو","ur"),
                                    ("Uzbek","Oʻzbek","uz"),
                                    ("Venda","Tshivenḓa","ve"),
                                    ("Vietnamese","Tiếng Việt","vi"),
                                    ("Volapük","Volapük","vo"),
                                    ("Walloon","walon","wa"),
                                    ("Welsh","Cymraeg","cy"),
                                    ("Wolof","Wollof","wo"),
                                    ("Western Frisian","Frysk","fy"),
                                    ("Xhosa","isiXhosa","xh"),
                                    ("Yiddish","ייִדיש","yi"),
                                    ("Yoruba","Yorùbá","yo"),
                                    ("Zhuang","Saɯ cueŋƅ","za"),
                                    ("Zulu","isiZulu","zu");');

        $this->db->query("INSERT INTO `permission` (`name`) VALUES
                            ('TRANSLATE_CONTENT');");

        $id = $this->db->insert_id();

        $this->db->query("INSERT INTO `rolepermission` (`role_id`, `permission_id`) VALUES
                            (1, " . $id . ");");

        $this->db->query('ALTER TABLE `page` ADD `language_id` smallint(5) unsigned DEFAULT NULL;');

        $this->db->query('ALTER TABLE `page`
                            ADD CONSTRAINT `fk_page_language1` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`);');        

        
        #$this->db->query("ALTER TABLE `menuitem` ADD `jumpmark` varchar(255) NULL DEFAULT NULL;");
        #$this->db->query('ALTER TABLE `teaserinstance` ADD `jumpmark` varchar(255) NULL DEFAULT NULL;');

    }

    public function mig_down() {

        $this->db->query("ALTER TABLE `page` DROP FOREIGN KEY `fk_page_language1`;");

        $this->db->query("ALTER TABLE `page` DROP `language_id`;");
        
        $this->db->query("DROP TABLE `language`;");

        $sql = $this->db->query("SELECT id FROM permission WHERE `name` = 'TRANSLATE_CONTENT';");
        
        if (isset($sql->row()->id) && $sql->row()->id > 0) {
            $this->db->query("DELETE FROM `rolepermission` WHERE `permission_id` = " . $sql->row()->id . ";");
        }

        $this->db->query("DELETE FROM `permission` WHERE `name` = 'TRANSLATE_CONTENT';");
        
        #$this->db->query("ALTER TABLE `teaserinstance` DROP `jumpmark`;");
    }

}