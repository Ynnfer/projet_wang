<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Tag;


class TagFixtures extends Fixture
{
    public const TAG_REFERENCE_RPG = 'tagRPG';
    public const TAG_REFERENCE_Action = 'tagAction';
    public const TAG_REFERENCE_Aventure = 'tagAventure';
    public const TAG_REFERENCE_Course = 'tagCourse';
    public const TAG_REFERENCE_Simulation = 'tagSimulation';
    public const TAG_REFERENCE_Strategie = 'tagStratégie';

    public function load(ObjectManager $manager): void
    {

        $tagRPG = new Tag();
        $tagRPG->setName('RPG');
        $manager->persist($tagRPG);
        
        $tagAction = new Tag();
        $tagAction->setName('Action');
        $manager->persist($tagAction);

        $tagAventure = new Tag();
        $tagAventure->setName('Aventure');
        $manager->persist($tagAventure);

        $tagCourse = new Tag();
        $tagCourse->setName('Course');
        $manager->persist($tagCourse);

        $tagSimulation = new Tag();
        $tagSimulation->setName('Simulation');
        $manager->persist($tagSimulation);

        $tagStrategie = new Tag();
        $tagStrategie->setName('Stratégie');
        $manager->persist($tagStrategie);

        // Create a reference
        $this->addReference(self::TAG_REFERENCE_RPG, $tagRPG);
        $this->addReference(self::TAG_REFERENCE_Action, $tagAction);
        $this->addReference(self::TAG_REFERENCE_Aventure, $tagAventure);
        $this->addReference(self::TAG_REFERENCE_Course, $tagCourse);
        $this->addReference(self::TAG_REFERENCE_Simulation, $tagSimulation);
        $this->addReference(self::TAG_REFERENCE_Strategie, $tagStrategie);

        $manager->flush();
    }
}
