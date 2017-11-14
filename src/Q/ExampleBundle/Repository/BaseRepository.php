<?php

namespace Q\ExampleBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Q\ExampleBundle\Entity\EntityInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * BaseRepository
 *
 * @author Zwer<ante@q-alliance.com>
 */
abstract class BaseRepository extends EntityRepository
{
    /**
     * Save entity (create)
     *
     * @param EntityInterface $entity
     * @param boolean $flush
     */
    public function save(EntityInterface $entity, $flush = true)
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Merge entity
     *  - use when updating and want to keep previous ID
     *  - you must save response entity to same name in order to get updated data
     *
     * @param EntityInterface $entity
     * @param boolean $flush
     * @return EntityInterface
     */
    public function merge(EntityInterface $entity, $flush = true) : EntityInterface
    {
        /** @var EntityInterface $entity */
        $entity = $this->_em->merge($entity);
        if ($flush) {
            $this->_em->flush();
            $this->_em->refresh($entity);
        }
        return $entity;
    }

    /**
     * Remove entity
     *
     * @param EntityInterface $entity
     * @param boolean $flush
     */
    public function remove(EntityInterface $entity, $flush = true)
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Find the required object or throw error not found (404)
     *
     * @param int $id
     * @throws NotFoundHttpException when resource is not found or doesn't exist
     * @return EntityInterface|mixed
     */
    public function findOr404($id) : EntityInterface
    {
        $entity = $this->find($id);

        if (!$entity) {
            try {
                $entityName = str_replace('Repository', '', array_values(array_slice(explode("\\", get_class($this)), -1))[0]);
            } catch (\Exception $e) {
                $entityName = 'Entity';
            }

            $message = sprintf('Resource of type %s and ID %s could not be found!', $entityName, $id);
            throw new NotFoundHttpException($message, null, Response::HTTP_NOT_FOUND);
        }

        return $entity;
    }
}
