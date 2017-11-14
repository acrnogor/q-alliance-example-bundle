<?php

namespace Q\ExampleBundle\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\DocParser;
use JMS\Serializer\SerializerInterface;
use Q\ExampleBundle\Entity\EntityInterface;
use Q\ExampleBundle\Exception\ValidationException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class BaseFactory
 *
 * @package Q\ExampleBundle\Factory
 * @author Zwer<ante@q-alliance.com>
 */
abstract class BaseFactory
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * BaseFactory constructor.
     *
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Validate entity
     *  - uses Assert annotations to run validations on object properties
     *  - returns array of key -> value errors
     *
     * @param EntityInterface $entity
     *
     * @throws \ReflectionException
     * @throws ValidationException
     *
     * @return array
     */
    public function validate(EntityInterface $entity) : array
    {
        $errors = [];

        if (count($validationErrors = $this->validator->validate($entity)) > 0) {
            /** @var ConstraintViolation $error */
            foreach ($validationErrors as $error) {
                $errors[$this->getSerializedName($entity, $error->getPropertyPath())] = $error->getMessage();
            }

            throw ValidationException::create('Validation failed', $errors);
        }

        return $errors;
    }

    /**
     * @param $entity
     * @param $propertyName
     *
     * @throws \ReflectionException
     *
     * @return string
     */
    protected function getSerializedName($entity, $propertyName) : string
    {
        $reader = new AnnotationReader(new DocParser());
        $reflection = new \ReflectionProperty($entity, $propertyName);
        $serializedName = $reader->getPropertyAnnotation($reflection, SerializedName::class);

        return $serializedName ? $serializedName->name : $propertyName;
    }

    /**
     * Factory method
     *  - all child classes that extend BaseFactory must implement this class on their own
     *
     * @param string $data
     * @param array $groups
     *
     * @return mixed
     */
    public abstract function factory(string $data, array $groups);
}
