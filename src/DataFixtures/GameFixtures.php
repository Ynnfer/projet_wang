<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Enum\GameStatus;
use App\Entity\Game;
use App\Entity\Tag;
use App\Entity\Detail;
use App\Entity\Developer;
use App\Entity\Dlc;


class GameFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        // Obtient la référence de l’objet d’étiquette que vous avez créée précédemment
        $tagRPG = $this->getReference(TagFixtures::TAG_REFERENCE . "_RPG");
        $tagAction = $this->getReference(TagFixtures::TAG_REFERENCE . "_Action");
        $tagAventure = $this->getReference(TagFixtures::TAG_REFERENCE . "_Aventure");
        $tagCourse = $this->getReference(TagFixtures::TAG_REFERENCE . "_Course");
        $tagSimulation = $this->getReference(TagFixtures::TAG_REFERENCE . "_Simulation");
        $tagStrategie = $this->getReference(TagFixtures::TAG_REFERENCE . "_Strategie");

        // 
        $dlc1 = $this->getReference(DlcFixtures::DLC_REFERENCE_1);
        $dlc2 = $this->getReference(DlcFixtures::DLC_REFERENCE_2);
        $dlc3 = $this->getReference(DlcFixtures::DLC_REFERENCE_3);
        $dlc4 = $this->getReference(DlcFixtures::DLC_REFERENCE_4);

        $developer1 = $this->getReference(DeveloperFixtures::DEVELOPER_REFERENCE . "_1");
        $developer2 = $this->getReference(DeveloperFixtures::DEVELOPER_REFERENCE . "_2");
        $developer3 = $this->getReference(DeveloperFixtures::DEVELOPER_REFERENCE . "_3");
        $developer4 = $this->getReference(DeveloperFixtures::DEVELOPER_REFERENCE . "_4");
        $developer5 = $this->getReference(DeveloperFixtures::DEVELOPER_REFERENCE . "_5");

        $game1 = new Game();
        $game1->setName("YAKUZA: LIKE A DRAGON");
        $game1->setDeveloper($developer2);
        $game1->setGameStatus(GameStatus::Released);
        $game1->addDlc($dlc1);
        $game1->addDlc($dlc4);
        $game1->addTag($tagAction);
        $game1->addTag($tagRPG);
        $game1->addTag($tagAventure);
        $detail = new Detail();
        $detail->setDescription("Incarnez Ichiban Kasuga, jeune recrue des yakuzas, laissé pour mort par l'homme en qui il avait le plus confiance. Armez-vous de votre batte légendaire et préparez-vous à éclater des têtes parmi les membres de la pègre au fil de combats RPG dynamiques, dans le Japon actuel.");
        $detail->setPrice(59.99);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/1235140/header.jpg?t=1695185659");
        $game1->setDetail($detail);

        $manager->persist($detail);
        $manager->persist($game1);

        $game2 = new Game();
        $game2->setName("Football Manager 2008");
        $game2->setDeveloper($developer2);
        $game2->setGameStatus(GameStatus::Withdrawn);
        $game2->addTag($tagCourse);
        $game2->addTag($tagStrategie);
        $detail = new Detail();
        $detail->setDescription("Football Manager 2008 (communément appelé FM2008) est la référence des jeux de management de football.");
        $detail->setPrice(9.99);
        $detail->setImage("https://th.bing.com/th/id/OIP.sQG-kZ8VBR53WDQGrw1TGgAAAA?rs=1&pid=ImgDetMain");
        $game2->setDetail($detail);

        $manager->persist($detail);
        $manager->persist($game2);

        $game3 = new Game();
        $game3->setName("Like a Dragon: Infinite Wealth");
        $game3->setDeveloper($developer2);
        $game3->setGameStatus(GameStatus::Unreleased);
        $game3->addTag($tagAction);
        $game3->addTag($tagRPG);
        $game3->addTag($tagAventure);
        $detail = new Detail();
        $detail->setDescription("Deux héros hors du commun réunis par un coup du sort, ou peut-être par quelque chose de plus sinistre… Menez la grande vie au Japon et explorez tout ce que Hawaï a à offrir dans une aventure si vaste qu'elle s'étend sur tout le Pacifique.");
        $detail->setPrice(69.99);
        $detail->setImage("https://www.atlus.com/ztoolbar/images/feature_card_01.jpg");
        $game3->setDetail($detail);

        $manager->persist($detail);
        $manager->persist($game3);

        $game4 = new Game();
        $game4->setName("Baldur's Gate 3");
        $game4->setDeveloper($developer3);
        $game4->setGameStatus(GameStatus::Released);
        $game4->addTag($tagRPG);
        $game4->addTag($tagAventure);
        $detail = new Detail();
        $detail->setDescription("Constituez votre groupe et retournez aux Royaumes Oubliés dans une histoire d'amitié, de trahison, de sacrifice et de survie, sur fond d'attrait du pouvoir absolu.");
        $detail->setPrice(59.99);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/1086940/header.jpg?t=1703250718");
        $game4->setDetail($detail);

        $manager->persist($detail);
        $manager->persist($game4);

        $game5 = new Game();
        $game5->setName("Monster Hunter: World");
        $game5->setDeveloper($developer1);
        $game5->setGameStatus(GameStatus::Released);
        $game5->addDlc($dlc2);
        $game5->addTag($tagAction);
        $game5->addTag($tagRPG);
        $detail = new Detail();
        $detail->setDescription("Bienvenue dans le Nouveau Monde ! 'Monster Hunter: World' offre une dimension de jeu et une liberté sans commune mesure avec les précédents épisodes. Les chasseurs pourront utiliser un arsenal varié pour chasser un bestiaire unique dans un monde fabuleux !");
        $detail->setPrice(29.99);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/582010/header.jpg?t=1703266594");
        $game5->setDetail($detail);

        $manager->persist($detail);
        $manager->persist($game5);


        $game6 = new Game();
        $game6->setName("The Sims™ 4");
        $game6->setDeveloper($developer4);
        $game6->setGameStatus(GameStatus::Released);
        $game6->addTag($tagSimulation);
        $detail = new Detail();
        $detail->setDescription("Profitez du pouvoir de créer et de contrôler des personnages dans un monde virtuel où il n'y a aucune règle. Soyez puissant et libre, amusez-vous et jouez avec la vie !");
        $detail->setPrice(0);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/1222670/header.jpg?t=1701972583");
        $game6->setDetail($detail);

        $manager->persist($detail);
        $manager->persist($game6);

        $game7 = new Game();
        $game7->setName("FINAL FANTASY VII REMAKE INTERGRADE");
        $game7->setDeveloper($developer5);
        $game7->setGameStatus(GameStatus::Released);
        $game7->addDlc($dlc3);
        $game7->addTag($tagAction);
        $game7->addTag($tagRPG);
        $detail = new Detail();
        $detail->setDescription("Vivez l'histoire passionnante de Cloud Strife à Midgar dans cette renaissance de l'emblématique FINAL FANTASY VII à travers des graphismes de pointe, des combats épiques mêlant action et commandes classiques, et un épisode bonus consacré à Yuffie Kisaragi.");
        $detail->setPrice(79.99);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/1462040/header.jpg?t=1696383548");
        $game7->setDetail($detail);

        $manager->persist($detail);
        $manager->persist($game7);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DeveloperFixtures::class,
            DlcFixtures::class,
            TagFixtures::class,
        ];
    }
}
