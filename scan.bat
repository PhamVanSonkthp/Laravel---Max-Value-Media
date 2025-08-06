echo OKAY Dang fix loi?

call vendor\bin\phpcs --config-set default_standard PSR2 
call vendor\bin\phpcbf -np app
call vendor\bin\phpcbf -np resources
call vendor\bin\phpcbf -np routes

echo DONE!
echo ---PhamSon---