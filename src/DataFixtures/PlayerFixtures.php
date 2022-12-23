<?php

namespace App\DataFixtures;

use App\Entity\Player;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture implements OrderedFixtureInterface
{
    public function getOrder():array
	{
		return [
			Team::class,
		];
	}

    private $data = [
        ['firstname' => "Luka", 'lastname' => "Modrić", 'birthday' => "1985-09-09", 'portrait' => "http://t2.gstatic.com/licensed-image?q=tbn:ANd9GcSxep3ad488dMr7eQbwoB50Uw4zU8BA150BZzei7FryFky-oJosqzekkC4mLp-PZxayQ14MknACNbtHSx4", 'number' => 10],
        ['firstname' => "Achraf", 'lastname' => "Hakimi", 'birthday' => "1998-11-04", 'portrait' => "https://www.psg.fr/media/207359/4.jpg?quality=60&width=1000&bgcolor=ffffff", 'number' => 6],
        ['firstname' => "Lionel", 'lastname' => "Messi", 'birthday' => "1987-06-24", 'portrait' => "https://cdn.britannica.com/34/212134-050-A7289400/Lionel-Messi-2018.jpg", 'number' => 10],
        ['firstname' => "Kylian", 'lastname' => "Mbappé", 'birthday' => "1998-12-23", 'portrait' => "http://t3.gstatic.com/licensed-image?q=tbn:ANd9GcQ2Yt_ER0yxQNhXgcmDQw_LIgpagFiXZT40BsFQxy3PlcKCFmnd_5AhiVIf4ihBGUFjX8d1qPylGXsLgiE", 'number' => 7],
        ['firstname' => "Kevin", 'lastname' => "De Bruyne", 'birthday' => "1995-10-14", 'portrait' => "https://cdn.vox-cdn.com/thumbor/wVbbXVOt_gXbIx6dJqXxvB4MvmA=/1400x1400/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/23897672/1410554522.jpg", 'number' => 17],
        ['firstname' => "Robert", 'lastname' => "Lewandowski", 'birthday' => "1995-10-14", 'portrait' => "https://bayernstrikes.com/wp-content/uploads/getty-images/2018/08/1239601920.jpeg", 'number' => 9],
        ['firstname' => "Ousmane", 'lastname' => "Dembélé", 'birthday' => "1995-10-14", 'portrait' => "https://www.lequipe.fr/_medias/img-photo-jpg/ousmane-dembele-au-camp-nou-le-1er-mai-lors-de-la-reception-de-majorque-2-1-en-championnat-marc-graupera-aloma-afp7-presse-sports/1500000001658540/336:33,1591:1288-828-828-75/87bb2", 'number' => 11],
        ['firstname' => "Erling", 'lastname' => "Haaland", 'birthday' => "1995-10-14", 'portrait' => "https://cdn.theathletic.com/cdn-cgi/image/width=1920,format=auto/https://cdn.theathletic.com/app/uploads/2022/09/07021831/ERLING-HAALAND-MANCHESTER-CITY-scaled-e1662531544452-1024x683.jpg", 'number' => 11],
        ['firstname' => "Vini", 'lastname' => "Jr.", 'birthday' => "1995-10-14", 'portrait' => "https://s2.glbimg.com/q79iI9pfsbqHBFzoc-sxSrVyUDc=/smart/e.glbimg.com/og/ed/f/original/2022/03/24/vinijr.jpeg", 'number' => 20],
        ['firstname' => "Zinedine", 'lastname' => "Zidane", 'birthday' => "1995-10-14", 'portrait' => "https://cdn.artphotolimited.com/images/5a09bb8dcfe9056714cea41c/1000x1000/zinedine-zidane-2-2008-couleur.jpg", 'number' => 10],
        ['firstname' => "Sadio", 'lastname' => "Mané", 'birthday' => "1995-10-14", 'portrait' => "https://www.aljazeera.com/wp-content/uploads/2022/11/2022-11-11T104146Z_1346609955_RC2UBS91RAIC_RTRMADP_3_SOCCER-WORLDCUP-SEN.jpg?resize=1800%2C1638", 'number' => 10],
    ];
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < count($this->data) ; $i++) { 
            $player = new Player();
            $player->setFirstname($this->data[$i]['firstname'])
                    ->setLastname($this->data[$i]['lastname'])
                    ->setBirthday(new DateTime($this->data[$i]['birthday']))
                    ->setPortrait($this->data[$i]['portrait'])
                    ->setNumber($this->data[$i]['number']);
            
                    $player->setTeam(
                        $this->getReference("refTeam" . random_int(0, 4))
                    );
                    $player->setPaye(
                        $this->getReference("refPaye" . random_int(0, 7))
                    );

            $manager->persist($player);
        }
        $manager->flush();
    }
}
