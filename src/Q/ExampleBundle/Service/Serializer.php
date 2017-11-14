<?php

namespace Q\ExampleBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Q\ExampleBundle\Entity\EntityInterface;

/**
 * Class Serializer
 * @package Q\ExampleBundle\Service
 * @author Zwer<ante@q-alliance.com>
 */
class Serializer
{
    /**
     * @var SerializerInterface
     */
    private $jmsSerializer;

    /**
     * Serializer constructor.
     * @param $jmsSerializer
     */
    public function __construct(SerializerInterface $jmsSerializer)
    {
        $this->jmsSerializer = $jmsSerializer;
    }

    /**
     * Method for converting doctrine objects to arrays
     *
     * @param EntityInterface|ArrayCollection $object
     * @param string|array $group
     * @return array
     */
    public function toArray($object, $group = null) : array
    {
        $jsonData = $this->serialize($object, $group);

        return json_decode($jsonData, true);
    }

    /**
     * Convert objects to json string
     *
     * @param EntityInterface|ArrayCollection $object
     * @param string|array $group
     * @return string
     */
    public function toJson($object, $group = null) : string
    {
        return $this->serialize($object, $group);
    }

    /**
     * Fixed setup to serialize object to JSON string
     *
     * @param $object
     * @param $group
     * @return mixed|string
     */
    protected function serialize($object, $group)
    {
        $context = SerializationContext::create();
        $context
            ->setSerializeNull(true)
            ->enableMaxDepthChecks();

        if (null !== $group) {
            if (is_array($group)) {
                $context->setGroups($group);
            } else {
                $context->setGroups([$group]);
            }
        } else {
            $context->setGroups('default');
        }

        return $this->jmsSerializer->serialize($object, 'json', $context);
    }
}
