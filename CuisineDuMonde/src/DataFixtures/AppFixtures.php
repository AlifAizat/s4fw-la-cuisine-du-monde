<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Creator;
use App\Entity\Cuisine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    /**
     * AppFixtures constructor.
     * @param $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {

        /**
         * Création des utilisateurs
         */

        //Roles
        $roles_A = [];
        $roles_A[] = "ROLE_ADMIN";
        $roles_A[] = "ROLE_SUPER_ADMIN";

        $roles_U = [];
        $roles_U[] = "ROLE_USER";

        //Admin
        $admin = new Creator();
        $admin->setEmail("admin@CDM.com");
        $admin->setFirstname("Admin");
        $admin->setLastname("Cuisine Du Monde");
        $admin->setDatecreated(new \DateTime());
        $admin->setPassword($this->passwordEncoder->encodePassword($admin,"passwdAdmin"));
        $admin->setRoles($roles_A);
        $admin->setFolder("adminCDM");

        $manager->persist($admin);

        //Creators
        $creator_1 = new Creator();
        $creator_1->setEmail("aamn@mail.com");
        $creator_1->setFirstname("Alif Aizat");
        $creator_1->setLastname("Mohd Noor");
        $creator_1->setDatecreated(new \DateTime());
        $creator_1->setPassword($this->passwordEncoder->encodePassword($creator_1,"azerty"));
        $creator_1->setRoles($roles_U);
        $creator_1->setFolder("2_AlifAizat_MohdNoor");

        $manager->persist($creator_1);


        $creator_2 = new Creator();
        $creator_2->setEmail("Cecile_Prim@mail.com");
        $creator_2->setFirstname("Cécile");
        $creator_2->setLastname("Primault");
        $creator_2->setDatecreated(new \DateTime());
        $creator_2->setPassword($this->passwordEncoder->encodePassword($creator_2,"azerty"));
        $creator_2->setRoles($roles_U);
        $creator_2->setFolder("3_Cécile_Primault");

        $manager->persist($creator_2);


        /**
         * Création des catégories
         */

        $categories =[
            "française"=>[
                "name"=>"Française",
                "description"=>"La cuisine française fait référence à divers styles gastronomiques dérivés de la tradition française. Elle a évolué au cours des siècles, suivant ainsi les changements sociaux et politiques du pays. La cuisine française n'a été codifiée qu'au xxe siècle, par Auguste Escoffier, pour devenir la référence moderne en matière de grande cuisine. Elle est aujourd'hui encore considérée comme une référence dans le monde en raison de son aspect culturel.",
                "image"=>"images/general/category/french.jpg",
            ],
            "mexicaine"=>[
                "name"=>"Mexicaine",
                "description"=>"La cuisine mexicaine est considérée comme très variée de par son héritage préhispanique (des indigènes de Mésoamérique) et européen (principalement espagnol), conséquence de la conquête espagnole de l'empire Aztèque au cours du xvie siècle. Elle a aussi connu l'influence des cuisines africaines, caraïbéennes, asiatiques et moyen-orientales. La base traditionnelle de cette cuisine est le maïs, ainsi que d'autres aliments d'origine autochtone commela dinde, le haricot, l'avocat et la tomate, la dinde, les cacahuètes, la vanille et le piment, accompagnés de riz, transporté par les Espagnols.",
                "image"=>"images/general/category/mexican.jpg",
            ],
            "Italienne"=>[
                "name"=>"Italienne",
                "description"=>"La cuisine italienne fait partie des cuisines méditerranéennes, où la tomate, les fruits et les légumes de saison occupent une place importante. L'huile d'olive est préférée au beurre, sauf dans le nord du pays, et les viandes blanches (veau, volailles) l'emportent toujours sur les viandes rouges. Le jambon, le lard sous différentes formes, la mortadelle et le salami sont disponibles partout, ainsi que les spaghettis, les raviolis, les lasagnes. Les fromages sont à pâte filée ou secs, comme le parmesan, que l'on râpe pour agrémenter les pâtes.",
                "image"=>"images/general/category/italian.jpg",
            ],
            "indienne"=>[
                "name"=>"Indienne",
                "description"=>"La cuisine indienne recouvre une grande variété de cuisines régionales d'Inde. Elles sont influencées par les épices, herbes, fruits et légumes que l'on trouve dans chaque région du pays, mais également par la religion et l'histoire. Ainsi, le végétarisme est très répandu dans la société indienne, majoritairement d'obédience hindoue, souvent résultat d'éthiques religieuses brahmaniques, jaïnes ou sikhes.",
                "image"=>"images/general/category/indian.jpg",
            ],
            "thaïlandaise"=>[
                "name"=>"Thaïlandaise",
                "description"=>"La cuisine thaïlandaise, bien que semblable en certains points à celle de ses voisins chinois, indiens et birmans, se démarque par des saveurs et des ingrédients originaux, tels que le curry, la menthe, la citronnelle, la coriandre ou encore le basilic rouge. Pimentée à l'excès pour le palais occidental et presque toujours accompagnée de sauces ou fumets de poisson (nam pla), elle rencontre un succès international croissant.",
                "image"=>"images/general/category/thai.jpg",
            ],
            "chinoise"=>[
                "name"=>"Chinoise",
                "description"=>"La cuisine chinoise est une des plus réputées au monde, et sans doute celle qui comporte le plus de variations. Il faut plutôt parler des cuisines chinoises car l’aspect régional est fondamental. Malgré une continuité remarquable dans l’histoire de cette cuisine, l’apparition de cuisines régionales telles que nous les connaissons aujourd’hui est un phénomène assez récent. La première grande division régionale est celle du blé, plus anciennement du millet au nord et du riz au sud.",
                "image"=>"images/general/category/chinese.jpg",
            ],
            "libanaise"=>[
                "name"=>"Libanaise",
                "description"=>"La nourriture libanaise fait partie de la culture locale. La majorité des repas se présentent sous forme de mezzés posés sur la table. Au menu, houmous, caviar d'aubergines, kebbe, fatouch, chanklish, taboulé avec plus de persil que de semoule, boulettes de viande et de nombreux autres plats riches en saveurs à manger avec des pitas, le pain libanais. Mais la cuisine libanaise ne se résume pas aux mezzés. Poulet au riz, poisson grillé, chawarma au bœuf ou au poulet, chik taouk (poulet mariné au citron), etc... ",
                "image"=>"images/general/category/lebanese.jpg",
            ],
            "japonaise"=>[
                "name"=>"Japonaise",
                "description"=>"Le Japon possède une forte tradition culinaire et de nombreux rites associés à la consommation de nourriture. Cuisine asiatique, la cuisine japonaise repose sur le riz, le soja et les produits de la mer ; elle a été fortement influencée par les cuisines chinoise et coréenne, ainsi que par les cuisines occidentales, dont certains plats ont été adaptés aux goûts locaux.",
                "image"=>"images/general/category/japanese.jpg",
            ],
            "américaine"=>[
                "name"=>"Américaine",
                "description"=>"La nourriture américaine est une option de restauration extrêmement populaire. Avec autant de cultures qui entrent et sortent du pays, la cuisine américaine englobe une gamme de styles de restauration différents. À Chicago, la pizza au plat profond est devenue célèbre. Le Texas a du piment à cinq alarmes tandis que le nord-ouest du Pacifique abrite des microbrasseries et du café. Dans la plupart des restaurants américains traditionnels, vous pouvez vous attendre à des hot-dogs, des hamburgers, des ailes de buffle, des biscuits et de la sauce et des omelettes.",
                "image"=>"images/general/category/american.jpg",
            ],
            "marocaine"=>[
                "name"=>"Marocaine",
                "description"=>"La cuisine marocaine est une cuisine méditerranéenne caractérisée par sa variété de plats issus principalement de la cuisine berbère, avec des influences arabes et juives. Malgré ses traits communs avec les cuisines des autres pays nord-africains, la cuisine marocaine a su conserver son originalité et ses spécificités culturelles uniques. En 2015, elle a été classée deuxième cuisine au monde par le site Worldsim.",
                "image"=>"images/general/category/moroccan.jpg",
            ],
            "méditerranéenne"=>[
                "name"=>"Méditerranéenne",
                "description"=>"La cuisine méditerranéenne est la nourriture et les méthodes de préparation des habitants de la région du bassin méditerranéen.La région couvre une grande variété de cultures avec des cuisines distinctes, en particulier la maghrébine et berbère, l’égyptienne, la levantine, la turque, la grecque, l’italienne, la provençale, la chypriote, la maltaise, l’espagnole et la portugaise. La cuisine méditerranéenne ne doit pas être confondue avec le régime méditerranéen, rendue populaire en raison des avantages apparents d'une alimentation riche en huile d'olive, blé et autres céréales, fruits, légumes et une certaine quantité de fruits de mer, mais faible en viande et produits laitiers.",
                "image"=>"images/general/category/mediterranean.jpg",
            ],
            "espagnole"=>[
                "name"=>"Espagnole",
                "description"=>"La cuisine espagnole procède, pour l'essentiel, de commande diète méditerranéenne. La diversité des régions et terroirs de l'Espagne en fait une cuisine très variée et réputée. La gastronomie espagnole a été influencée par ses nombreuses découvertes lors des différentes conquêtes, en Amérique latine, en Asie, en Afrique : diverses épices et nouveaux aliments en sont rapportés comme les tomates, les pommes de terre, la vanille, différentes sortes de pois, le chocolat ; mais aussi par les longues occupations qu'elle a subies : phénicienne, grecque, romaine et aussi maure.",
                "image"=>"images/general/category/french.jpg",
            ],
            "coréenne"=>[
                "name"=>"Coréenne",
                "description"=>"La Corée est une région reconnue pour la variété et la qualité de sa cuisine. Ses grands classiques ne sauraient éclipser un répertoire unique à la gloire du goût sous toutes ses formes et sous tous les modes de préparation. Cette cuisine se distingue de celles des pays voisins, notamment le Japon et la Chine, cependant on retrouve des parfums assez proches dans la cuisine de la province pourtant relativement éloignée de Hubei, en Chine. La cuisine coréenne utilise beaucoup de piment, le sésame, sous forme d'huile et de graines y est une quasi constante, l'ail, ainsi qu'une grande variété de légumes, fruits de mer, légumes sauvages, etc.",
                "image"=>"images/general/category/korean.jpg",
            ],
            "malaisienne"=>[
                "name"=>"Malaisienne",
                "description"=>"La Malaisie est un petit paradis de la gastronomie et la cuisine malaisienne n’est que le reflet de sa population multiculturelle et de son incroyable diversité ethnique. Chinois, indiens, peranakans, malais, mais aussi indonésiens, viets, ou thaïs ont laissé leurs empruntes dans des plats plus délicieux les uns des autres ! En bouche, c’est une véritable explosion de saveurs et un voyage des sens. Chaque produit est cuisiné de mille façons avec de multiples influences et le meilleur moyen de découvrir ces spécialités locales c’est en mangeant dans la rue.",
                "image"=>"images/general/category/malaysian.jpg",
            ],
        ];

        $tabCategories = [];
        foreach ($categories as $cat):
            $cat_buff = new Category($cat["name"], $cat["description"], $cat["image"]);
            $tabCategories[] = $cat_buff;
            $manager->persist($cat_buff);
        endforeach;

        /**
         * Création des types de plat
         */

        $courses = [
            "hd"=>[
                "type"=>"Hors-d'œuvre",
            ],
            "soupe"=>[
                "type"=>"Soupe",
            ],
            "entrée"=>[
                "type"=>"Entrée",
            ],
            "salade"=>[
                "type"=>"Salade",
            ],
            "pc"=>[
                "type"=>"Plat principal",
            ],
            "dessert"=>[
                "type"=>"Dessert",
            ],
        ];

        $tabCourses = [];
        foreach ($courses as $course):
            $course_buff = new Course($course["type"]);
            $tabCourses[] = $course_buff;
            $manager->persist($course_buff);
        endforeach;


        /**
         * Création des cuisines
         */

        //$name="", $datepublished=null, $ingredients="", $recipe="", $image="", $creator=0, $category=0, $type=0)

        //Cuisine1
        $cuisine_1 = new Cuisine();
        $cuisine_1->setVisibility(true);
        $cuisine_1->setName("Tacos mexicains");
        $cuisine_1->setDatepublished(new \DateTime());
        $cuisine_1->setCreator($creator_1);
        $cuisine_1->setCategory($tabCategories[1]);
        $cuisine_1->setType($tabCourses[2]);
        $cuisine_1->setImage("images/user/".$cuisine_1->getCreator()->getFolder().'/'."1_cuisine.jpg");
        $cuisine_1->setIngredients("8 tortillas pour tacos (achetés, ou recette sur le site Marmiton) | 1 oignon blanc | 2 tomates | 1 verre de coulis de tomate (10 cl) | 250 g de boeuf haché | 1 petite boîte de haricots rouges | 1/2 poivron vert | 8 feuilles de laitue |Cumin en poudre| Poivre| Sel|Tabasco (facultatif)|");
        $cuisine_1->setRecipe("A la poêle, faire dorer l'oignon émincé dans un peu d'huile d'olive.| Rajouter la viande, assaisonner et laisser cuire 5 min.| Laver les feuilles de laitue.| Couper les tomates et le poivron en petits dés.| Incorporer le tout à la poêlée avec le coulis de tomate, et poursuivre la cuisson pendant 5 min.| Egoutter les haricots rouges et les ajouter 2 min avant la fin de cuisson.| Hors du feu, ajuster l'assaisonnement et saupoudrer généreusement de cumin; on peut aussi rajouter quelques gouttes de Tabasco.| Garnir les tortillas de préparation et les refermer en les roulant comme des crêpes. Disposer 1 feuille de laitue sur chaque tacos avant de servir.|");
        $manager->persist($cuisine_1);

        //Cuisine2
        $cuisine_2 = new Cuisine();
        $cuisine_2->setVisibility(true);
        $cuisine_2->setName("Velouté de Potiron et Carottes");
        $cuisine_2->setDatepublished(new \DateTime());
        $cuisine_2->setCreator($creator_1);
        $cuisine_2->setCategory($tabCategories[0]);
        $cuisine_2->setType($tabCourses[2]);
        $cuisine_2->setImage("images/user/".$cuisine_2->getCreator()->getFolder().'/'."2_cuisine.jpeg");
        $cuisine_2->setIngredients("1 kg de potiron| 500 g de carotte| 2 pommes de terre| 1 gousse d'ail| 1 oignon| 1/2 l de lait| 1/2 l de bouillon de volaille| 1 cuillère à soupe d'huile d'olive| Persil| Poivre| Sel| Muscade| 10 cl de crème liquide (facultatif)|");
        $cuisine_2->setRecipe("Éplucher et couper en dés le potiron, les pommes de terre, les carottes en rondelles.| Emincer l'ail et l'oignon.| Faire suer l'oignon dans l'huile d'olive.| Ajouter tous les légumes et l'ail puis verser le bouillon et le lait.| Saler, poivrer, \"muscader\" et laisser cuire environ une trentaine de minutes.| Mixer le tout (ajouter éventuellement la crème) et rectifier l'assaisonnement si nécessaire.| Bon appétit !|");
        $manager->persist($cuisine_2);

        //Cuisine3
        $cuisine_3 = new Cuisine();
        $cuisine_3->setVisibility(true);
        $cuisine_3->setName("Boeuf bourguignon");
        $cuisine_3->setDatepublished(new \DateTime());
        $cuisine_3->setCreator($creator_2);
        $cuisine_3->setCategory($tabCategories[0]);
        $cuisine_3->setType($tabCourses[4]);
        $cuisine_3->setImage("images/user/".$cuisine_3->getCreator()->getFolder().'/'."3_cuisine.jpg");
        $cuisine_3->setIngredients("600 g de bourguignon| 4 oignons| 4 carottes| 1 bouquet garni| 1 bouteille de vin rouge assez bon| 100 g de beurre| Sel| Poivre|");
        $cuisine_3->setRecipe("Détailler la viande en cubes de 3 cm de côté, enlever les gros morceaux de gras.| Couper l'oignon en morceaux. Le faire revenir dans une poêle au beurre. Une fois transparent, le verser dans une cocotte en fonte de préférence.| Procéder de même avec la viande mais en plusieurs fois, jusqu'à ce que tous les morceaux soient cuits. Les ajouter au fur et à mesure dans la cocotte. Ne pas avoir peur d'ajouter du beurre entre chaque fournée.| Quand toute la viande est dans la cocotte, déglacer la poêle avec de l'eau ou du vin et faire bouillir en raclant pour récupérer le suc. Saler, poivrer, ajouter au reste.| Recouvrir le tout avec une partie du vin et faire mijoter quelques heures avec le bouquet garni et les carottes en rondelles.| Le lendemain, faire mijoter au moins 2 heures en plusieurs fois, ajouter du vin ou de l'eau si nécessaire.|");
        $manager->persist($cuisine_3);

        //Cuisine4
        $cuisine_4 = new Cuisine();
        $cuisine_4->setVisibility(true);
        $cuisine_4->setName("Chili con carne");
        $cuisine_4->setDatepublished(new \DateTime());
        $cuisine_4->setCreator($creator_2);
        $cuisine_4->setCategory($tabCategories[8]);
        $cuisine_4->setType($tabCourses[4]);
        $cuisine_4->setImage("images/user/".$cuisine_4->getCreator()->getFolder().'/'."4_cuisine.jpg");
        $cuisine_4->setIngredients("2 oignons| 3 gousses d'ail| 1 poivron| 1 boîte de tomate au naturel pelées| 750 g de haricots rouges (poids égoutté)| 1 kg de boeuf haché (je préfère mais pour les puristes le boeuf coupé en morceaux est possible)| 50 cl de bouillon kub| 4 cuillères à soupe d'olives| 1 cuillère à café de cumin| 1 cuillère à café d'origan séché| Tabasco| 2 cuillères à café de piment d'Espelette| 1/2 cuillère à café de piment de Cayenne| Sel|");
        $cuisine_4->setRecipe("Hacher ails et oignons et les faire revenir dans l'huile d'olive dans une grande cocotte (prévoir l'équivalent de la cocotte Seb 4,5 l) pendant 10 mn ensuite ajouter la viande et remuer pendant 5-6 mn.| Ajouter le cumin, l'origan, les piments et le Tabasco (plus ou moins selon votre goût). Saler, remuer consciencieusement et mettez sur feux doux. |Mouiller avec le bouillon, ajouter tomates et poivron coupé en dés et laisser mijoter pendant 1 heure.| Ajouter les haricots égouttés et laisser cuire encore une heure.|");
        $manager->persist($cuisine_4);

        //Cuisine5
        $cuisine_5 = new Cuisine();
        $cuisine_5->setVisibility(true);
        $cuisine_5->setName("Gâteau au yaourt");
        $cuisine_5->setDatepublished(new \DateTime());
        $cuisine_5->setCreator($creator_2);
        $cuisine_5->setCategory($tabCategories[0]);
        $cuisine_5->setType($tabCourses[5]);
        $cuisine_5->setImage("images/user/".$cuisine_5->getCreator()->getFolder().'/'."5_cuisine.jpg");
        $cuisine_5->setIngredients("1/2 paquet de levure chimique| 1 pot de yaourt nature| 1/2 pot d'huile de colza| 2 pots de sucre semoule| 3 pots de farine| 2 oeufs| 1 zeste de citron jaune|");
        $cuisine_5->setRecipe("Préchauffer le four à 180°C (thermostat 6).| Mélanger tout simplement les ingrédients un à un en suivant l'ordre suivant :| levure,| yaourt| huile| sucre| farine| oeuf et zeste| Beurrer un moule à manqué et y verser la pâte.| Enfourner pour environ 30 minutes de cuisson.| Vérifier la cuisson avec la pointe d'un couteau (elle doit ressortir sèche).|");
        $manager->persist($cuisine_5);

        //Cuisine6
        $cuisine_6 = new Cuisine();
        $cuisine_6->setVisibility(true);
        $cuisine_6->setName("Le crumble aux pommes du Chat qui Tousse");
        $cuisine_6->setDatepublished(new \DateTime());
        $cuisine_6->setCreator($creator_1);
        $cuisine_6->setCategory($tabCategories[11]);
        $cuisine_6->setType($tabCourses[5]);
        $cuisine_6->setImage("images/user/".$cuisine_6->getCreator()->getFolder().'/'."6_cuisine.jpg");
        $cuisine_6->setIngredients("6 pommes (des Canada par exemple)| 150 g de cassonade| 150 g de farine de blé| 125 g de beurre doux (le sortir 1/2 heure avant de commencer la recette)| 1 petite cuillère de cannelle en poudre| 1 sachet de sucre vanillé| Citron|");
        $cuisine_6->setRecipe("Préchauffer le four à 210°C (thermostat 7).| Peler, évider et découper les pommes en cubes grossiers, les répartir dans un plat allant au four.| Les arroser de jus du citron et les saupoudrer de cannelle et de sucre vanillé.| Dans un saladier, mélanger la farine et la cassonade. Puis ajouter le beurre en petits cubes et mélanger à la main de façon à former une pâte grumeleuse.| Émietter cette pâte au dessus des pommes de façon à les recouvrir.| Enfourner pour 30 minutes de cuisson.| Servir tiède avec de la crème fouettée ou de la glace à la vanille.|");
        $manager->persist($cuisine_6);

        //Cuisine7
        $cuisine_7 = new Cuisine();
        $cuisine_7->setVisibility(true);
        $cuisine_7->setName("Toast d'anchois");
        $cuisine_7->setDatepublished(new \DateTime());
        $cuisine_7->setCreator($creator_1);
        $cuisine_7->setCategory($tabCategories[10]);
        $cuisine_7->setType($tabCourses[0]);
        $cuisine_7->setImage("images/user/".$cuisine_7->getCreator()->getFolder().'/'."7_cuisine.jpg");
        $cuisine_7->setIngredients("1 boîte d'anchois à l huile| tranche de pain| Beurre| 1 gousse d'ail| 1 dl de vinaigre|");
        $cuisine_7->setRecipe("Faire mariner les anchois dans un bol à demi rempli de vinaigre à l'échalote et de gousses d'une d'ail écrassée pendant 20 mn.| En attendant, faire revenir au beurre dans une poelle les tranches de pain en les laissant légèrement griller.| Les découper en carrés, les beurrer et poser un anchois mariné sur chaque carré.| Servir immédiatement (en apéritif).|");
        $manager->persist($cuisine_7);

        //Cuisine8
        $cuisine_8 = new Cuisine();
        $cuisine_8->setVisibility(true);
        $cuisine_8->setName("Pain d'épices alsacien");
        $cuisine_8->setDatepublished(new \DateTime());
        $cuisine_8->setCreator($creator_1);
        $cuisine_8->setCategory($tabCategories[2]);
        $cuisine_8->setType($tabCourses[0]);
        $cuisine_8->setImage("images/user/".$cuisine_8->getCreator()->getFolder().'/'."8_cuisine.jpg");
        $cuisine_8->setIngredients("1250 g de farine| 1100 g de miel| 500 g de sucre| 250 g de beurre| 600 g d'amandes râpées| 100 g de citron confites| 100 g de cédrat confites| 100 g d'écorces d'oranges confites| 50 g de cannelle en poudre| 1 cuillère à soupe d'anis moulu| 1 cuillère à soupe de cardamome moulu et de gingembre en poudre| 4 citrons non traités| 1 muscade râpée| 1 pincée de poivre| 1 pincée de sel| 1 sachet de levure chimique| 2 citrons (pour leur jus)| 2 dl de kirsch| Sucre glace|");
        $cuisine_8->setRecipe("Chauffer le sucre et le miel dans une casserole à feu doux en mélangeant puis laiser tiédir.| Ajouter hors du feu les amandes + les écorces confites + les épices + le poivre + le sel + le beurre ramolli + les zestes de citrons.| A part mélanger la farine et la levure puis incorporer la au mélange précédent en mélangeant jusqu'à obtention d'une pâte compacte.| Ajouter le kirsch et le jus de citron.| Couvrir et laisser reposer 8 jours au frais.| Puis étaler la pâte sur une plaque beurrée (épaisseur 0,5 cm).| Faire cuire 15 mn à 180°C.| Dès la sortie du four badigeonner la surface avec un glaçage (sucre glace + jus de citron).| Le glaçage une fois durcit couper des rectangles|");
        $manager->persist($cuisine_8);

        //Cuisine9
        $cuisine_9 = new Cuisine();
        $cuisine_9->setVisibility(true);
        $cuisine_9->setName("Soupe de champignons");
        $cuisine_9->setDatepublished(new \DateTime());
        $cuisine_9->setCreator($creator_1);
        $cuisine_9->setCategory($tabCategories[0]);
        $cuisine_9->setType($tabCourses[1]);
        $cuisine_9->setImage("images/user/".$cuisine_9->getCreator()->getFolder().'/'."9_cuisine.jpg");
        $cuisine_9->setIngredients("1 barquette de champignon de Paris| 4 pommes de terre moyenne| 1 oignon| 4 gousses d'ail| Poivre| Sel| Muscade| Persil| 1 kub or| Crème liquide (environ 20 cl)|");
        $cuisine_9->setRecipe("Dans une cocotte, faire revenir dans un peu de beurre : les champignons, les pommes de terres, l'oignon émincé et l'ail émincé.| Laisser revenir quelques minutes pour faire \"suer\" les champignons en remuant bien.| Une fois le tout revenu, mettre un peu plus d'eau que le niveau de légumes et laisser frémir à feu doux en mélangeant de temps en temps.| Ajouter sel, poivre, muscade et persil ainsi que le bouillon émietté.| Une fois la soupe cuite, ajouter la crème mélanger et mixer la soupe.| Servir chaud.|");
        $manager->persist($cuisine_9);

        //Cuisine10
        $cuisine_10 = new Cuisine();
        $cuisine_10->setVisibility(true);
        $cuisine_10->setName("Soupe de céleri et marrons et tuiles d’épices");
        $cuisine_10->setDatepublished(new \DateTime());
        $cuisine_10->setCreator($creator_2);
        $cuisine_10->setCategory($tabCategories[0]);
        $cuisine_10->setType($tabCourses[1]);
        $cuisine_10->setImage("images/user/".$cuisine_10->getCreator()->getFolder().'/'."10_cuisine.jpg");
        $cuisine_10->setIngredients("2 oignons| 1 poireau| 1 cuillère à café d'huile d'olive| 1/2 cuillère à café de cumin en poudre| 400 g de céleri-rave| 400 g de marrons (sous vide)| 10 g de beurre| 10 g de farine| 1 blanc d'oeuf| 1 pincée de paprika| 1 pincée de gingembre| 1 pincée de curry| 1 pincée de muscade| 1 pincée de poivre 5 baies| 1 citron vert pour le zeste| Sel|");
        $cuisine_10->setRecipe("Couper les oignons en fines lamelles.| Eplucher le poireau et enlever les branches, puis le couper en lamelles.| Mettre l’huile à chauffer dans une casserole, à feu vif et y faire revenir les oignons.| Quand ils sont bien dorés, ajouter le cumin et laisser revenir pendant 2 min.| Ajouter les rondelles de poireaux, le céleri épluché et coupé en cubes. Faire revenir à feu moyen, encore 5 min, puis ajouter les marrons.| Verser 800 ml d’eau bouillante dans la casserole.| Laisser cuire pendant 30 min à feu doux.| Vérifier la cuisson en piquant le céleri pour voir s’il est tendre.| Ajuster l’assaisonnement avec le sel puis mixer finement.| Allumer le four à 180°C (thermostat 6).| Mélanger le beurre ramolli avec la farine puis le blanc d’œuf et le sel jusqu’à l’obtention d’une pâte fluide.| Etaler cette pâte sur un papier cuisson sur la plaque du four à l’aide d’une spatule.| Former 6 tuiles et les parsemer d’épices.| Enfourner 5 à 6 min.| Servir la soupe avec des zestes de citron vert sur le dessus et les tuiles aux épices.|");
        $manager->persist($cuisine_10);


        /**
         * Final flush
         */
        $manager->flush();
    }
}
