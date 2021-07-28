<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

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
        'Symptômes'=>'diarrhée jaune verdâtre <br/>
        toux, râle, jetage (dyspnée) <br/>
        tremblements, paralysie, torticolis, convulsions, mort au bout de 24h à 48h <br/>
        ',
        'Traitement'=>'Il n’y a pas de traitement spécifique contre les maladies virales.<br/> Néanmoins on donne des antibiotiques
        et des vitamines, pour lutter contre les infections secondaires',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue <br/>
        ',
        'Prophylaxie-Vaccinale'=>'On utilise en primo vaccination HB1 et en rappel lasota ou clone30 qui sont des vaccins vivants.<br/>
        On emploie les vaccins inactivés comme newcavac, hitanew, imopest, 2 e rappel en IM ou SC à
        raison de 0,3 ml /sujet.'   
        ),

        'Maladie de gumboro'=>array('Définition' => 'La maladie de Gumboro est une maladie virale très contagieuse, immunodépressive. Son apparition est
        soudaine chez les jeunes oiseaux âgés de moins de 7 semaines. La mortalité est élevée quand elle est
        associée à la peste ou à la coccidiose (80%). Quand elle est seule en cause, la mortalité est de 15 à 40%
        en une semaine.',
        'Symptômes'=>'plumage terne et ébouriffé, ailes pendantes, yeux clos, bec contre le sol, diarrhée blanchâtre et
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
        'Symptômes'=>'1)soif intense, inappétence, toux, râles, jetage, <br/>2)chute de ponte, œufs déformés à coquille faible ou absente. Œufs de petit calibre et déformés.',
        'Traitement'=>'Traitement néant, Néanmoins, il faut utiliser les antibiotiques plus les vitamines
        bactériennes pour éviter les complications',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale' => 'H120 de la première semaine d’âge et rappel à la 3 e semaine.<br/>
        binewvax, bigopost, ovo3 et ovo4 à l’entrée en ponte', 
    
        ),

        'Variole aviaire'=>array('Définition' => 'La variole est une maladie virale trèscontagieuse et répandue. Elle affecte tous les oiseaux et à tout âge.' ,
       
        'Symptômes'=>'boutons et croutes sur les parties dénudées de la tête : crête, barbillons, paupières, commissures
        du bec.<br/>
        Formation de nodules jaunâtre dans la bouche.<br/>
        Parfois du pus dans les narines et les yeux.
        ',  
        'Traitement'=>'Traiter les lésions avec de l’alcool ou l’eau de javel ou de la teinture d’iode .<br/>
        Utiliser de l’uroformine ou hexamine 40% à raison de 2cc /kg PV pendant 3 jours consécutifs ou dans l’eau de boisson pendant 5 jours, avec de la vitamine AD3E+C.<br/>
        HU50 en IM ou SC pendant 3jours consécutifs ou dans l’eau de boisson pendant 5jours, avec
        de la vitamine AD3E+C. <br/>
        ',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue car la maladie apparait à la faveur de la saleté.',
        'Prophylaxie-Vaccinale'=>'vaccination par transfixion alaire ou méthode wing-web à l’aide d’un stylet avec le vaccin
        vivant diftosec entre 10 e ou 12 e semaine d’âge. <br/>
        La méthode folliculaire consiste à arracher quelques plumes de la face interne d’une cuisse et
         passer une brosse inhibée dans la solution vaccinale sur les follicules (méthode peu utilisée)
        '
         ),

        'Laryngo-tracheite aviaire'=>array('Définition' => 'La laryngo trachéite est une maladie virale très contagieuse. Elle est répandue dans le monde entier.
        Elle se rencontre sur les oiseaux de tout âge .',
        'Symptômes'=> 'Anorexie, Dyspnée (tire sur le cou pour respirer), cris plaintifs et rejet de mucus hémorragique sur
        le muret et le matériel',
        'Traitement'=>'Traitement : néant, mais employer des antibiotiques plus des vitamines pour éviter les surinfections',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale'=>'Le vaccin se fait au couvoir avec le vaccin laryngovax. Dans le cas contraire, il faut le faire à partir de
        la 4 e semaine chez les poulettes.'
        ),

        'Maladie de marek'=>array('Définition' => 'La malade de Marek est très contagieuse pour les volailles. Elle se caractérise par des troubles nerveux
        digestifs et cutanées. La maladie attaque les oiseaux âgés de 4 à 10 mois.',
        'Symptômes'=>'paralysie des pattes et des ailes .<br/>
        Pattes et ailes écartées en position de grand écart ( une patte et une aile en avant et les autres en
         arrière.
        ',
        'Traitement'=>'Traitement : aucun .<br/>
          Antibiotique et vitamines',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue',
        'Prophylaxie-Vaccinale'=>'Vaccination au couvoir le 1er jour avec le vaccin lyomarex ou oryomarex.'
        ),
    );


     // $Mvirales;
        return view('pathologies.pathoVirale',compact('Mvirales')) ;
     
    }

    public function getPathoBacteriennes()
    {
        $Mbacteriennes = array(
    'LES SALMONELLOSES AVIAIRES' => array('Définition'=>'Les salmonelloses sont des maladies infectieuses contagieuses. Elles attaquent les poussins et les
        poulets. La maladie s’appelle typhose chez les adultes et pullorose chez les jeunes.',
        'Symptômes'=>'abattement, somnolence , diarrhée blanchâtre qui souille les duvets autour de l’anus chez les
        poussins.<br/>
        Prostration, soif intense. Cyanose de la crête et des barbillons et diarrhée jaune ou jaune verdâtre
        qui souille les plumes autour e l’anus.',
        'Traitement'=>'Employer les antibiotiques et les vitamines dans l’eau ou l’aliment pendant 3 à 5 jours de suite ; ou en
        injection IM ou SC pendant 1 à 3 jours consécutifs. Antibiotiques : oxytetracycline, flumisol,
        terramycine, auréomycine',
        'Prophylaxie-Sanitaire'=>'Hygiène absolue des locaux',
        'Prophylaxie-Vaccinale'=>'Vaccination avec un vaccin inactivé (avimix) qui peut être associé au vaccin contre la pseudo peste ou
        celui du cholera en IM ou SC à partir de la 6 e semaine. Il faut faire un rappel 1 mois après la 1ere
        vaccination.'

    ), 

    'LA COLIBACILLOSE AVIAIRE'=>array('Définition'=>'La colibacillose est une maladie infectieuse contagieuse qui frappe surtout les jeunes oiseaux. Elle
    provoque des signes divers car elle est le plus souvent associée à une autre maladie. Dans ce cas, la
    mortalité peut atteindre 60%.',
    'Symptômes'=>'Troubles respiratoires : éternuements, toux, râle, jetage (dyspnée).<br/>
    Troubles respiratoires : éternuements, toux, râle, jetage (dyspnée)',
    'Traitement'=>'Utiliser les antibiotiques et les vitamines au démarrage en eau de boisson pendant 3 ou 5 jours à raison
    de 1g/l d’eau.<br/>
    Antibiotiques : imequyl, flumisol, colivet : colistine , coliterravet, colisultrix…',
    'Prophylaxie-Sanitaire'=>'Respect des règles d’hygiène',
     'Prophylaxie-Vaccinale'=>''
    ), 

    'LA PASTEURELLOSE OU CHOLERA AVIAIRE'=>array('Définition'=>'Le cholera aviaire est une maladie infectieuse contagieuse. Elle se caractérise par des troubles
    respiratoires et digestifs. Cette maladie sévit chez les poulets et les dindons adultes. La mortalité peut
    atteindre 90 à 80% dans la formes aigué et suraigüe',
    'Symptômes'=>'anorexie, ailes pendants, plumes hérissées, dyspnée.<br/>
    diarrhée jaunâtre, parfois sanguinolente.<br/>
    crêtes et barbillons hypertrophiés et cyanosés.
    ',
    'Traitement'=>'On utilise des sulfamides et des antibiotiques à large spectre : sulfadimerazine ou sulfadimédine,
    streptemycine, auréomycine, terramycine.',
    'Prophylaxie-Sanitaire'=>'Respect strict des règles d’hygiène',
    'Prophylaxie-Vaccinale'=>'Vacciner à avipostovax en association avec avimix en IM ou SC à partir de la 6 e semaine. Il faut faire
    un rappel tous les 6 mois.'

    ),  
    'LE CORYZA INFECTIEUX OU HAEMOPHYLOSE'=>array('Définition'=>'Maladie infectieuse contagieuse qui s’étend au sinus et à la conjonctivite. Elle attaque les oiseaux
    adultes provoquant ainsi une baisse de ponte de 10 à 40%',
    'Symptômes'=>'éternuement, toux, jetage, râles , dyspnée.<br/>
    respiration par le bec car narines obstruées par des croutes noirâtres. Amaigrissement jusqu’à
    la cachexie. Chute de ponte, larmoiement.<br/>
    Œil fermé , la face enflée',
    'Traitement'=>'Utilisation des sulfamides et antibiotiques à large spectre dans l’eau ou l’aliment pendant 5
    jours de suite.\n
    <p> Faire des injections en IM ou SC pendant 3 jours consécutifs.</p>
    <p>Antibiotiques : biafuracol, corylSP, : viga 2X, terramycine, oxytetracycline, tyloxine </p>',
    'Prophylaxie-Sanitaire'=>'Respect des règles d’hygiène',
    'Prophylaxie-Vaccinale'=>'<p>Vacciner avec un vaccin inactivé ( coryvax) à partir de la 9 e semaine avec un rappel à 3 semaines avant
    l’entrée en ponte.</p>'
   ),
   'MYCOPLASMOSE AVIAIRE (MALADIE RESPIRATOIRE CHRONIQUE)'=>array("Définition"=>'La MRC est une maladie infectieuse contagieuse atteignant tous les oiseaux en même temps dans un
   lot. Mais la mortalité est très faible néanmoins la mortalité peut s’étendre sur une longue période.',
   'Symptômes'=>'troubles respiratoires : dyspnée (éternuements, toux, râles, jetage). Amaigrissement, faiblesse
   et retard de croissance, arthrite et chute de ponte.',
   'Traitement'=>'On utilise les antibiotiques suivants : tylan, suanovil, spiramycine en IM à raison de 1 à 2 cc/kg de PV
   + vitamines',
   'Prophylaxie-Sanitaire'=>'Hygiène obligatoire des lieux',
   'Prophylaxie-Vaccinale'=>'Le vaccin mycovax ou gallimune est utilisé en IM ou SC à partir de la 8 e semaine.'
    ),
    );
    return view('pathologies.pathobacteriennes',compact('Mbacteriennes')) ;
     
    }

    public function getPathoParasitInternes()
    {
       $Mparisitaires=array(

           'LA COCCIDIOSE OU EIMERIOSE AVIAIRE'=>array(
            "Définition"=>'La coccidiose est une maladie parasitaire du tube digestif. La maladie est très fréquente dans nos fermes
            et provoque une forte mortalité allant de 60 à 80% ; suivie d’un retard de croissance chez les jeunes
            oiseaux entre la 2 e et la 12 e semaine d’âge et une chute de ponte.',

            'Symptômes'=>'Anémie, crête et barbillons pâles, amaigrissement, déshydratation. Diarrhée hémorragique ou marron
            ou bien du sang en nature.',

            'Traitement'=>'L’emploi des anticoccidiens suivants donne des satisfactions : amprol, amprolium, narcox, avicox,
            coccistop, vetacox, sulkan, AF20, trisulmix à raison de 1 à 2g/kg d’aliment ou litre d’eau pendant 3 à
            5 jours consécutifs. Il faut changer la litière après le 3 e jour de traitement.',

            'Prophylaxie-Sanitaire'=>'Application rigoureuse des règles d’hygiène.',

            'Prophylaxie-Vaccinale'=>'traitements préventifs avec intervalle de 6 à 8 jours entre interventions chez les chairs à raison
            de 0,5g à 1g par litre d’eau pendant 1 à 3 jours de suite.
            Traitements préventifs séparés de 15 à 20 jours chez les poulettes.
            Pondeuses : faire un traitement préventif chaque mois ou 1 mois et ½ soit 45 jours avec de la
            vitamine AD3E+C plus des sels minéraux et oligo-éléments
            '
           ),
           'HISTOMONOSE AVIAIRE'=>array(
            "Définition"=>'L’histomonose est une maladie parasitaire interne, caractérisée par une inflammation des coecums et
            du foie. Elle provoque beaucoup de perte chez les dindonneaux, de la 3 e semaine d’âge à la 12 e semaine.
            Mais aussi les poulets et les cailles. Mortalité 100% dindonneaux et 10% poulets.',

            'Symptômes'=>'Abattement, faiblesse, inappétence, déplacement difficile, plumage terne et ébouriffé, crête et barbillons
            sont cyanosés. Diarrhée abondante jaunâtre souillant les duvets autour de l’anus.',

            'Traitement'=>'On utilise les médicaments suivants : hystomorysemtryl, dimetridazole, à raison de 40g pour 25kg
            d’aliment ou 25 litres d’eau pendant 7 jours de suite.
            Sulfate de cuivre à raison de 1à 2g/1litre d’eau.
            Ridzol : 60g pour 100litre d’eau pendant 5jours.
            ',

            'Prophylaxie-Sanitaire'=>'Sanitaire : Uniquement',

            'Prophylaxie-Vaccinale'=>'Déparasitage interne une fois par mois.'
           ),

           'ASCARIDIOSE AVIAIRE'=>array(

            'Définition'=>'L’ascaridiose est une maladie parasitaire interne du tube digestif. Elle est fréquente dans nos fermes
            avicoles. Cette maladie entraine un retard de croissance et une baisse de ponte.',

            'Symptômes'=>'diarrhée aqueuse parfois striée de sang.
            Plumage terne et ébouriffé, très sec.
            Amaigrissement, cachexie souvent paralysie.
            Chute de ponte avec des œufs de petit calibre.
            ',

            'Traitement'=>'Vermifugation avec soit du vesonil, citrate de piperazine, vurmix, vermycil, polystrongle, tetramyzol,…
            à raison de 1à 2g/ litre d’eau ou kg d’aliment. Il faut répéter le traitement 15 jours après le premier.',

            'Prophylaxie-Sanitaire'=>'Elle est prépondérante.',

            'Prophylaxie-Vaccinale'=>'Emploi de vermifuge une fois par mois.'

           ),

           'SYGAMOSE AVIAIRE'=>array(
               'Définition' => 'La syngamose est une maladie parasitaire interne des oiseaux. Cette maladie se rencontre le plus
               souvent dans les élevages sur parcours. La maladie est fréquente chez les poulets, dindons et pintades.',

               'Symptômes'=>'Bâillement, ouverture du bec, cou tendu, toux sifflante. La respiration est pénible et accélérée. Mort
               souvent par asphyxie.',

               'Traitement'=>'thiabendazole en eau de boisson ou dans l’aliment à raison de 0,3 à 1,5g/l ou par KG
               d’aliment pendant 3 jours de suite.
               solution de lugol dans la trachée à raison de 0,5ml à 1ml par oiseaux.
               ',

               'Prophylaxie-Sanitaire'=>'Hygiène absolue des lieux',

               'Prophylaxie-Vaccinale'=>'Déparasitage interne chaque mois avec l’un des médicaments cités dans l’ascaridiose.'

           ),

           'LE TENIASIS AVIAIRE'=>array(
               'Définition'=>'Le téniasis est une maladie parasitaire interne de nos fermes. Elle est fréquente chez les poulets et les
               dindons. La maladie provoque un grand retard de croissance et une baisse de ponte grave',

               'Symptômes'=>'anémie, décoloration de la crête et des barbillons.
               amaigrissement profond (cachexie).
               alternance de diarrhée et de constipation.
               anneaux visibles dans les excréments.
               la forme immature visible dans les fientes.
               ',

               'Traitement'=>'Emploi de ténifuges ou vermifuges polyvalents.
               Teniverm, teniastop, stromittent, polyvermyl, panacur, exhelm IIalbendazol en eau de boisson ou dans
               l’aliment à raison de 1 à 2g/litre
               ',

               'Prophylaxie-Sanitaire'=>'Poulailler propre, non humide, non surpeuplé et éliminer les hôtes intermédiaires par épandage
               d’insecticides',

               'Prophylaxie-Vaccinale'=>''
           ),

           'ASPERGILLOSE AVIAIRE'=>array(
               'Définition'=>'',

               'Symptômes'=>'dyspnée ( éternuements, quinte de toux, toux, râle, jetage).
               troubles nerveux : tremblement, tournis et torticolis. Mort au bout de 48h à 72h
               ',
               'Traitement'=>'Employer des fongicides comme : fongistop ou sorbamycine dans l’eau ou dans l’aliment
               pendant 5 à 7 jours, à raison de 1 à 2 g/ litre ou kg d’aliment.
               Sulfate de cuivre pendant 7 jours.
               L’amphotericine B en eau de boisson à la dose de 0,02g/l pendant 7 jours donne de bons
               résultats.
              ',

              'Prophylaxie-Sanitaire'=>'éviter la litière et l’aliment humides ou moisi.
              bruler la litière en cas d’aspergillose.
              désinfection des locaux au sulfate de cuivre à 1%.
              tamiser la litiere
              ',
              'Prophylaxie-Vaccinale'=>'Médicale : néant'

           ),

           'CANDIDOSE AVIAIRE'=>array(

               'Définition'=>'La candidose est une maladie mycosique ou fongique de la cavité buccale et du jabot. Cette maladie
               se rencontre fréquemment chez les dindonneaux à partir de la 1 er semaine jusqu’à la 8 e semaine. La
               mortalité est élevée soit environ 60 à 70%.',

               'Symptômes'=>'Anorexie, amaigrissement, cachexie, arrêt de croissance. Plumage terne et ébouriffé.',

               'Traitement'=>'On utilise le fongistop, la mycostatine, du sulfate de cuivre, de l’eau iodée avec du potasium à 5% à
               raison de 1g par kg d’aliment pendant 5 à 7 jours consécutifs.',

               'Prophylaxie-Sanitaire'=>'Hygiène alimentaire et de l’eau',

               'Prophylaxie-Vaccinale'=>'Médicale : néant'

           ),

       );
        return view('pathologies.pathoparasitinternes',compact('Mparisitaires'));
     
    }

    public function getPathoParasitExternes()
    {
      //  dd("here");
        $Mparisitaires=array(
            'Définition'=>'Ces maladies sont provoquées par différentes espèces de parasites qui vivent sur la peau ou les plumes
            des oiseaux. Ces parasites se nourrissent des débris de la peau ou du sang en perçant la peau des
            oiseaux ; ce sont : les puces, les poux et les acariens qui sont responsables de la gale des oiseaux.
            ',
            'Symptômes'=>'1)Les poux et les puces sont visibles à l’œil nu. Ils mesurent environ 3mm. Ces deux parasites
            lèchent le sang et provoquent l’anémie. Leurs œufs sont collés en grappes sur les plumes. Ils
            provoquent en plus un énorme retard de croissance, une baisse de ponte et l’insomnie, d’où
            pas de repos pour les oiseaux.
            2)La gale se rencontre surtout au niveau des pattes des oiseaux. Les vecteurs de la gale sont
            microscopiques. Ils creusent des trous sous la peau où les femelles pondent. Ce qui entraine le
            prurit chez les oiseaux qui se frottent sur le matériel et le muret.
            ',
            'Traitement'=>'Employer des désinfectants externes : carbalap,sepoux, cafagal, etc… sur les oiseaux et la litière.',
            'Prophylaxie-Sanitaire'=>'Hygiène absolue des locaux',
            'Prophylaxie-Vaccinale'=>'Neant'
        );

        return view('pathologies.pathoparasitexternes',compact('Mparisitaires'));
     
    }
}
