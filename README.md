q-alliance-example-bundle
=========================

Q Alliance ExampleBundle application in Symfony3. 

Contains:
- 2 models (Book, Author)
- repository + factory services for models
- JMS serializer setup and annotations for some easy serialization/unserialization
- Swagger Bundle to read and generate swagger.json documentation for the API
- Swagger UI Bundle to render a nice UI for the documentation
- some useful Exceptions 

This is just a demo app made for ZGPHP user group to go with my "Documenting API with Swagger" presentation.


### Installation

```
$ git clone git@github.com:acrnogor/q-alliance-example-bundle.git example
$ composer install
$ bin/console doctrine:create:database
$ bin/console doctrine:schema:update --force
$ bin/console server:run
```