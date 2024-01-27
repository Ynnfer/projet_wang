<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Developer;

class DeveloperFixtures extends Fixture
{
    public const DEVELOPER_REFERENCE = "tag";

    public function load(ObjectManager $manager): void
    {


        $nomsDevelopers = [
            'CAPCOM', 'SEGA', 'Larian Studios', 'Electronic Arts', 'Square Enix'
        ];

        foreach ($nomsDevelopers as $key => $nomDeveloper) {
            $developer = new Developer();
            $developer->setName($nomDeveloper);
            $manager->persist($developer);
            $this->addReference(self::DEVELOPER_REFERENCE . '_' . $key + 1, $developer);
        }

        $manager->flush();
    }
}
