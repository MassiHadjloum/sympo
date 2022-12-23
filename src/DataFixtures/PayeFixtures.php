<?php

namespace App\DataFixtures;

use App\Entity\Paye;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PayeFixtures extends Fixture
{
    private $data = [
        ['name' => "UK", 'drapeau' => "https://i.ebayimg.com/images/g/zmYAAOSwRRZbEplX/s-l1600.jpg"],
        ['name' => "USA", 'drapeau' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqADLELYhpaDwe3YOpvjSkelMjDFc5RyMWAra94egIBCT4BqiuH7Bu0r4ZE08kxcmispA&usqp=CAU"],
        ['name' => "ALGERIA", 'drapeau' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTa5eHXi36Clo9TSfnunYXdT2uweDs3QmEYeg&usqp=CAU"],
        ['name' => "FRANCE", 'drapeau' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMVlKMBSEBTWlf1BOUZQN1CecHshOycrn2vA&usqp=CAU"],
        ['name' => "QATAR", 'drapeau' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZjmghIZB6K-hTte1yGoyyO9H4OEmCEQXuog&usqp=CAU"],
        ['name' => "CANADA", 'drapeau' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbSa08DlX3GHSC9LW_W1hLfHtKTL1P1A2AeA&usqp=CAU"],
        ['name' => "ITALY", 'drapeau' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2v9L0ZUJYt_VTIf4MxdqPVFtPnPQIvi3qcQ&usqp=CAU"],
        ['name' => "GERMANY", 'drapeau' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIYGksWZrWV4pjgkZrWGbg_VhlXQxLOMiCWQ&usqp=CAU"]
    ];
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < count($this->data) ; $i++) { 
            # code...
            $paye = new Paye();
            $paye->setName($this->data[$i]['name'])
                ->setDrapeau($this->data[$i]['drapeau']);
            $this->addReference("refPaye$i", $paye);
            $manager->persist($paye);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
