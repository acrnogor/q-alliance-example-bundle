<?php
namespace Q\ExampleBundle\Factory;

use JMS\Serializer\DeserializationContext;
use Q\ExampleBundle\Exception\ValidationException;
use Q\ExampleBundle\Factory\FactoryInterface;
use Q\ExampleBundle\Entity\Author;

/**
 * Class AuthorFactory
 *
 * @author Ante Crnogorac <ante@q-alliance.com>
 * @package Q\ExampleBundle\Factory
 */
class AuthorFactory extends BaseFactory implements FactoryInterface
{
    /**
     * @param   string $data
     * @param   array $groups
     *
     * @throws \InvalidArgumentException if validation fails
     *
     * @throws \Q\ExampleBundle\Exception\ValidationException
     *
     * @return Author
     */
    public function factory(string $data, array $groups = []) : Author
    {
        $entity = null;
        $context = !empty($groups) ? DeserializationContext::create()->setGroups($groups): null;

        /** @var Author $entity */
        $entity = $this->serializer->deserialize($data, Author::class, 'json', $context);

        $this->validate($entity);

        return $entity;
    }
}
