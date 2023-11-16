public function findFiltres(Search $search) : Query
{
    $query = $this->createQueryBuilder("p");
 
    if($search->getMaxPrix())
    {
        $query = $query
        ->andWhere('p.prix <= :maxprix')
        ->setParameter(':maxprix' , $search->getMaxPrix());
 
    }
 
    if($search->getMinPrix())
    {
        $query = $query
        ->andWhere('p.prix >= :minprice')
        ->setParameter(':minprice' , $search->getMinPrix());
 
    }
 
    if($search->getCategorie())
    {
        $query = $query
        ->andWhere('p.categories >= :cat')
        ->setParameter(':cat' , $search->getCategorie());
 
    }
 
    if($search->getGenre())
    {
        $query = $query
        ->andWhere('p.genre <= :genre')
        ->setParameter(':genre' , $search->getGenre());
 
    }
 
     
    return $query->getQuery()
    ;
}