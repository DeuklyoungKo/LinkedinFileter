<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }


    public function checkDoubleData(int $jobId)
    {
        $qb = $this->createQueryBuilder('j')
                   ->andWhere('j.job_id = :jobId')
                   ->setParameter('jobId', $jobId)
                   ->getQuery();

        return $qb->execute();
    }


    public function getWithSearchQueryBuilder(Request $request): QueryBuilder
    {

        $term = $request->query->get('q');
        $language = $request->query->get('language');
        $stateFilter = $request->query->get('stateFilter');
        $locationFilter = $request->query->get('locationFilter');
        $titleFilter = $request->query->get('titleFilter');


        $qb = $this->createQueryBuilder('j')
            ->orderBy('j.updatedAt','DESC')
        ;

        if ($stateFilter) {
            $qb->andWhere("j.applyState = :stateFilter")
               ->setParameter('stateFilter', $stateFilter)
            ;
        }

        if ($locationFilter) {

            if ($locationFilter === 'etc') {

                $jobListFilterLocations = Job::JOB_LIST_FILTER_LOCATION;

                foreach ($jobListFilterLocations as $jobListFilterLocation) {

                    $qb->andWhere("j.location not LIKE :".$jobListFilterLocation)
                       ->setParameter($jobListFilterLocation, '%'.$jobListFilterLocation.'%');
                }

            }else{
                $qb->andWhere("j.location LIKE :locationFilter")
                   ->setParameter('locationFilter', '%'.$locationFilter.'%')
                ;
            }

        }

        if ($titleFilter) {
            $qb->andWhere("j.title LIKE :titleFilter")
               ->setParameter('titleFilter', '%'.$titleFilter.'%');
        }

        if ($term) {
            $qb->andWhere("j.company like :term")
                ->setParameter('term', "%".$term."%")
            ;
        }

        if ($language || $language !== 'ALL') {

            if ($language === 'English') {
                $qb->andWhere("REGEXP(j.description, '[[:blank:]]on[[:blank:]]|[[:blank:]]and[[:blank:]]|[[:blank:]]the[[:blank:]]|[[:blank:]]a[[:blank:]]|[[:blank:]]to[[:blank:]]') = 1");
            }

            if ($language === 'German') {
                $qb->andWhere("REGEXP(j.description, '[[:blank:]]on[[:blank:]]|[[:blank:]]and[[:blank:]]|[[:blank:]]the[[:blank:]]') = 0");
            }

        }

        return $qb;
    }


    public function getStatisticApplyJob(): QueryBuilder
    {

        $qb = $this->createQueryBuilder('j')
            ->select("DATE_FORMAT(j.applyAt, '%m-%d-%Y') as dateVal, COUNT(j.id) as cnt")
            ->andWhere("j.applyAt is not null")
            ->groupBy("dateVal")
            ->orderBy('dateVal','DESC')
        ;

        return $qb;
    }


}
