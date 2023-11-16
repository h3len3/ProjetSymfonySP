/**
     * Requête permettant de récupérer dans la table OrdinateursPortables les résultats de la recherche d'un utilisateur
     */
    public function findByFilter(array $field): ?array
    {
        $marque = $field['marque'];
        $prix_min = $field['prix_min'];
        $prix_max = $field['prix_max'];

        $processeur = ($field['processeur']);
        $systemeExploitation = $field['systemeExploitation'];

        //Construction de la base de la requête
        $query = $this->createQueryBuilder('o');

        //On vérifie si l'utilisateur a mis au moins une marque (si $marque = [] => c'est faux, car l'array est vide)
        //même principe pour tous les tests suivants
        if($marque)
        {
            //On continue de construire notre requête avec un andWhere (équivalent au where classique dans ce cas ci),
            //et à l'intérieur on vérifie que la colonne 'o.marque' on retrouve les éléments du tableau de ':marque'
            //Ecrit avec un exemple : "o.marque IN ['Asus', 'Dell']"
            $query->andWhere('o.marque IN (:marque)')
                ->setParameter('marque', $marque);
        }

        if($prix_min)
        {
            $query->andWhere('o.prix >= :prix_min')
                ->setParameter('prix_min', $prix_min);
        }

        if($prix_max)
        {
            $query->andWhere('o.prix <= :prix_max')
                ->setParameter('prix_max', $prix_max);
        }

        if($processeur)
        {
            $query->andWhere('o.processeur IN (:processeur)')
                ->setParameter('processeur', $processeur)
            ;
        }

        if($systemeExploitation)
        {
            $query->andWhere('o.systemeExploitation IN (:systemeExploitation)')
                ->setParameter('systemeExploitation', $systemeExploitation)
                ;
        }

        //Une fois ma query construire on la récupère, on l'exécute avec getResult et on retourne le résultat
        return $query
            ->getQuery()
            ->getResult()
        ;
    }
}
