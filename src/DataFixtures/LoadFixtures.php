<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Ramen;


class LoadFixtures extends Fixture {
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        // create user objects
        $userUser = $this->createUser('1','matt', 'smith', ['ROLE_USER']);
        $userAdmin = $this->createUser('2','admin', 'admin', ['ROLE_ADMIN']);
        $userShun = $this->createUser('3','shunwen', 'chook', ['ROLE_USER']);

        $manager->persist($userUser);
        $manager->persist($userAdmin);
        $manager->persist($userShun);
        for ($i=0; $i < 7; $i++) {
            $user = $this->createUser(($i+4),$faker->firstName, $i, ['ROLE_USER']);

            $manager->persist($user);
        }

        // create ramen objects
        $ramen1 = $this->createRamen('Maggi Mee',
                                    'maggi1.jpg',
                                    'You know it’s popular when people start referring to instant noodles as Maggie Mee. A staple in every Singaporean household, Maggi noodles taste great and have an equally attractive package to match.',
                                    'Salt, Flavour Enhancers (Monosodium Glutamate, Disodium Guanylate, Disodium Inosinate), Sugar,',
                                    '5 - 10',
                                    $userUser, // ignore
                                    '1');

        $ramen2 = $this->createRamen('Indomee', 'indo.jpg', 'Once you try these you won\'t want to buy any other brand', 'Salt, Sugar, Flavour Enhancers (621, 631, 627), Garlic Powder, Onion Powder, Yeast Extract, Artificial Flavour, Pepper, Anti Caking Agent', '5 - 11', $userShun, '1');
        $ramen3 = $this->createRamen('Mi Sedap', 'misedap1.jpg', 'The best brand of mi gorengs. Delicious and tasty', 'Goreng Kriuk (90gr) – revolutionized fried noodle enjoyment comes with deliciously “kriuk-kriuk” crunchy fried onion.', '15 - 20', $userShun, '1');
        $ramen4 = $this->createRamen('Paldo Budae Jigae Ramyun', 'paldo.jpg', 'The broth is really good – a little thicker than most and has a kind of ‘been boiling with hot dogs in it all day’ kind of thing going on.', 'Deep spicy Budae Jjigae boilde with lots of solid ingredinets like chewy, sticky noodles, ham, sausage, meat gamish, kimchi, green onion,', '5 - 8', $userUser, '0');
        $ramen5 = $this->createRamen('CarJEN Nyonya Curry Laksa', 'carjen.jpg', 'Carjen Food Nyonya Curry Laksa [Improved Taste] is now the world’s third best instant noodle in the pack category', 'Curry, Laksa, Noodles', '1 - 4', $userShun, '1');
        $ramen6 = $this->createRamen('Xiao Ban Mian Shallot & Scallion Oil Noodle', 'xiao1.jpg', '3 varieties to choose (3 servings/pack):
- Traditional Shallot & Scallion Oil Noodle
- Sesame Oil With Garlic Flavour Thin Noodle
- Sesame Sauce Matcha Noodle', 'Shallot, Sesame Oil, Noodles, Garlic', '3 - 6', $userUser, '1');

        $manager->persist($ramen1);
        $manager->persist($ramen2);
        $manager->persist($ramen3);
        $manager->persist($ramen4);
        $manager->persist($ramen5);
        $manager->persist($ramen6);

        // Create review objects
        $review1 = $this->createReview($ramen1, // ignore
                                        $userUser, // ignore
                                        'Brilliant, I love these noodles and they are so good value for money, but not available many places, thanks so much!',
                                        new \DateTime(), // ignore
                                        'John\'s',
                                        '3',
                                        '35',
                                        'maggi1.jpg',
                                        '1' );

        $review2 = $this->createReview($ramen3, $userUser, 'I had several kind of instant noodle since I was in college, but this Mie sedaap is the best of all the instant noodle, especially the Mie Sedaap Mie Goreng & Mi Sedaap Onion Chicken.', new \DateTime(), 'Sean\'s', '1', '45', 'misedap2.jpg', '1' );
        $review3 = $this->createReview($ramen3, $userShun, 'Tastes great and is delicious.', new \DateTime(), 'Mark\'s', '1', '50', 'misedap3.jpg', '1' );
        $review4 = $this->createReview($ramen6, $userShun, 'Worth the money', new \DateTime(), 'Ken\'s', '1', '30', 'xiao2.jpg', '0' );

        $manager->persist($review1);
        $manager->persist($review2);
        $manager->persist($review3);
        $manager->persist($review4);

        $manager->flush();
    }

    /**
     * @param $id
     * @param $username
     * @param $plainPassword
     * @param array $roles
     * @return User
     */
    private function createUser($id, $username, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setRoles($roles);

        // password - and encoding
        $encodedPassword = $this->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        return $user;
    }

    private function encodePassword($user, $plainPassword):string
    {
        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }


    public function createRamen($name, $photo, $description, $ingrediants, $pricerange, $user_id, $public) {
        $ramen = new Ramen();

        $ramen->setName($name);
        $ramen->setPhoto($photo);
        $ramen->setDescription($description);
        $ramen->setIngrediants($ingrediants);
        $ramen->setPricerange($pricerange);
        $ramen->setUser($user_id);
        $ramen->setPublic($public);

        return $ramen;
    }

    public function createReview($ramen_id, $user_id, $summary, $date, $shopname, $price, $stars, $photo, $public) {
        $review = new Review();

        $review->setRamen($ramen_id);
        $review->setSummary($summary);
        $review->setDate($date);
        $review->setShopname($shopname);
        $review->setPrice($price);
        $review->setStars($stars);
        $review->setPhoto($photo);
        $review->setUser($user_id);
        $review->setPublic($public);

        return $review;
    }
}