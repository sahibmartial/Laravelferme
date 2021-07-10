<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\PoussinController;
use App\Http\Controllers\PerteController;
use App\Http\Controllers\AlimentController;
use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\FonctionController;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVenteTest()
    {
        
        $result=(object)[
            'id' => 1,
            'date'=>null,
            'campagne_id' => 1,
            'campagne'=>'campagne1',
            'quantite' => '10',
            'priceUnitaire' => '3000',
            'acheteur' => 'Particulier',
            'contact' => '08-43-60-53',
            'events' => 'Party',
            'obs' => 'ras',
           'created_at' => '2020-10-14 15:34:28',
           'updated_at' => '2020-10-14 16:08:33'
        ];

        $vente= new VenteController();
        $value=$vente->selectAllSaleForOneCampagne(1);  
      //  dd($value[0]);
      //  $response = $this->get('/');
            
        $this->assertEquals($result,$value[0]);

        //return $vente;
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculVenteTest()
    {
        $vente= new VenteController();
        $result=$vente->calculateVenteOfCampagne(1);  
      
       $this->assertEquals(411000, $result);
        
    }


/**
     * A basic test example.
     *
     * @return void
     */
    public function testListTransportTest()
    {
        
        $result=(object)[
            'id' => 1,
            'date_achat'=>null,
            'campagne_id' => 1,
            'campagne'=>'campagne1',
            'montant' => 15000,
            //'priceUnitaire' => '3000',
          //  'acheteur' => 'Particulier',
           // 'contact' => '08-43-60-53',
          //  'events' => 'Party',
            'obs' => 'ras',
           'created_at' => "2020-10-15 15:19:35",
           'updated_at' => "2020-10-15 15:19:35"
        ];

        $vente= new TransportController();
        $value=$vente->selectAllFraisTrasnportForOneCampagne(1);
      //  dd( $value);  
      //  $response = $this->get('/');
            
        $this->assertEquals($result,$value[0]);

        //return $vente;
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculTransportTest()
    {
        $vente= new TransportController();
        $result=$vente->calculateFraisTotalOfCampagne(1);  
      
       $this->assertEquals(25000, $result);
        
    }

   /**
     * A basic test example.
     *
     * @return void
     */
    public function testListPoussinsTest()
    {
        
        $result=(object)[
            'id' => 12,
            'date_achat'=>null,
            'campagne_id' => 1,
            'campagne'=>'campagne1',
            'quantite' => 150,
            'priceUnitaire' => 500,
            'fournisseur' => 'sahib',
           // 'contact' => '08-43-60-53',
          //  'events' => 'Party',
            'obs' => 'Testing',
           'created_at' => "2020-10-20 18:04:11",
           'updated_at' => "2020-10-20 18:04:11"
        ];

        $vente= new PoussinController();
        $value=$vente->selectAllheadForOneCampagne(1);  
      //  $response = $this->get('/');
         
      //  dd($value);
            
        $this->assertEquals($result,$value[0]);

        //return $vente;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculAchatHeadTest()
    {
        $vente= new PoussinController();
        $result=$vente->calculateAchatHeadOfThisCampagne(1);  
      
       $this->assertEquals(75000, $result);
        
    }


 /**
     * A basic test example.
     *
     * @return void
     */
    public function testAllLossofThisCampagneTest()
    {
        
        $result=(object)[
            'id' => 1,
            'date_die'=>null,
            'campagne_id' => 1,
            'campagne'=>'campagne1',
            'quantite' => 5,
            'cause' => 'maladie',
          //  'obs' => '',
           // 'contact' => '08-43-60-53',
          //  'events' => 'Party',
           'obs' => '',
           'duredevie'=>1,
           'year'=>2020,
           'created_at' => "2020-10-15 16:12:20",
           'updated_at' => "2020-10-15 16:12:20"
        ];

        $vente= new PerteController();
        $value=$vente->selectAllLossOfThisCampagne(1);  
      //  $response = $this->get('/');
        // dd($value[0]);   
        $this->assertEquals($result,$value[0]);

        //return $vente;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculLossTotalTest()
    {
        $vente= new PerteController();
        $result=$vente->calculateTotalLossofthiscampagne(1);  
      
       $this->assertEquals(8, $result);
        
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAllAlimentofThisCampagneTest()
    {
        
        $result=(object)[
            'id' => 1,
            'date_achat'=>null,
            'campagne_id' => 1,
            'campagne'=>'campagne1',
            'libelle'=>'aliment croissance',
            'quantite' => 3,
            'priceUnitaire' => 10000,
            'fournisseur'=>'sahib', 
           'obs' => 'Testing',
           'created_at' => "2020-10-15 19:59:53",
           'updated_at' => "2020-10-15 19:59:53"
        ];

        $vente= new AlimentController();
        $value=$vente->selectAllAlimentforthisCampagne(1);  
      //  $response = $this->get('/');
            //dd($value[0]);
        $this->assertEquals($result,$value[0]);

        //return $vente;
    }
    


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculTotalAlimentTest()
    {
        $vente= new AlimentController();
        $result=$vente->calculateDepenseAlimentofthiscampagne(1);  
      
       $this->assertEquals(90000, $result);
        
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAllAccessoiretofThisCampagneTest()
    {
        
        $result=(object)[
            'id' => 1,
            'date_achat'=>null,
            'campagne_id' => 1,
            'campagne'=>'campagne1',
            'libelle'=>'mangoire',
            'quantite' =>10,
            'priceUnitaire' =>2500,
           // 'fournisseur'=>'sahib', 
           'obs' => 'renfort campagne5',
           'created_at' => "2020-10-15 20:30:20",
           'updated_at' => "2020-10-15 20:30:20"
        ];

        $vente= new AccessoireController();
        $value=$vente->selectAllAccessoireforthisCampagne(1);  
      //  $response = $this->get('/');
            
        $this->assertEquals($result,$value[0]);

        //return $vente;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculTotalAccessoireTest()
    {
        $vente= new AccessoireController();
        $result=$vente->calculateDepenseAccessoireofthiscampagne(1);  
       // dd($result);
      
       $this->assertEquals(40000, $result);
        
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testgenobsTest()
    {
        $fonc = new FonctionController();
        $result=$fonc->generateObsBilan(200000,'campagne1');  
      
       $this->assertEquals('campagne1 excellente', $result);
        
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testgetIdcampagneTest()
    {
        $fonc = new FonctionController();
        $result=$fonc->getIdcampagne('campagne7');  
      // dd($result);
       $this->assertEquals(5, $result);
        
    }




}
