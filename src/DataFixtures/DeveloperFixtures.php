<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Developer;

class DeveloperFixtures extends Fixture
{
    public const DEVELOPER_REFERENCE_1 = 'developer1';
    public const DEVELOPER_REFERENCE_2 = 'developer2';
    public const DEVELOPER_REFERENCE_3 = 'developer3';
    public const DEVELOPER_REFERENCE_4 = 'developer4';
    public const DEVELOPER_REFERENCE_5 = 'developer5';

    public function load(ObjectManager $manager): void
    {
        $developer1 = new Developer();
        $developer1->setName('CAPCOM');
        $manager->persist($developer1);

        $developer2 = new Developer();
        $developer2->setName('SEGA');
        $manager->persist($developer2);

        $developer3 = new Developer();
        $developer3->setName('Larian Studios');
        $manager->persist($developer3);

        $developer4 = new Developer();
        $developer4->setName('Electronic Arts');
        $manager->persist($developer4);

        $developer5 = new Developer();
        $developer5->setName('Square Enix');
        $manager->persist($developer5);

        // Add references for later use in other fixtures
        $this->addReference(self::DEVELOPER_REFERENCE_1, $developer1);
        $this->addReference(self::DEVELOPER_REFERENCE_2, $developer2);
        $this->addReference(self::DEVELOPER_REFERENCE_3, $developer3);
        $this->addReference(self::DEVELOPER_REFERENCE_4, $developer4);
        $this->addReference(self::DEVELOPER_REFERENCE_5, $developer5);

        $manager->flush();
    }
}
