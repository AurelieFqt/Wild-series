<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Lauren Cohen',
        'Andrew Lincoln',
        'Norman Reedus',
        'Danai Gurira',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');

        foreach(self::ACTORS as $key => $name){
            $actor = new Actor();
            $actor->setName($name);
            $actor->addProgram($this->getReference('program_0'));
        }
    
        for ($i = 0; $i <= 50; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(0, 5)));
            $manager->persist($actor);
            
        }
        $manager->flush();
    }

    public function getDependencies()  
    {
        return [ProgramFixtures::class];  
    }

}