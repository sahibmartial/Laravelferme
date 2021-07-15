<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PathologiesController extends Controller
{

    public function getPathoAviaires()
    {
       
        return view('pathologies.pathoAviaires');
     
    }

    public function getPathoVirales()
    {
      
        $Mvirales=array('MALADIE DE NEWCASTLE'=>array('Définition' => 'La maladie de Newcastle est une maladie virale très contagieuse, cosmopolite. Elle frappe les oiseaux
        à tout âge et occasionne une forte mortalité, pouvant atteindre 99% à 100%. Une maladie à tropisme
        respiratoire',
        'symptômes'=>array('troubles digestifs' => 'diarrhée jaune verdâtre',
        'troubles respiratoires'=>'toux, râle, jetage (dyspnée)',
        'troubles nerveux'=>'tremblements, paralysie, torticolis, convulsions, mort au bout de 24h à 48h' ),
        'Traitement'=>'Il n’y a pas de traitement spécifique contre les maladies virales. Néanmoins on donne des antibiotiques
        et des vitamines, pour lutter contre les infections secondaires',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale'=>array('vaccin1' =>'on utilise en primo vaccination HB1 et en rappel lasota ou clone30 qui sont des vaccins vivants.' ,
        'Vaccin2'=>'On emploie les vaccins inactivés comme newcavac, hitanew, imopest, 2 e rappel en IM ou SC à
        raison de 0,3 ml /sujet.' )
        ),

        'Maladie de gumboro'=>array('Définition' => 'La maladie de Gumboro est une maladie virale très contagieuse, immunodépressive. Son apparition est
        soudaine chez les jeunes oiseaux âgés de moins de 7 semaines. La mortalité est élevée quand elle est
        associée à la peste ou à la coccidiose (80%). Quand elle est seule en cause, la mortalité est de 15 à 40%
        en une semaine.',
        'symptômes'=>'plumage terne et ébouriffé, ailes pendantes, yeux clos, bec contre le sol, diarrhée blanchâtre et
        aqueuse souillant les plumes autour du cloaque',
        'Traitement'=>'Traitement neant ,mais utilisation d’antibiotiques plus vitamines pour éviter les complications bactériennes,
        La solution de lugol plus le trisulmix ou du virkon associés à la vitamine donne de bons
        résultats. ',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale'=>'La prévention se fait avec l’un des vaccins suivants : gumboro TAD, gumboriffa, gumbornobilis,
        gumboral, Bur706 en occulaire, nasale, trempage du bec, nébulisation ou eau de boisson.'
        ),

        'Bronchite infectieuse'=>array('Définition' => 'La bronchite infectieuse est une maladie virale extrêmement contagieuse à tropisme urogénital. La
        maladie agit à tout âge',
        'symptômes'=>'1)soif intense, inappétence, toux, râles, jetage, 2)chute de ponte, œufs déformés à coquille faible ou absente. Œufs de petit calibre et déformés.',
        'Traitement'=>'Traitement néant, Néanmoins, il faut utiliser les antibiotiques plus les vitamines
        bactériennes pour éviter les complications',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale' => array('vaccins vivants'=>'H120 de la première semaine d’âge et rappel à la 3 e semaine.', 
        'Vaccins tués'=>'binewvax, bigopost, ovo3 et ovo4 à l’entrée en ponte')
       
    
        ),

        'Variole aviaire'=>array('Définition' => 'La variole est une maladie virale trèscontagieuse et répandue. Elle affecte tous les oiseaux et à tout âge.' ,
        'symptômes'=>array('S1'=>'boutons et croutes sur les parties dénudées de la tête : crête, barbillons, paupières, commissures
        du bec.','S2'=>'Formation de nodules jaunâtre dans la bouche','S3'=>'Parfois du pus dans les narines et les yeux.'),
        'Traitement'=>array('T1'=>'Traiter les lésions avec de l’alcool ou l’eau de javel ou de la teinture d’iode',
        'T2'=>'Utiliser de l’uroformine ou hexamine 40% à raison de 2cc /kg PV pendant 3 jours consécutifs ou dans l’eau de boisson pendant 5 jours, avec de la vitamine AD3E+C',
        'T3'=>'HU50 en IM ou SC pendant 3jours consécutifs ou dans l’eau de boisson pendant 5jours, avec
        de la vitamine AD3E+C'),
        'Prophylaxie-Sanitaire'=>'Hygiène absolue car la maladie apparait à la faveur de la saleté.',
        'Prophylaxie-Vaccinale'=>array('V1'=>'vaccination par transfixion alaire ou méthode wing-web à l’aide d’un stylet avec le vaccin
        vivant diftosec entre 10 e ou 12 e semaine d’âge.',
         'V2'=>'La méthode folliculaire consiste à arracher quelques plumes de la face interne d’une cuisse et
         passer une brosse inhibée dans la solution vaccinale sur les follicules (méthode peu utilisée).')

         ),

        'Laryngo-tracheite aviaire'=>array('Définition' => 'La laryngo trachéite est une maladie virale très contagieuse. Elle est répandue dans le monde entier.
        Elle se rencontre sur les oiseaux de tout âge .',
        'symptômes'=>array('S1' => 'anorexie, dyspnée (tire sur le cou pour respirer), cris plaintifs et rejet de mucus hémorragique sur
        le muret et le matériel'),
        'Traitement'=>array('T1'=>' Traitement : néant, Mais employer des antibiotiques plus des vitamines pour éviter les surinfections'),
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale'=>array('V'=>'Le vaccin se fait au couvoir avec le vaccin laryngovax. Dans le cas contraire, il faut le faire à partir de
        la 4 e semaine chez les poulettes.') 
        ),

        'Maladie de marek'=>array('Définition' => 'La malade de Marek est très contagieuse pour les volailles. Elle se caractérise par des troubles nerveux
        digestifs et cutanées. La maladie attaque les oiseaux âgés de 4 à 10 mois.',
        'symptômes'=>array('S1'=>'paralysie des pattes et des ailes',
         'S2'=>'pattes et ailes écartées en position de grand écart ( une patte et une aile en avant et les autres en
         arrière)'),
        'Traitement'=>array('T1'=>'Traitement : aucun
        Antibiotique et vitamines'),
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale'=>array('V1'=>'Vaccination au couvoir le 1 er jour avec le vaccin lyomarex ou oryomarex.')
        ),
    );
        return $Mvirales;
     
    }

    public function getPathoBacteriennes()
    {
        $Mbacteriennes = array('' => '', );
        return $Mbacteriennes;
     
    }

    public function getPathoParasitInternes()
    {
       
        return view('pathologies.pathoparasitinternes');
     
    }

    public function getPathoParasitExternes()
    {
       
        return view('pathologies.pathoparasitexternes');
     
    }
}
