<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Tag;


class TagFixtures extends Fixture
{
    public const TAG_REFERENCE="tag";

    public function load(ObjectManager $manager): void
    {
        $nomsTags = [
            'RPG', 'Action', 'Aventure', 'Course', 'Simulation', 'Strategie'
        ];

        foreach ($nomsTags as $key => $nomTag) {
            $tag = new Tag();
            $tag->setName($nomTag);
            $manager->persist($tag);
            $this->addReference(self::TAG_REFERENCE. '_' . $nomTag, $tag);
        }

        $manager->flush();
    }
}
