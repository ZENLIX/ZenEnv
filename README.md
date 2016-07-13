# ZenEnv
PHP class that helps work with .env


$env = new ZenEnv('/Users/rustem/Sites/Code/envfile.txt');



$env->delete(['KEY', 'PARAM1']);

$env->add([

'KEY'=>'VAL'

]);
$env->get();

$env->set([

'PARAM1'=>'VALUE',
'PARAM2'=>'VALUE'

]);
