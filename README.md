Installation
============

1. Add the following to your `composer.json` file:

    # composer.json
    {
        // ...
        require: {
            // ...
            "cunningsoft/chat-bundle": "dev-master"
        }
    }

2. Run `composer install cunningsoft/chat-bundle` to install the new dependencies.

3. Register the new bundle in your `AppKernel.php`:

    <?php
    # in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new Cunningsoft\ChatBundle\ChatBundle(),
        // ...
    );

4. Let your user entity implement the `Cunningsoft\ChatBundle\Entity\AuthorInterface`:

    # Acme\ProjectBundle\Entity\User.php
    <?php

    namespace Acme\ProjectBundle\Entity;

    use Cunningsoft\ChatBundle\Entity\AuthorInterface;

    class User implements AuthorInterface
    {
        // ...

5. Map the interface to your user entity in your `config.yml`:

    # app/config/config.yml
    // ...
    doctrine:
        orm:
            resolve_target_entities:
                Cunningsoft\ChatBundle\Entity\AuthorInterface: Acme\ProjectBundle\Entity\User

6. Update your database schema:

    $ app/console doctrine:schema:update

7. Configure the chat bundle:

    # app/config/config.yml
    // ...
    chat:
        update_interval: 5000 // refresh interval in milliseconds
        number_of_messages: 10 // messages to be shown in chat

8. Render the chat in your template:

    # src/Acme/ProjectBundle/Resources/views/Default/index.html.twig
    // ...
    {% render 'ChatBundle:Chat:show' %}
    // ...
