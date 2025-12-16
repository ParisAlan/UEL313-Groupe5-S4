<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Liens;

class LiensFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un nouveau lien ! ( Le premier ! )
        $link = new Liens();
        $link->setLienTitre("Campus Virtuel TIC");
        $link->setLienUrl("https://cvtic.unilim.fr/");
        $link->setLienDesc("Site internet du CvTIC.");
        $manager->persist($link);


        // Création d'un nouveau lien ! ( 2 )
        $link = new Liens();
        $link->setLienTitre("Duck Duck Go");
        $link->setLienUrl("https://duckduckgo.com/");
        $link->setLienDesc("Le moteur de recherche qui ne trace pas ses utilisateurs.");
        $manager->persist($link);


        // Création d'un nouveau lien ! ( 3 )
        $link = new Liens();
        $link->setLienTitre("Framasoft");
        $link->setLienUrl("https://framasoft.org/");
        $link->setLienDesc("Un réseau dédié à la promotion du « libre » en général et du logiciel libre en particulier.");
        $manager->persist($link);

        $manager->flush();
    }
}
