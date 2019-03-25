<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-03-20
 * Time: 오후 12:16
 */
namespace App\Tests\controller;

//use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class jobControllerTest extends WebTestCase
{

    public function testConnectingJobCreatingPage()
    {
        $client = static::createClient();

        $client->request('GET','/job/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }



    public function testCreatingJobData()
    {

        $client = static::createClient();
        $crawLer = $client->request('GET', '/job/create');

        $buttonCrawlerNode = $crawLer->selectButton('Creating');


        $form = $buttonCrawlerNode->form([
            'job[title]' => 'test title',
            'job[company]' => 'nexbrain',
            'job[location]' => 'korea',
            'job[description]' => 'to describe the job detail',
            'job[link]' => 'http://google.com',
            'job[jobId]' => '1234567890',
            'job[applyState]' => 'notApply',
            'job[etc]' => 'etc test etc test etc test etc test etc test ',
        ]);

        $form->disableValidation();

        $crawler = $client->submit($form);


    }

}