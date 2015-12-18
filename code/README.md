minishop
========

A Symfony project created on December 6, 2015, 9:27 pm.
A Sample Symfony2 Project

and the command will be using 

1. php symfony new Minishop
2. php app/console generate:bundle --namespace=Minishop/ShopBundle --format=yml

3. open parameter.yml to setup database
4. php app/console doctrine:database:create

5. php app/console assets:install

6. php app/console doctrine:mapping:import --force MinishopShopBundle yml
7. php app/console doctrine:mapping:convert annotation ./src
8. php app/console doctrine:generate:entities MinishopShopBundle

9. php app/console doctrine:schema:update --force
10. php app/console doctrine:fixtures:load
11. php app/console doctrine:generate:crud --entity=IbwJobeetBundle:Job --route-prefix=ibw_job --with-write --format=yml
12. php app/console router:debug ibw_job_show

