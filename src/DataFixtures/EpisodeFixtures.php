<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');

        for ($i = 0; $i <= 5; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                for ($k = 1; $k <= 3; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->realText($maxNbChars = 100));
                    $episode->setNumber($k);
                    $episode->setSynopsis($faker->realText($maxNbChars = 255));
                    $episode->setSeason($this->getReference('program_' . $i . 'season_' . $j));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

}