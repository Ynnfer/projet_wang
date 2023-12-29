<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Dlc;
use App\Entity\Detail;

class DlcFixtures extends Fixture
{
    public const DLC_REFERENCE_1 = 'dlc1';
    public const DLC_REFERENCE_2 = 'dlc2';
    public const DLC_REFERENCE_3 = 'dlc3';
    public const DLC_REFERENCE_4 = 'dlc4';

    public function load(ObjectManager $manager): void
    {
        $dlc1 = new Dlc();
        $dlc1->setName('Legendary Costume');
        $detail = new Detail();
        $detail->setDescription("Le Lot Costumes des légendes pour Yakuza: Like a Dragon inclut huit costumes de personnages emblématiques de la série Yakuza.");
        $detail->setPrice(1.99);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/1289211/ss_954cb10000dea9199951aaee77f891f79d3b1512.1920x1080.jpg?t=1624532748");
        $dlc1->addDetail($detail);

        $manager->persist($detail);
        $manager->persist($dlc1);

        $dlc2 = new Dlc();
        $dlc2->setName('MONSTER HUNTER WORLD: ICEBORNE');
        $detail = new Detail();
        $detail->setDescription("Intégrez les rangs de la Commission de Recherche alors qu'elle se lance dans une aventure inoubliable au cœur du Givre éternel, une toundra enneigée qui abrite une horde de monstres légendaires.");
        $detail->setPrice(39.99);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/1118010/header.jpg?t=1702368891");
        $dlc2->addDetail($detail);

        $manager->persist($detail);
        $manager->persist($dlc2);


        $dlc3 = new Dlc();
        $dlc3->setName('FF7R EPISODE INTERmission');
        $detail = new Detail();
        $detail->setDescription("Cet épisode est constitué de deux chapitres séparés de l'histoire principale de FINAL FANTASY VII REMAKE. Jouez Yuffie, une shinobi du Wutai qui s'infiltre à Midgar avec son partenaire grâce à l'aide de la branche principale d'Avalanche afin de dérober une matéria ultime créée par la Shinra.");
        $detail->setPrice(0);
        $detail->setImage("https://myviewscreen.files.wordpress.com/2022/01/ff7rintermission-1.jpg?w=1200");
        $dlc3->addDetail($detail);

        $manager->persist($detail);
        $manager->persist($dlc3);

        $dlc4 = new Dlc();
        $dlc4->setName('Ultimate Costume Set');
        $detail = new Detail();
        $detail->setDescription("Le Lot Costumes des légendes pour Yakuza: Like a Dragon inclut huit costumes de personnages emblématiques de la série Yakuza.");
        $detail->setPrice(1.99);
        $detail->setImage("https://cdn.cloudflare.steamstatic.com/steam/apps/1289191/header.jpg?t=1614438562");
        $dlc4->addDetail($detail);

        $manager->persist($detail);
        $manager->persist($dlc4);
       
        // Add references for later use in other fixtures
        $this->addReference(self::DLC_REFERENCE_1, $dlc1);
        $this->addReference(self::DLC_REFERENCE_2, $dlc2);
        $this->addReference(self::DLC_REFERENCE_3, $dlc3);
        $this->addReference(self::DLC_REFERENCE_4, $dlc4);

        $manager->flush();
    }
}
