<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Video;



/**
 * Class InheritanceEntitiesFixtures
 * @package App\DataFixtures
 */
class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 2; $i++)
        {
            $author = new Author();
            $author->setName('author name '. $i);
            $manager->persist($author);

            for ($j = 1; $j <= 3; $j++)
            {
                $pdf = new Pdf();
                $pdf->setFilename('pdf name of user'. $j);
                $pdf->setDescription('pdf description of user'. $j);
                $pdf->setSize(5454);
                $pdf->setOrientation('portrait');
                $pdf->setPagesNumber(123);
                $pdf->setAuthor($author);

                $manager->persist($pdf);
            }


            for ($k = 1; $k <= 3; $k++)
            {
                $video = new Video();
                $video->setFilename('video name of user'. $k);
                $video->setDescription('video description of user'. $k);
                $video->setSize(321);
                $video->setFormat('mpeg-2');
                $video->setDuration(123);
                $video->setAuthor($author);

                $manager->persist($video);
            }
        }

        $manager->flush();
    }
}
