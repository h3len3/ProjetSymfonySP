del migrations\*
symfony console doctrine:database:drop --force
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migrations:migrate
symfony console doctrine:fixture:load