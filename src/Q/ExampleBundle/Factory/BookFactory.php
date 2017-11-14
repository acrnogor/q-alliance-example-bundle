<?php
namespace Q\ExampleBundle\Factory;

use JMS\Serializer\DeserializationContext;
use Q\ExampleBundle\Entity\Book;

/**
 * Class BookFactory
 *
 * @author Ante Crnogorac <ante@q-alliance.com>
 * @package Q\ExampleBundle\Factory
 */
class BookFactory extends BaseFactory implements FactoryInterface
{
    /**
     * @param   string $data
     * @param   array $groups
     *
     * @throws \Q\ExampleBundle\Exception\ValidationException
     *
     * @return Book
     */
    public function factory(string $data, array $groups = []) : Book
    {
        $entity = null;
        $context = !empty($groups) ? DeserializationContext::create()->setGroups($groups): null;

        /** @var Book $entity */
        $entity = $this->serializer->deserialize($data, Book::class, 'json', $context);

        $entity->setUpdatedAt(new \DateTime);

        $this->validate($entity);

        return $entity;
    }
}
