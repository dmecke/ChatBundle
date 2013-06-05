Installation
============

1. Add the following to your `composer.json` file:

    ```js
    // composer.json
    {
        // ...
        require: {
            // ...
            "cunningsoft/chat-bundle": "0.4.*"
        }
    }
    ```

2. Run `composer update cunningsoft/chat-bundle` to install the new dependencies.

3. Register the new bundle in your `AppKernel.php`:

    ```php
    <?php
    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new Cunningsoft\ChatBundle\CunningsoftChatBundle(),
        // ...
    );
    ```

4. Let your user entity implement the `Cunningsoft\ChatBundle\Entity\AuthorInterface`:

    ```php
    // Acme\ProjectBundle\Entity\User.php
    <?php

    namespace Acme\ProjectBundle\Entity;

    use Cunningsoft\ChatBundle\Entity\AuthorInterface;

    class User implements AuthorInterface
    {
        // ...
    ```

5. Map the interface to your user entity in your `config.yml`:

    ```yaml
    // app/config/config.yml
    // ...
    doctrine:
        orm:
            resolve_target_entities:
                Cunningsoft\ChatBundle\Entity\AuthorInterface: Acme\ProjectBundle\Entity\User
    ```

6. Update your database schema:

    ```bash
    $ app/console doctrine:schema:update
    ```

7. Configure the chat bundle:

    ```yaml
    // app/config/config.yml
    // ...
    cunningsoft_chat:
        # refresh interval in milliseconds
        update_interval: 5000
        # messages to be shown in chat
        number_of_messages: 10
    ```

8. Import routes:

    ```yaml
    // app/config/routing.yml
    // ...
    cunningsoft_chat_bundle:
        resource: "@CunningsoftChatBundle/Controller"
        type: annotation
    ```

9. Render the chat in your template:

    ```twig
    // src/Acme/ProjectBundle/Resources/views/Default/index.html.twig
    // ...
    {% render(controller('CunningsoftChatBundle:Chat:show')) %}
    // ...
    ```


Changelog
=========
* 0.4 (master)
Upgrade to Symfony 2.3.* - dropped support for Symfony 2.2.*

* 0.3
Included "Cunningsoft" into the namespace to avoid conflicts

* 0.2
Upgrade to Symfony 2.2.* - dropped support for Symfony 2.1.*

* 0.1
First working version. Support for Symfony 2.1.*

