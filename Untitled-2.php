/* Exemple : utiliser QueryBuilder pour construire une requête capable d'obtenir le nombre de Livres dont le prix se trouve entre un minimum et un maximum

Créez la méthode du repository (LivreRepository.php) capable de realiser la requête avec Query Builder
// QUERYBUILDER: obtenir les livres entre deux prix
// obtenir les livres entre deux prix, version QueryBuilder
public function getEntreDeuxPrix($min, $max)
{
    $qb = $this->createQueryBuilder("u"); // u est un nom générique
    $query = $qb->select('u')
        ->where('u.prix >= :min')
        ->andWhere('u.prix <= :max')
        ->setParameter('min', $min)
        ->setParameter('max', $max)
        ->getQuery();
    $res = $query->getResult();
    //var_dump ($res);

    return $res;
}

Créez une action dans le controller qu'utilise cette méthode et envoyez la réponse au client (new Response) pour qu'il l'affiche
#[Route ("/exemples/query/builder/utilise/repo/livres/entre/deux/prix/{prixMin}/{prixMax}")]
public function utiliseRepoLivresEntreDeuxPrix (Request $req, ManagerRegistry $doctrine){

    $prixMin = $req->get("prixMin");
    $prixMax = $req->get("prixMax");
    
    $em = $doctrine->getManager();
    $livresRepo = $em->getRepository(Livre::class);
    $livres = $livresRepo->livresEntreDeuxPrixDQL($prixMin, $prixMax);
    dump ($livres);
    die();
    
    // return new Response .....
}    
Exemple : obtenir un Client dont on connait l'email de la BD avec QueryBuilder

Créez la méthode getByEmail dans le repositoire de l'entité Client (ClientRepository.php) :
    // QUERYBUILDER: obtenir les clients par mail, version QueryBuilder
    public function getParEmail ($email){
        $qb = $this->createQueryBuilder("u");
        $query = $qb->select('u')
                    ->where ('u.email = :email')
                    ->setParameter('email', $email)
                    ->getQuery();
        $resultat = $query->getSingleResult();
        return $resultat;
    }
Créez une action dans le controller qu'utilise cette méthode
#[Route ("/exemples/query/builder/trouver/client/par/mail/{email}")]
public function trouverClientParMail(Request $req, ManagerRegistry $doctrine){
    $em = $doctrine->getManager();
    $rep = $em->getRepository(Client::class);
    // on fait appel à la méthode du Repository
    $objetClient = $rep->getParEmail($req->get ("email"));
    // on affiche les données du Client, on a obtenu un objet
    dump ($objetClient);
    die ();
    // return new Response .....
}
Note : vous pouvez toujours afficher le SQL crée par queryBuilder en utilisant de méthodes de cette classe. Par exemple :

dd ($repo->createQueryBuilder('g')->getQuery()->getSql())
ou

$qb = $this->createQueryBuilder("u");
$query = $qb->select('u')
->where ('u.email = :email')
->setParameter('email', $email)
->getQuery();
dd($query->getSql());



 */