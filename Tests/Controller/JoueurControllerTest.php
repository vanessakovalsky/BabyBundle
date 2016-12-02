<?php

namespace BabyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JoueurControllerTest extends WebTestCase
{
    public function setUp(){

    }

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/baby/joueur/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /joueur/");
        //$crawler = $client->click($crawler->selectLink('Create a new entry')->link());
        $crawler2 = $client->request('GET', '/baby/joueur/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /joueur/");

        // Fill in the form and submit it
        $email = mt_rand(0,20000).'@toto.com';
        $form = $crawler2->selectButton('Enregistrer le joueur')->form(array(
            'joueur[nom]'  => 'TestAuto',
            'joueur[prenom]' => 'Jean',
            'joueur[email]' => $email,
        ));

        $client->submit($form);
        $crawler2 = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler2->filter('td:contains("TestAuto")')->count(), 'Missing element td:contains("Test")');
        //$this->assertEquals(1, $crawler2->filter('td:contains("TestAuto")')->count(), 'Missing element td:contains("Test")');

    //     // Edit the entity
    //     $crawler = $client->click($crawler->selectLink('Edit')->link());
    //
    //     $form = $crawler->selectButton('Update')->form(array(
    //         'babybundle_joueur[field_name]'  => 'Foo',
    //         // ... other fields to fill
    //     ));
    //
    //     $client->submit($form);
    //     $crawler = $client->followRedirect();
    //
    //     // Check the element contains an attribute with value equals "Foo"
    //     $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');
    //
    //     // Delete the entity
    //     $client->submit($crawler->selectButton('Delete')->form());
    //     $crawler = $client->followRedirect();
    //
    //     // Check the entity has been delete on the list
    //     $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
     }

}
